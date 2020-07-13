<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api;

class Client extends \Jane\OpenApiRuntime\Client\Psr18Client
{
    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param string $user  User of the repository to fetch
     * @param string $name  Name of the repository to fetch
     * @param string $tag   Tag of the manifest to fetch
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @throws \ConnectHolland\DockerApiBundle\Api\Exception\GetManifestsUnauthorizedException
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\Manifests|\ConnectHolland\DockerApiBundle\Api\Model\Error|\Psr\Http\Message\ResponseInterface|null
     */
    public function getManifests(string $user, string $name, string $tag, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \ConnectHolland\DockerApiBundle\Api\Endpoint\GetManifests($user, $name, $tag), $fetch);
    }

    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param array $queryParameters {
     *
     *     @var string $query query to filter by
     *     @var int $page page to return
     *     @var int $page_size maximum number of results to return
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\RepositorySearchResults|\ConnectHolland\DockerApiBundle\Api\Model\Error|\Psr\Http\Message\ResponseInterface|null
     */
    public function findRepositories(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \ConnectHolland\DockerApiBundle\Api\Endpoint\FindRepositories($queryParameters), $fetch);
    }

    /**
     * Returns all repositories from the system that the user has access to.
     *
     * @param string $user            User of the repositories to fetch
     * @param array  $queryParameters {
     *
     *     @var int $page page to return
     *     @var int $page_size maximum number of results to return
     * }
     *
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\ArrayOfRepositories|\ConnectHolland\DockerApiBundle\Api\Model\Error|\Psr\Http\Message\ResponseInterface|null
     */
    public function getRepositories(string $user, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \ConnectHolland\DockerApiBundle\Api\Endpoint\GetRepositories($user, $queryParameters), $fetch);
    }

    /**
     * Returns a repository based on the name.
     *
     * @param string $user  User of the repository to fetch
     * @param string $name  Name of the repository to fetch
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     *
     * @return \ConnectHolland\DockerApiBundle\Api\Model\Repository|\ConnectHolland\DockerApiBundle\Api\Model\Error|\Psr\Http\Message\ResponseInterface|null
     */
    public function getRepository(string $user, string $name, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \ConnectHolland\DockerApiBundle\Api\Endpoint\GetRepository($user, $name), $fetch);
    }

    public static function create($httpClient = null, array $additionalPlugins = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins    = [];
            $uri        = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://hub.docker.com/v2');
            $plugins[]  = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[]  = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory  = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $serializer     = new \Symfony\Component\Serializer\Serializer([new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \ConnectHolland\DockerApiBundle\Api\Normalizer\JaneObjectNormalizer()], [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);

        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
