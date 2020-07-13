<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Endpoint;

class FindRepositories extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param array $queryParameters {
     *
     *     @var string $query query to filter by
     *     @var int $page page to return
     *     @var int $page_size maximum number of results to return
     * }
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }

    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/search/repositories';
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
        $optionsResolver->setDefined(['query', 'page', 'page_size']);
        $optionsResolver->setRequired(['query']);
        $optionsResolver->setDefaults([]);
        $optionsResolver->setAllowedTypes('query', ['string']);
        $optionsResolver->setAllowedTypes('page', ['int', 'null']);
        $optionsResolver->setAllowedTypes('page_size', ['int', 'null']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\RepositorySearchResults|\ConnectHolland\DockerApiBundle\Api\Model\Error|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'ConnectHolland\\DockerApiBundle\\Api\\Model\\RepositorySearchResults', 'json');
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
