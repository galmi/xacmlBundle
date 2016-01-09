<?php

namespace Galmi\XacmlBundle\Annotations;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Annotation for mapping action to entity
 *
 * @Annotation
 * @Target("METHOD")
 */
class XacmlResource
{
    /** @var string */
    public $entity;

    /** @var string */
    public $id;
}