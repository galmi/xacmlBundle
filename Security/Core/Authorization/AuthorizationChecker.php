<?php

namespace Galmi\XacmlBundle\Security\Core\Authorization;


use Galmi\Xacml\Decision;
use Galmi\XacmlBundle\Xacml\PolicyDecisionPoint;
use Galmi\XacmlBundle\Xacml\Resource;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Galmi\Xacml\Request as XacmlRequest;

/**
 * Checks if action are granted against XacmlRequest and optionally supplied entity.
 *
 * @author Ildar Galiautdinov
 */
class AuthorizationChecker implements AuthorizationCheckerInterface
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

    /**
     * Checks if action are granted against XacmlRequest and optionally supplied entity.
     *
     * @param mixed $action
     * @param object|string $entity
     * @param mixed $id
     * @return bool
     */
    public function isGranted($action, $entity = null, $id = null)
    {
        $xacml = clone $this->xacmlRequest;
        $xacml->set('Resource', null);
        if (!is_string($entity) && !is_null($id)) {
            $resource = $this->getResource($entity, $id);
            $xacml->set('Resource', $resource);
        } elseif (is_object($entity)) {
            $xacml->set(
                'Resource',
                [
                    $this->getBaseClassName(get_class($entity)) => $entity,
                ]
            );
        }
        $xacml->set('Action', $action);
        $result = $this->pdp->evaluate($xacml);

        return $result === Decision::PERMIT;
    }

    /**
     * Get Resource object from class name and id
     *
     * @param $className
     * @param $id
     * @return array
     */
    private function getResource($className, $id)
    {
        return [
            $this->getBaseClassName($className) => new Resource($className, $id),
        ];
    }

    /**
     * Return short name of class name with namespace
     *
     * @param $fullName
     * @return string
     */
    private function getBaseClassName($fullName)
    {
        return substr(strrchr($fullName, '\\'), 1);
    }
}