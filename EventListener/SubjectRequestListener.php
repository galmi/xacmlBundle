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

    /**
     * SubjectRequestListener constructor.
     * @param XacmlRequest $xacmlRequest
     * @param TokenStorage $tokenStorage
     */
    public function __construct(XacmlRequest $xacmlRequest, TokenStorage $tokenStorage)
    {
        $this->xacmlRequest = $xacmlRequest;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Add user info for request
     *
     * @param GetResponseEvent $request
     */
    public function onKernelRequest(GetResponseEvent $request)
    {
        $token = $this->tokenStorage->getToken();
        $user = null;
        if (!is_null($token)) {
            $user = $token->getUser();
        }
        $this->xacmlRequest->set($this->category, $user);
    }
}