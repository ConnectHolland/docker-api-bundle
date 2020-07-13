<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Plugins;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class FixManifestResponseContentTypePlugin implements Plugin
{
    public const MANIFEST_CONTENT_TYPE = 'application/vnd.docker.distribution.manifest.v1+prettyjws';

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(function (ResponseInterface $response) {
            if ($response->getHeaderLine('Content-Type') === self::MANIFEST_CONTENT_TYPE) {
                return $response->withHeader('Content-Type', 'application/json');
            }

            return $response;
        });
    }
}
