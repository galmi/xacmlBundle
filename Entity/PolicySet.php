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
