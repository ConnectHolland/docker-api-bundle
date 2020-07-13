<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Authentication;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Jane\OpenApiRuntime\Client\AuthenticationPlugin;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

class HubAuthAuthentication implements AuthenticationPlugin
{
    private const LOGIN_URI = 'https://hub.docker.com/v2/users/login/';

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
        static $token = null;

        if (is_null($token)) {
            $authRequest = Psr17FactoryDiscovery::findRequestFactory()->createRequest('POST', self::LOGIN_URI);
            $authBody    = Psr17FactoryDiscovery::findStreamFactory()->createStream(sprintf('{"username": "%s", "password": "%s"}', $this->username, $this->token));

            $authRequest   = $authRequest->withBody($authBody)->withHeader('Content-Type', 'application/json');
            $tokenResponse = $this->httpClient->sendRequest($authRequest);
            if ($tokenResponse->getStatusCode() !== 200) {
                throw new \Exception(json_decode($tokenResponse->getBody()->getContents(), true)['detail']);
            }
            $token = json_decode($tokenResponse->getBody()->getContents(), true)['token'];
        }

        return $request->withHeader('Authorization', sprintf('JWT %s', $token));
    }

    public function getScope(): string
    {
        return 'hubAuth';
    }
}
