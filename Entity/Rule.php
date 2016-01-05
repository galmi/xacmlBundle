<?php

namespace Galmi\XacmlBundle\Entity;


class Rule extends \Galmi\Xacml\Rule
{


    /**
     * Set effect
     *
     * @param string $effect
     *
     * @return Rule
     */
    public function setEffect($effect)
    {
        $this->effect = $effect;

        return $this;
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
}
