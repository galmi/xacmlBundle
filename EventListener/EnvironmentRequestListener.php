<?php

namespace Galmi\XacmlBundle\EventListener;


use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class EnvironmentRequestListener
{

    /** @var string */
    private $category = 'Environment';

    /** @var XacmlRequest */
    private $xacmlRequest;

    /**
     * EnvironmentRequestListener constructor.
     * @param XacmlRequest $xacmlRequest
     */
    public function __construct(XacmlRequest $xacmlRequest)
    {
        $this->xacmlRequest = $xacmlRequest;
    }

    /**
     * Add environment information for request
     *
     * @param GetResponseEvent $request
     */
    public function onKernelRequest(GetResponseEvent $request)
    {
        $dateTime = new \DateTime();

        $this->xacmlRequest->set(
            $this->category,
            [
                'ip' => $request->getRequest()->getClientIp(),
                'date_time' => $dateTime->format('Y-m-d H:i:s'),
            ]
        );

    }
}