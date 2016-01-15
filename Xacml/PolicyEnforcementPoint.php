<?php

namespace Galmi\XacmlBundle\Xacml;

use Galmi\Xacml\Decision;
use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class PolicyEnforcementPoint
{

    /** @var XacmlRequest */
    private $xacmlRequest;

    /** @var PolicyDecisionPoint */
    private $pdp;

    public function __construct(XacmlRequest $xacmlRequest, PolicyDecisionPoint $pdp)
    {
        $this->xacmlRequest = $xacmlRequest;
        $this->pdp = $pdp;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $pdpDecision = $this->pdp->evaluate($this->xacmlRequest);
        if ($pdpDecision == Decision::DENY) {
            $response = new Response('Access denied', 403);
            $event->setResponse($response);
        }
    }
}