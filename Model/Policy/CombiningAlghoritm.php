<?php

namespace Galmi\XacmlBundle\Model\Policy;


use Doctrine\Common\Collections\Collection;

interface CombiningAlghoritm
{
    public function evaluate(Collection $rules);
}