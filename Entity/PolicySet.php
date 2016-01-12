<?php

namespace Galmi\XacmlBundle\Entity;


class PolicySet extends \Galmi\Xacml\PolicySet
{

    /**
     * @var bool
     */
    private $linked = false;

    /**
     * @var bool
     */
    private $active = true;

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return PolicySet
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set target
     *
     * @param \stdClass $target
     *
     * @return PolicySet
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \stdClass
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set policyCombiningAlgId
     *
     * @param string $policyCombiningAlgId
     *
     * @return PolicySet
     */
    public function setPolicyCombiningAlgId($policyCombiningAlgId)
    {
        $this->policyCombiningAlgId = $policyCombiningAlgId;

        return $this;
    }

    /**
     * Get policyCombiningAlgId
     *
     * @return string
     */
    public function getPolicyCombiningAlgId()
    {
        return $this->policyCombiningAlgId;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isLinked()
    {
        return $this->linked;
    }

    /**
     * @param boolean $linked
     */
    public function setLinked($linked)
    {
        $this->linked = $linked;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
