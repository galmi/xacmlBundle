<?php

namespace Galmi\XacmlBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Galmi\XacmlBundle\Entity\PolicySet;

/**
 * PolicySetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PolicySetRepository extends EntityRepository
{
    /**
     * Find all top level policy sets for PDP
     *
     * @return PolicySet[]
     */
    public function findNotLinkedPolicySets()
    {
        return $this->findBy(
            [
                'linked' => false,
                'active' => true,
            ]
        );
    }
}