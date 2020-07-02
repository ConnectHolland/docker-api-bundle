<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RepositorySearchNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositorySearch';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositorySearch';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \ConnectHolland\DockerHubApiBundle\Api\Model\RepositorySearch();
        if (\array_key_exists('repo_name', $data)) {
            $object->setRepoName($data['repo_name']);
        }
        if (\array_key_exists('short_description', $data)) {
            $object->setShortDescription($data['short_description']);
        }
        if (\array_key_exists('star_count', $data)) {
            $object->setStarCount($data['star_count']);
        }
        if (\array_key_exists('pull_count', $data)) {
            $object->setPullCount($data['pull_count']);
        }
        if (\array_key_exists('repo_owner', $data)) {
            $object->setRepoOwner($data['repo_owner']);
        }
        if (\array_key_exists('last_updated', $data) && $data['last_updated'] !== null) {
            $object->setLastUpdated(\DateTime::createFromFormat('Y-m-d\\TH:i:s.uP', $data['last_updated']));
        } elseif (\array_key_exists('last_updated', $data) && $data['last_updated'] === null) {
            $object->setLastUpdated(null);
        }
        if (\array_key_exists('is_automated', $data)) {
            $object->setIsAutomated($data['is_automated']);
        }
        if (\array_key_exists('is_official', $data)) {
            $object->setIsOfficial($data['is_official']);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getRepoName()) {
            $data['repo_name'] = $object->getRepoName();
        }
        if (null !== $object->getShortDescription()) {
            $data['short_description'] = $object->getShortDescription();
        }
        if (null !== $object->getStarCount()) {
            $data['star_count'] = $object->getStarCount();
        }
        if (null !== $object->getPullCount()) {
            $data['pull_count'] = $object->getPullCount();
        }
        if (null !== $object->getRepoOwner()) {
            $data['repo_owner'] = $object->getRepoOwner();
        }
        if (null !== $object->getLastUpdated()) {
            $data['last_updated'] = $object->getLastUpdated()->format('Y-m-d\\TH:i:s.uP');
        }
        if (null !== $object->getIsAutomated()) {
            $data['is_automated'] = $object->getIsAutomated();
        }
        if (null !== $object->getIsOfficial()) {
            $data['is_official'] = $object->getIsOfficial();
        }

        return $data;
    }
}
