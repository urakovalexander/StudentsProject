<?php

namespace App\Application\Exception;

use RuntimeException;

class LoginAlreadyExistsException extends RuntimeException
{
    public function __construct(string $login)
    {
        parent::__construct("Login '$login' is already in use.");
    }
}
