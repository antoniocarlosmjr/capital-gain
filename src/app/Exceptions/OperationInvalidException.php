<?php

namespace App\Exceptions;

use Exception;

class OperationInvalidException extends Exception
{
    public function __construct(string $message = "Operation invalid")
    {
        parent::__construct($message);
    }
}