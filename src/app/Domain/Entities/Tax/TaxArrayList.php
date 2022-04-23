<?php

namespace App\Domain\Entities\Tax;

class TaxArrayList
{
    public function __construct(
        private array $taxes = []
    )
    {
    }

    public function addTax(TaxEntity $newTax): void
    {
        $this->taxes[] = $newTax;
    }

    public function getAllTaxes(): array
    {
        return $this->taxes;
    }
}