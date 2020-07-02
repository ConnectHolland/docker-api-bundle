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

class RepositoryNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Repository';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Repository';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \ConnectHolland\DockerHubApiBundle\Api\Model\Repository();
        if (\array_key_exists('user', $data)) {
            $object->setUser($data['user']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('namespace', $data)) {
            $object->setNamespace($data['namespace']);
        }
        if (\array_key_exists('repository_type', $data)) {
            $object->setRepositoryType($data['repository_type']);
        }
        if (\array_key_exists('status', $data)) {
            $object->setStatus($data['status']);
        }
        if (\array_key_exists('description', $data) && $data['description'] !== null) {
            $object->setDescription($data['description']);
        } elseif (\array_key_exists('description', $data) && $data['description'] === null) {
            $object->setDescription(null);
        }
        if (\array_key_exists('is_private', $data)) {
            $object->setIsPrivate($data['is_private']);
        }
        if (\array_key_exists('is_automated', $data)) {
            $object->setIsAutomated($data['is_automated']);
        }
        if (\array_key_exists('can_edit', $data)) {
            $object->setCanEdit($data['can_edit']);
        }
        if (\array_key_exists('star_count', $data)) {
            $object->setStarCount($data['star_count']);
        }
        if (\array_key_exists('pull_count', $data)) {
            $object->setPullCount($data['pull_count']);
        }
        if (\array_key_exists('last_updated', $data) && $data['last_updated'] !== null) {
            $object->setLastUpdated(\DateTime::createFromFormat('Y-m-d\\TH:i:s.uP', $data['last_updated']));
        } elseif (\array_key_exists('last_updated', $data) && $data['last_updated'] === null) {
            $object->setLastUpdated(null);
        }
        if (\array_key_exists('is_migrated', $data)) {
            $object->setIsMigrated($data['is_migrated']);
        }
        if (\array_key_exists('has_starred', $data)) {
            $object->setHasStarred($data['has_starred']);
        }
        if (\array_key_exists('full_description', $data) && $data['full_description'] !== null) {
            $object->setFullDescription($data['full_description']);
        } elseif (\array_key_exists('full_description', $data) && $data['full_description'] === null) {
            $object->setFullDescription(null);
        }
        if (\array_key_exists('affiliation', $data) && $data['affiliation'] !== null) {
            $object->setAffiliation($data['affiliation']);
        } elseif (\array_key_exists('affiliation', $data) && $data['affiliation'] === null) {
            $object->setAffiliation(null);
        }
        if (\array_key_exists('permissions', $data)) {
            $object->setPermissions($this->denormalizer->denormalize($data['permissions'], 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\RepositoryPermissions', 'json', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getUser()) {
            $data['user'] = $object->getUser();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getNamespace()) {
            $data['namespace'] = $object->getNamespace();
        }
        if (null !== $object->getRepositoryType()) {
            $data['repository_type'] = $object->getRepositoryType();
        }
        if (null !== $object->getStatus()) {
            $data['status'] = $object->getStatus();
        }
        $data['description'] = $object->getDescription();
        if (null !== $object->getIsPrivate()) {
            $data['is_private'] = $object->getIsPrivate();
        }
        if (null !== $object->getIsAutomated()) {
            $data['is_automated'] = $object->getIsAutomated();
        }
        if (null !== $object->getCanEdit()) {
            $data['can_edit'] = $object->getCanEdit();
        }
        if (null !== $object->getStarCount()) {
            $data['star_count'] = $object->getStarCount();
        }
        if (null !== $object->getPullCount()) {
            $data['pull_count'] = $object->getPullCount();
        }
        if (null !== $object->getLastUpdated()) {
            $data['last_updated'] = $object->getLastUpdated()->format('Y-m-d\\TH:i:s.uP');
        }
        if (null !== $object->getIsMigrated()) {
            $data['is_migrated'] = $object->getIsMigrated();
        }
        if (null !== $object->getHasStarred()) {
            $data['has_starred'] = $object->getHasStarred();
        }
        $data['full_description'] = $object->getFullDescription();
        $data['affiliation']      = $object->getAffiliation();
        if (null !== $object->getPermissions()) {
            $data['permissions'] = $this->normalizer->normalize($object->getPermissions(), 'json', $context);
        }

        return $data;
    }
}
