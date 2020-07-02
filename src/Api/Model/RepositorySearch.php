<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Model;

class RepositorySearch
{
    /**
     * @var string
     */
    protected $repoName;
    /**
     * @var string
     */
    protected $shortDescription;
    /**
     * @var int
     */
    protected $starCount;
    /**
     * @var int
     */
    protected $pullCount;
    /**
     * @var string
     */
    protected $repoOwner;
    /**
     * @var \DateTimeInterface|null
     */
    protected $lastUpdated;
    /**
     * @var bool
     */
    protected $isAutomated;
    /**
     * @var bool
     */
    protected $isOfficial;

    public function getRepoName(): string
    {
        return $this->repoName;
    }

    public function setRepoName(string $repoName): self
    {
        $this->repoName = $repoName;

        return $this;
    }

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getStarCount(): int
    {
        return $this->starCount;
    }

    public function setStarCount(int $starCount): self
    {
        $this->starCount = $starCount;

        return $this;
    }

    public function getPullCount(): int
    {
        return $this->pullCount;
    }

    public function setPullCount(int $pullCount): self
    {
        $this->pullCount = $pullCount;

        return $this;
    }

    public function getRepoOwner(): string
    {
        return $this->repoOwner;
    }

    public function setRepoOwner(string $repoOwner): self
    {
        $this->repoOwner = $repoOwner;

        return $this;
    }

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?\DateTimeInterface $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getIsAutomated(): bool
    {
        return $this->isAutomated;
    }

    public function setIsAutomated(bool $isAutomated): self
    {
        $this->isAutomated = $isAutomated;

        return $this;
    }

    public function getIsOfficial(): bool
    {
        return $this->isOfficial;
    }

    public function setIsOfficial(bool $isOfficial): self
    {
        $this->isOfficial = $isOfficial;

        return $this;
    }
}
