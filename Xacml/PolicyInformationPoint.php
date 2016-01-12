<?php

namespace Galmi\XacmlBundle\Xacml;


use Doctrine\ORM\EntityManager;
use Galmi\Xacml\Expression\AttributeFinder;
use Galmi\Xacml\Request as XacmlRequest;
use Galmi\XacmlBundle\Xacml\Resource as XacmlResource;

class PolicyInformationPoint implements AttributeFinder
{

    /** @var EntityManager */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Retrieve value by attributeId from request context
     *
     * @param XacmlRequest $request
     * @param string $attributeId
     * @return mixed
     * @throws \Exception
     */
    public function getValue(XacmlRequest $request, $attributeId)
    {
        $attributeParts = explode('.', trim($attributeId));
        $array = [];
        foreach ($attributeParts as $key => $attributePart) {
            //First check Category - top level in XacmlRequest
            if ($key === 0) {
                $array = $request->get($attributePart);
                if (empty($array)) {
                    //Check if attribute part is Resource
                    $array = $request->get('Resource');
                    if (!empty($array) && isset($array[$attributePart]) && $array[$attributePart] instanceof XacmlResource) {
                        /** @var XacmlResource $resource */
                        $resource = $array[$attributeParts[0]];
                        $array = $this->getEntity($resource->getEntity(), $resource->getId());
                    }
                }
                if (empty($array)) {
                    throw new \Exception("Attribute {$attributeId} not found");
                }
                continue;
            }
            if (is_array($array) && isset($array[$attributePart])) {
                $array = $array[$attributePart];
            } elseif (is_object($array)) {
                $getter = $this->getGetter($attributePart);
                $array = $array->$getter();
            } else {
                throw new \Exception("Attribute {$attributeId} not found");
            }
        }

        return $array;
    }

    /**
     * Get entity object by class name and identifier
     *
     * @param $entity
     * @param $id
     * @return null|object
     * @throws \Exception
     */
    protected function getEntity($entity, $id)
    {
        if (empty($id)) {
            throw new \Exception("Empty identifier of repository {$entity}");
        }
        $repository = $this->em->getRepository($entity);
        if (empty($repository)) {
            throw new \Exception("Repository for {$entity} not found");
        }
        $object = $repository->find($id);
        if (empty($object)) {
            throw new \Exception("Entity {$entity} with identifier {$id} not found");
        }

        return $object;
    }

    /**
     * Return getter name for attribute part
     *
     * @param $attributePart
     * @return string
     */
    protected function getGetter($attributePart)
    {
        return 'get'.ucfirst($attributePart);
    }
}