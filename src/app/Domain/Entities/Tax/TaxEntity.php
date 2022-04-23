<?php

namespace App\Domain\Entities\Tax;

class TaxEntity
{
    public function __construct(
        private float $value,
    )
    {
    }

    public function getTax(): float
    {
        return sprintf("%.2f", $this->value);
    }
}