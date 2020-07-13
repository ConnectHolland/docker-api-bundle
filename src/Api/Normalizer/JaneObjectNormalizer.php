<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Normalizer;

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
    protected $normalizers      = ['ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositorySearchResults' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\RepositorySearchResultsNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Manifests' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\ManifestsNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\History' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\HistoryNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\FSLayer' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\FSLayerNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Signature' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\SignatureNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositorySearch' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\RepositorySearchNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\ArrayOfRepositories' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\ArrayOfRepositoriesNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Repository' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\RepositoryNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositoryPermissions' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\RepositoryPermissionsNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Error' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\ErrorNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Unauthorized' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\UnauthorizedNormalizer', 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\UnauthorizedErrors' => 'ConnectHolland\\DockerHubApiBundle\\Api\\Normalizer\\UnauthorizedErrorsNormalizer', '\\Jane\\JsonSchemaRuntime\\Reference' => '\\Jane\\JsonSchemaRuntime\\Normalizer\\ReferenceNormalizer'];
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
