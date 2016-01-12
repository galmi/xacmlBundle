<?php

namespace Galmi\XacmlBundle;

use Galmi\Xacml\Config;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GalmiXacmlBundle extends Bundle
{
    public function boot()
    {
        parent::boot();

        //Initialize Config storage for Xacml library
        Config::set(Config::ATTRIBUTE_FINDER, $this->container->get('galmi_xacml.pip'));
        Config::set(Config::FUNC_REGISTRY, $this->container->get('galmi_xacml_func_registry'));
        Config::set(
            Config::COMBINING_ALGORITHM_REGISTRY,
            $this->container->get('galmi_xacml_combining_algorithm_registry')
        );
    }
}
