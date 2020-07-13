<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Endpoint;

class GetManifests extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $user;
    protected $name;
    protected $tag;

    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param string $user User of the repository to fetch
     * @param string $name Name of the repository to fetch
     * @param string $tag  Tag of the manifest to fetch
     */
    public function __construct(string $user, string $name, string $tag)
    {
        $this->user = $user;
        $this->name = $name;
        $this->tag  = $tag;
    }

    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{user}', '{name}', '{tag}'], [$this->user, $this->name, $this->tag], '/{user}/{name}/manifests/{tag}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \ConnectHolland\DockerHubApiBundle\Api\Exception\GetManifestsUnauthorizedException
     *
     * @return \ConnectHolland\DockerHubApiBundle\Api\Model\Manifests|\ConnectHolland\DockerHubApiBundle\Api\Model\Error|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Manifests', 'json');
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \ConnectHolland\DockerHubApiBundle\Api\Exception\GetManifestsUnauthorizedException($serializer->deserialize($body, 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Unauthorized', 'json'));
        }
        if (mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Error', 'json');
        }
    }

    public function getAuthenticationScopes(): array
    {
        return ['registryAuth'];
    }
}
