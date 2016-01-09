<?php

namespace Galmi\XacmlBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Galmi\Xacml\Request as XacmlRequest;
use Galmi\XacmlBundle\Annotations\XacmlResource;
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
            if($configuration instanceof XacmlResource){
                $resource = [
                    'entity' => $configuration->entity,
                    'id' => $request->getRequest()->get($configuration->id)
                ];
                $this->xacmlRequest->set($this->category, $resource);
            }
        }

    }
}