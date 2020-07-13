<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Model;

class Repository
{
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $namespace;
    /**
     * @var string
     */
    protected $repositoryType;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string|null
     */
    protected $description;
    /**
     * @var bool
     */
    protected $isPrivate;
    /**
     * @var bool
     */
    protected $isAutomated;
    /**
     * @var bool
     */
    protected $canEdit;
    /**
     * @var int
     */
    protected $starCount;
    /**
     * @var int
     */
    protected $pullCount;
    /**
     * @var \DateTimeInterface|null
     */
    protected $lastUpdated;
    /**
     * @var bool
     */
    protected $isMigrated;
    /**
     * @var bool
     */
    protected $hasStarred;
    /**
     * @var string|null
     */
    protected $fullDescription;
    /**
     * @var string|null
     */
    protected $affiliation;
    /**
     * @var RepositoryPermissions
     */
    protected $permissions;

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getRepositoryType(): string
    {
        return $this->repositoryType;
    }

    public function setRepositoryType(string $repositoryType): self
    {
        $this->repositoryType = $repositoryType;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPrivate(): bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

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

    public function getCanEdit(): bool
    {
        return $this->canEdit;
    }

    public function setCanEdit(bool $canEdit): self
    {
        $this->canEdit = $canEdit;

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

    public function getLastUpdated(): ?\DateTimeInterface
    {
        return $this->lastUpdated;
    }

    public function setLastUpdated(?\DateTimeInterface $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    public function getIsMigrated(): bool
    {
        return $this->isMigrated;
    }

    public function setIsMigrated(bool $isMigrated): self
    {
        $this->isMigrated = $isMigrated;

        return $this;
    }

    public function getHasStarred(): bool
    {
        return $this->hasStarred;
    }

    public function setHasStarred(bool $hasStarred): self
    {
        $this->hasStarred = $hasStarred;

        return $this;
    }

    public function getFullDescription(): ?string
    {
        return $this->fullDescription;
    }

    public function setFullDescription(?string $fullDescription): self
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(?string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getPermissions(): RepositoryPermissions
    {
        return $this->permissions;
    }

    public function setPermissions(RepositoryPermissions $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }
}
