<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Exception;

class GetManifestsUnauthorizedException extends \RuntimeException implements ClientException
{
    private $unauthorized;

    public function __construct(\ConnectHolland\DockerHubApiBundle\Api\Model\Unauthorized $unauthorized)
    {
        parent::__construct('Unauthorized', 401);
        $this->unauthorized = $unauthorized;
    }

    public function getUnauthorized()
    {
        return $this->unauthorized;
    }
}
