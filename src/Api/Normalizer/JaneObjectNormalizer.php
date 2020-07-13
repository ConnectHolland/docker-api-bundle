<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers      = ['ConnectHolland\\DockerApiBundle\\Api\\Model\\RepositorySearchResults' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\RepositorySearchResultsNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Manifests' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\ManifestsNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\History' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\HistoryNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\FSLayer' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\FSLayerNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Signature' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\SignatureNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\RepositorySearch' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\RepositorySearchNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\ArrayOfRepositories' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\ArrayOfRepositoriesNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Repository' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\RepositoryNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\RepositoryPermissions' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\RepositoryPermissionsNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Error' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\ErrorNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Unauthorized' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\UnauthorizedNormalizer', 'ConnectHolland\\DockerApiBundle\\Api\\Model\\UnauthorizedErrors' => 'ConnectHolland\\DockerApiBundle\\Api\\Normalizer\\UnauthorizedErrorsNormalizer', '\\Jane\\JsonSchemaRuntime\\Reference' => '\\Jane\\JsonSchemaRuntime\\Normalizer\\ReferenceNormalizer'];
    protected $normalizersCache = [];

    public function supportsDenormalization($data, $type, $format = null)
    {
        return array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer      = $this->getNormalizer($normalizerClass);

        return $normalizer->normalize($object, $format, $context);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer      = $this->getNormalizer($denormalizerClass);

        return $denormalizer->denormalize($data, $class, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;

        return $normalizer;
    }
}
