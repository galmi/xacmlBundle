<?php

namespace Galmi\XacmlBundle\Entity;


use Doctrine\Common\Collections\Collection;
use Galmi\Xacml\Target;

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

    /**
     * @return array|\Galmi\Xacml\Rule[]
     */
    public function getRules()
    {
        $rules = parent::getRules();
        if ($rules instanceof Collection) {
            return $rules->toArray();
        }
        return $rules;
    }
}
