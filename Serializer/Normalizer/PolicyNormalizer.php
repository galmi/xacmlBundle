<?php

namespace Galmi\XacmlBundle\Serializer\Normalizer;


use Galmi\XacmlBundle\Entity\Policy;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class PolicyNormalizer extends SerializerAwareNormalizer implements NormalizerInterface
{

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param Policy $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array|string|bool|int|float|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'id' => $object->getId(),
            'description' => $object->getDescription(),
            'version' => $object->getVersion(),
            'ruleCombiningAlgId' => $object->getRuleCombiningAlgId(),
            'target' => $this->serializer->normalize($object->getTarget(), $format, $context),
        ];
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize.
     * @param string $format The format being (de-)serialized from or into.
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $format==='json' && $data instanceof Policy;
    }
}