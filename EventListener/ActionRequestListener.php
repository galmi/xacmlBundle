<?php

namespace Galmi\XacmlBundle\EventListener;


use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ActionRequestListener
{

    /** @var string */
    private $category = 'Action';

    /** @var XacmlRequest */
    private $xacmlRequest;

    public function __construct(XacmlRequest $xacmlRequest)
    {
        $this->xacmlRequest = $xacmlRequest;
    }

    public function onKernelRequest(GetResponseEvent $request)
    {
        $this->xacmlRequest->set(
            $this->category,
            $request->getRequest()->get('_route')
        );

    }
}