<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ManifestsNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Manifests';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Manifests';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \ConnectHolland\DockerApiBundle\Api\Model\Manifests();
        if (\array_key_exists('schemaVersion', $data)) {
            $object->setSchemaVersion($data['schemaVersion']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('tag', $data)) {
            $object->setTag($data['tag']);
        }
        if (\array_key_exists('architecture', $data)) {
            $object->setArchitecture($data['architecture']);
        }
        if (\array_key_exists('fsLayers', $data)) {
            $values = [];
            foreach ($data['fsLayers'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\FSLayer', 'json', $context);
            }
            $object->setFsLayers($values);
        }
        if (\array_key_exists('history', $data)) {
            $values_1 = [];
            foreach ($data['history'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\History', 'json', $context);
            }
            $object->setHistory($values_1);
        }
        if (\array_key_exists('signatures', $data)) {
            $values_2 = [];
            foreach ($data['signatures'] as $value_2) {
                $values_2[] = $this->denormalizer->denormalize($value_2, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Signature', 'json', $context);
            }
            $object->setSignatures($values_2);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getSchemaVersion()) {
            $data['schemaVersion'] = $object->getSchemaVersion();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getTag()) {
            $data['tag'] = $object->getTag();
        }
        if (null !== $object->getArchitecture()) {
            $data['architecture'] = $object->getArchitecture();
        }
        if (null !== $object->getFsLayers()) {
            $values = [];
            foreach ($object->getFsLayers() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['fsLayers'] = $values;
        }
        if (null !== $object->getHistory()) {
            $values_1 = [];
            foreach ($object->getHistory() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['history'] = $values_1;
        }
        if (null !== $object->getSignatures()) {
            $values_2 = [];
            foreach ($object->getSignatures() as $value_2) {
                $values_2[] = $this->normalizer->normalize($value_2, 'json', $context);
            }
            $data['signatures'] = $values_2;
        }

        return $data;
    }
}
