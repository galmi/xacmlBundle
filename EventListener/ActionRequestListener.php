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

    /**
     * ActionRequestListener constructor.
     * @param XacmlRequest $xacmlRequest
     */
    public function __construct(XacmlRequest $xacmlRequest)
    {
        $this->xacmlRequest = $xacmlRequest;
    }

    /**
     * Add route name for request
     *
     * @param GetResponseEvent $request
     */
    public function onKernelRequest(GetResponseEvent $request)
    {
        $this->xacmlRequest->set(
            $this->category,
            $request->getRequest()->get('_route')
        );

    }
}