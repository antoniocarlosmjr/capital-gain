<?php

namespace App\Exceptions;

use Exception;

class OperationUnitCostInvalidException extends Exception
{
    public function __construct(string $message = "Unit cost is invalid")
    {
        parent::__construct($message);
    }
}