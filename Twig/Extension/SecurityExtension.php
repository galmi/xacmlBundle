<?php

namespace Galmi\XacmlBundle\Twig\Extension;


use Galmi\XacmlBundle\Security\Core\Authorization\AuthorizationChecker;

/**
 * Extension for Twig, added function is_xacml_granted for templates
 *
 * @author Ildar Galiautdinov
 */
class SecurityExtension extends \Twig_Extension
{

    /** @var AuthorizationChecker */
    private $authorizationChecker;

    public function __construct(AuthorizationChecker $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param $action
     * @param null|object $entity
     * @param null $id
     * @return bool
     */
    public function isGranted($action, $entity = null, $id = null)
    {
        return $this->authorizationChecker->isGranted($action, $entity, $id);
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('is_xacml_granted', array($this, 'isGranted')),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'galmi_xacml.security';
    }
}