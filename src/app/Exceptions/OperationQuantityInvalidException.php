<?php

namespace App\Exceptions;

use Exception;

class OperationQuantityInvalidException extends Exception
{
    public function __construct(string $message = "Quantity is invalid")
    {
        parent::__construct($message);
    }
}