<?php

namespace Galmi\XacmlBundle\EventListener;


use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class SubjectRequestListener
{

    /** @var string */
    private $category = 'Subject';

    /** @var XacmlRequest */
    private $xacmlRequest;

    /** @var TokenStorage */
    private $tokenStorage;

    public function __construct(XacmlRequest $xacmlRequest, TokenStorage $tokenStorage)
    {
        $this->xacmlRequest = $xacmlRequest;
        $this->tokenStorage = $tokenStorage;
    }

    public function onKernelRequest(GetResponseEvent $request)
    {
        $this->xacmlRequest->set($this->category, $this->tokenStorage->getToken()->getUser());
    }
}