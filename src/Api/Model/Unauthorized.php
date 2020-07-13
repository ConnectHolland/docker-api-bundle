<?php

declare(strict_types=1);

/*
 * This file is part of the docker-api bundle package.
 * (c) Connect Holland.
 */

namespace ConnectHolland\DockerApiBundle\Api\Model;

class Unauthorized
{
    /**
     * @var UnauthorizedErrors
     */
    protected $errors;

    public function getErrors(): UnauthorizedErrors
    {
        return $this->errors;
    }

    public function setErrors(UnauthorizedErrors $errors): self
    {
        $this->errors = $errors;

        return $this;
    }
}
