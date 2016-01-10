<?php

namespace Galmi\XacmlBundle\Xacml;

/**
 * Class Resource store resource data
 *
 * @package Galmi\XacmlBundle\Xacml
 */
class Resource
{

    /** @var string */
    private $entity;

    /** @var integer|string */
    private $id;

    public function __construct($entity, $id)
    {
        $this->entity = $entity;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }
}