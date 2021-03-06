<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Tests\Api;

use ConnectHolland\DockerApiBundle\Api\Client;
use ConnectHolland\DockerApiBundle\Api\Model\Manifests;
use ConnectHolland\DockerApiBundle\Api\Model\Repository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ClientTest extends KernelTestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp(): void
    {
        $kernel       = self::bootKernel();
        $this->client = $kernel->getContainer()->get(Client::class);
    }

    public function testGetManifests()
    {
        $manifests = $this->client->getManifests('library', 'ubuntu', 'latest');

        $this->assertInstanceOf(Manifests::class, $manifests);
    }

    public function testFindRepositories()
    {
        $repositories = $this->client->findRepositories(['query' => 'alpine'])->getResults();

        $this->assertIsArray($repositories);
    }

    public function testGetRepository()
    {
        $repository = $this->client->getRepository('library', 'php');

        $this->assertInstanceOf(Repository::class, $repository);
    }
}
