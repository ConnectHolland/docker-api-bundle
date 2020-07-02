<?php

declare(strict_types=1);

/*
 * This file is part of the docker-hub-api bundle package.
 * (c) Connect Holland.
 */

return [
    'openapi-file'          => __DIR__.'/openapi-spec.yaml',
    'namespace'             => 'ConnectHolland\DockerHubApiBundle\Api',
    'directory'             => __DIR__.'/../../Api',
    'strict'                => true,
    'clean-generated'       => true,
    'use-fixer'             => true,
    'date-format'           => 'Y-m-d\\TH:i:s.uP',
    'date-prefer-interface' => true,
    'fixer-config-file'     => __DIR__.'/../../../.php_cs.dist',
];
