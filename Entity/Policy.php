<?php

namespace Galmi\XacmlBundle\Entity;


class Policy extends \Galmi\Xacml\Policy
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
     * Set target
     *
     * @param \stdClass $target
     *
     * @return Policy
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
     * Set ruleCombiningAlgId
     *
     * @param string $ruleCombiningAlgId
     *
     * @return Policy
     */
    public function setRuleCombiningAlgId($ruleCombiningAlgId)
    {
        $this->ruleCombiningAlgId = $ruleCombiningAlgId;

        return $this;
    }

    /**
     * Get ruleCombiningAlgId
     *
     * @return string
     */
    public function getRuleCombiningAlgId()
    {
        return $this->ruleCombiningAlgId;
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
}
