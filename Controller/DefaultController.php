<?php

namespace Galmi\XacmlBundle\Controller;

use Galmi\XacmlBundle\Entity\Policy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
//        $target = new \Galmi\Xacml\Target();
//
//        $anyOf1 = new \Galmi\Xacml\TargetAnyOf();
//        $target->addTargetAnyOf($anyOf1);
//
//        $anyOf2 = new \Galmi\Xacml\TargetAnyOf();
//        $allOf = new \Galmi\Xacml\TargetAllOf();
//        $match = new \Galmi\Xacml\Match('Attribute.test', 'test');
//        $allOf->addMatch($match);
//        $anyOf2->addTargetAllOf($allOf);
//        $target->addTargetAnyOf($anyOf2);
//
//        $policy = new Policy($target, 'permit-unless-deny');
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($policy);
//        $em->flush();

//        $policy = $this->getDoctrine()->getRepository('GalmiXacmlBundle:Policy')->find(2);
//        $response = new Response($this->get('serializer')->serialize($policy, 'json'));
//        return $response;

        $this->get('galmi_xacml.pep')->test();

        return $this->render('GalmiXacmlBundle:Default:index.html.twig');
    }
}
