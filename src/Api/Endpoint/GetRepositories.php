<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Endpoint;

class GetRepositories extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $user;

    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param string $user            User of the repositories to fetch
     * @param array  $queryParameters {
     *
     *     @var int $page page to return
     *     @var int $page_size maximum number of results to return
     * }
     */
    public function __construct(string $user, array $queryParameters = [])
    {
        $this->user            = $user;
        $this->queryParameters = $queryParameters;
    }

    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{user}'], [$this->user], '/repositories/{user}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['page', 'page_size']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('page', ['int', 'null']);
        $optionsResolver->setAllowedTypes('page_size', ['int', 'null']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\ArrayOfRepositories|\ConnectHolland\DockerApiBundle\Api\Model\Error|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\ArrayOfRepositories', 'json');
        }
        if (mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\Error', 'json');
        }
    }

    public function getAuthenticationScopes(): array
    {
        return ['hubAuth'];
    }
}
