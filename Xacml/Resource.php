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

    /** @var string */
    private $method;

    public function __construct($entity, $id, $method = 'find')
    {
        $this->entity = $entity;
        $this->id = $id;
        $this->method = $method;
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

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}