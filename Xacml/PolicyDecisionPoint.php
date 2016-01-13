<?php

namespace Galmi\XacmlBundle\Xacml;


use Doctrine\ORM\EntityManager;
use Galmi\Xacml\CombiningAlgorithmRegistry;
use Galmi\Xacml\Decision;
use Galmi\Xacml\Request as XacmlRequest;
use Galmi\XacmlBundle\Entity\Policy;
use Galmi\XacmlBundle\Entity\PolicySet;

class PolicyDecisionPoint
{

    /** @var EntityManager */
    private $em;

    /** @var CombiningAlgorithmRegistry */
    private $combiningAlgorithmRegistry;

    /** @var string */
    private $combiningAlgId;

    /** @var string */
    private $defaultDecision;

    public function __construct(
        EntityManager $em,
        CombiningAlgorithmRegistry $combiningAlgorithmRegistry,
        $combiningAlgId,
        $defaultDecision
    ) {
        $this->em = $em;
        $this->combiningAlgorithmRegistry = $combiningAlgorithmRegistry;
        $this->combiningAlgId = $combiningAlgId;
        $this->defaultDecision = $defaultDecision;
    }

    public function evaluate(XacmlRequest $request)
    {
        $action = $request->get('Action');
        //Error pages not have Action name
        /**
         * Permit access to:
         * - Error pages with empty Action name
         * - Actions for debug, started with "_"
         */
        if (empty($action) || substr($action, 0, 1) === '_') {
            return Decision::PERMIT;
        }
        $policies = $this->em->getRepository(PolicySet::class)->findNotLinkedPolicySets();
        if (empty($policies)) {
            $policies = $this->em->getRepository(Policy::class)->findNotLinkedPolicies();
        }
        if (!empty($policies)) {
            $result = $this->combiningAlgorithmRegistry->get($this->combiningAlgId)->evaluate($request, $policies);
            if (in_array($result, [Decision::PERMIT, Decision::DENY])) {
                return $result;
            }
        }
        return $this->defaultDecision;
    }
}