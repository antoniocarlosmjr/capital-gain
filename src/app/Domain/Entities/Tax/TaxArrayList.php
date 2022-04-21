<?php

namespace App\Domain\Entities\Tax;

use App\Domain\Entities\Operation\OperationEntity;

class TaxArrayList
{
    private array $taxes;

    public function __construct()
    {
        $this->taxes = [];
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