<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Model;

class FSLayer
{
    /**
     * @var string
     */
    protected $blobSum;

    public function getBlobSum(): string
    {
        return $this->blobSum;
    }

    public function setBlobSum(string $blobSum): self
    {
        $this->blobSum = $blobSum;

        return $this;
    }
}
