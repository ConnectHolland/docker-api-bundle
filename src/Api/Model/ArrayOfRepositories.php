<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Model;

class ArrayOfRepositories
{
    /**
     * @var Repository[]
     */
    protected $results;

    /**
     * @return Repository[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param Repository[] $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }
}
