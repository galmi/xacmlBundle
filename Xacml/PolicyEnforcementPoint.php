<?php

namespace Galmi\XacmlBundle\Xacml;


use Galmi\Xacml\Request as XacmlRequest;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class PolicyEnforcementPoint
{
    /** @var XacmlRequest */
    private $xacmlRequest;


    public function __construct(XacmlRequest $xacmlRequest)
    {
        $this->xacmlRequest = $xacmlRequest;
    }

    public function test()
    {
        print_r($this->xacmlRequest); exit;
    }
}