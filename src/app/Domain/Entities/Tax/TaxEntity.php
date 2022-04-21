<?php

namespace App\Domain\Entities\Tax;

class TaxEntity
{
    public function __construct(
        protected float $valueOfTax,
    )
    {
    }

    public function getTax(): float
    {
        return $this->valueOfTax;
    }
}