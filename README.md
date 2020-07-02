# Connect Holland Docker Hub API Bundle

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-hub-api-bundle/build-status/master)

Docker Hub API bundle to connect to hub.docker.com/v2/ for Symfony 4/5 projects

## Installation
```bash
composer require connectholland/docker-hub-api-bundle
```

## Environment

Set the environment variables to authenticate

```dotenv
DOCKER_HUB_API_USERNAME=example@example.com
DOCKER_HUB_API_TOKEN=token

```

## Usage
Autowire the client, e.g.:

```php
<?php

declare(strict_types=1);

namespace App;

use ConnectHolland\DockerHubApiBundle\Api\Client;

class SomeService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function someMethod()
    {
        $query = 'connectholland';
        $this->client->findRepositories($query);
    }
}
```

