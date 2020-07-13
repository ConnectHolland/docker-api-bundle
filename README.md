# Connect Holland Docker API Bundle

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ConnectHolland/docker-api-bundle/build-status/master)

Docker API bundle to connect to hub.docker.com/v2/ and registry-1.docker.io/v2/ for Symfony 4/5 projects

## Installation
```bash
composer require connectholland/docker-api-bundle
```

## Environment

Set the environment variables to authenticate

```dotenv
DOCKER_API_USERNAME=example@example.com
DOCKER_API_TOKEN=token

```

## Usage
Autowire the client, e.g.:

```php
<?php

declare(strict_types=1);

namespace App;

use ConnectHolland\DockerApiBundle\Api\Client;

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

