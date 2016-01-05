<?php

namespace Galmi\XacmlBundle\Entity;


class Policy extends \Galmi\Xacml\Policy
{


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
}
