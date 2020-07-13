<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Model;

class Manifests
{
    /**
     * @var int
     */
    protected $schemaVersion;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $tag;
    /**
     * @var string
     */
    protected $architecture;
    /**
     * @var FSLayer[]
     */
    protected $fsLayers;
    /**
     * @var History[]
     */
    protected $history;
    /**
     * @var Signature[]
     */
    protected $signatures;

    public function getSchemaVersion(): int
    {
        return $this->schemaVersion;
    }

    public function setSchemaVersion(int $schemaVersion): self
    {
        $this->schemaVersion = $schemaVersion;

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

    public function getTag(): string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getArchitecture(): string
    {
        return $this->architecture;
    }

    public function setArchitecture(string $architecture): self
    {
        $this->architecture = $architecture;

        return $this;
    }

    /**
     * @return FSLayer[]
     */
    public function getFsLayers(): array
    {
        return $this->fsLayers;
    }

    /**
     * @param FSLayer[] $fsLayers
     */
    public function setFsLayers(array $fsLayers): self
    {
        $this->fsLayers = $fsLayers;

        return $this;
    }

    /**
     * @return History[]
     */
    public function getHistory(): array
    {
        return $this->history;
    }

    /**
     * @param History[] $history
     */
    public function setHistory(array $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * @return Signature[]
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }

    /**
     * @param Signature[] $signatures
     */
    public function setSignatures(array $signatures): self
    {
        $this->signatures = $signatures;

        return $this;
    }
}
