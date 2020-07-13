<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Model;

class RepositorySearchResults
{
    /**
     * @var RepositorySearch[]
     */
    protected $results;

    /**
     * @return RepositorySearch[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param RepositorySearch[] $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }
}
