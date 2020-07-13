<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Model;

class History
{
    /**
     * @var string
     */
    protected $v1Compatibility;

    public function getV1Compatibility(): string
    {
        return $this->v1Compatibility;
    }

    public function setV1Compatibility(string $v1Compatibility): self
    {
        $this->v1Compatibility = $v1Compatibility;

        return $this;
    }
}
