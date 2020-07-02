<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerHubApiBundle\Api\Model;

class RepositoryPermissions
{
    /**
     * @var bool
     */
    protected $read;
    /**
     * @var bool
     */
    protected $write;
    /**
     * @var bool
     */
    protected $admin;

    public function getRead(): bool
    {
        return $this->read;
    }

    public function setRead(bool $read): self
    {
        $this->read = $read;

        return $this;
    }

    public function getWrite(): bool
    {
        return $this->write;
    }

    public function setWrite(bool $write): self
    {
        $this->write = $write;

        return $this;
    }

    public function getAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
