<?php

namespace App\Exceptions;

use Exception;

class TickerInvalidException extends Exception
{
    public function __construct(string $message = "Ticker invalid")
    {
        parent::__construct($message);
    }
}