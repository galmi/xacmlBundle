<?php

namespace Galmi\XacmlBundle\Xacml;


use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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

    public function test()
    {
        print_r($this->xacmlRequest);
        exit;
    }

    public function isGranted($resource, $action)
    {
        $xacml = clone $this->xacmlRequest;
        $xacml->set('Resource', $resource);
        $xacml->set('Action', $action);
        $this->pdp->evaluate($xacml);
    }
}