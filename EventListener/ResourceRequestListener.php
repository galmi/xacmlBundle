<?php

namespace Galmi\XacmlBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Galmi\Xacml\Request as XacmlRequest;
use Galmi\XacmlBundle\Annotations\XacmlResource;
use Galmi\XacmlBundle\Xacml\Resource;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ResourceRequestListener
{
    /** @var string */
    private $category = 'Resource';

    /** @var XacmlRequest */
    private $xacmlRequest;

    /** @var Reader */
    private $annotationsReader;

    /**
     * ResourceRequestListener constructor.
     * @param XacmlRequest $xacmlRequest
     * @param Reader $annotationsReader
     */
    public function __construct(XacmlRequest $xacmlRequest, Reader $annotationsReader)
    {
        $this->xacmlRequest = $xacmlRequest;
        $this->annotationsReader = $annotationsReader;
    }

    /**
     * Add resource information for request from annotations
     *
     * @param GetResponseEvent $request
     */
    public function onKernelRequest(GetResponseEvent $request)
    {
        $controller = $request->getRequest()->get('_controller');
        list($class, $method) = explode('::', $controller);
        $object = new \ReflectionMethod($class, $method);
        foreach ($this->annotationsReader->getMethodAnnotations($object) as $configuration) {
            if ($configuration instanceof XacmlResource) {
                $resource = [
                    $this->getBaseClassName($configuration->entity) => new Resource(
                        $configuration->entity,
                        $request->getRequest()->get($configuration->id)
                    ),
                ];
                $this->xacmlRequest->set($this->category, $resource);
            }
        }

    }

    /**
     * Return short name of class name with namespace
     *
     * @param $fullName
     * @return string
     */
    private function getBaseClassName($fullName)
    {
        return substr(strrchr($fullName, '\\'), 1);
    }
}