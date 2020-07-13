<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Authentication;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Authentication\BasicAuth;
use Jane\OpenApiRuntime\Client\AuthenticationPlugin;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

class RegistryAuthAuthentication implements AuthenticationPlugin
{
    private const LOGIN_PULL_SCOPE_URI_PATTERN = 'https://auth.docker.io/token?service=registry.docker.io&scope=repository:%s:pull';
    private const REGISTRY_URI                 = 'https://registry-1.docker.io/';

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $token;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    public function __construct(string $username, string $token, $httpClient = null)
    {
        $this->username   = $username;
        $this->token      = $token;
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
    }

    public function authentication(RequestInterface $request): RequestInterface
    {
        $pathParts  = explode('/', $request->getUri()->getPath());
        $user       = $pathParts[2];
        $name       = $pathParts[3];
        $repository = sprintf('%s/%s', $user, $name);

        $authRequest = Psr17FactoryDiscovery::findRequestFactory()->createRequest('GET', sprintf(self::LOGIN_PULL_SCOPE_URI_PATTERN, $repository));
        $data        = $this->httpClient->sendRequest((new BasicAuth($this->username, $this->token))->authenticate($authRequest));
        $token       = json_decode($data->getBody()->getContents(), true)['token'];

        $request = $request->withHeader('Authorization', sprintf('Bearer %s', $token));
        $request = $request->withHeader('Accept', 'application/vnd.docker.distribution.manifest.v1+prettyjws');

        // Jane-php does not handle multiple API server very well
        $request = $request->withUri($request->getUri()->withHost(parse_url(self::REGISTRY_URI, PHP_URL_HOST)));

        return $request;
    }

    public function getScope(): string
    {
        return 'registryAuth';
    }
}
