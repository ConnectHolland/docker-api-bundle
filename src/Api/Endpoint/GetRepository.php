<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Endpoint;

class GetRepository extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $user;
    protected $name;

    /**
     * Returns a repository based on the name.
     *
     * @param string $user User of the repository to fetch
     * @param string $name Name of the repository to fetch
     */
    public function __construct(string $user, string $name)
    {
        $this->user = $user;
        $this->name = $name;
    }

    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{user}', '{name}'], [$this->user, $this->name], '/repositories/{user}/{name}');
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
     * @return \ConnectHolland\DockerHubApiBundle\Api\Model\Repository|\ConnectHolland\DockerHubApiBundle\Api\Model\Error|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Repository', 'json');
        }
        if (mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerHubApiBundle\\Api\\Model\\Error', 'json');
        }
    }

    public function getAuthenticationScopes(): array
    {
        return [];
    }
}
