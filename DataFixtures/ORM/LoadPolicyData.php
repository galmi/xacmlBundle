<?php

namespace Galmi\XacmlBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Galmi\Xacml\CombiningAlgorithmRegistry;
use Galmi\Xacml\Match;
use Galmi\Xacml\Target;
use Galmi\Xacml\TargetAllOf;
use Galmi\Xacml\TargetAnyOf;
use Galmi\XacmlBundle\Entity\Policy;

class LoadPolicyData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $match = new Match('Action', 'homepage');
        $allOf = new TargetAllOf();
        $allOf->addMatch($match);
        $anyof = new TargetAnyOf();
        $anyof->addTargetAllOf($allOf);
        $target = new Target();
        $target->addTargetAnyOf($anyof);

        $policy = new Policy($target, CombiningAlgorithmRegistry::FIRST_APPLICABLE);

        $manager->persist($policy);
        $manager->flush();
    }
}