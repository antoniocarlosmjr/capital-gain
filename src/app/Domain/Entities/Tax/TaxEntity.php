<?php

namespace App\Domain\Entities\Tax;

class TaxEntity
{
    public function __construct(
        protected float $value,
    )
    {
    }

    public function getTax(): float
    {
        return $this->value;
    }
}