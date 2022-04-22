<?php

namespace App\Application\Services\Contracts;

use App\Domain\Entities\Operation\OperationEntity;
use App\Domain\Entities\Tax\TaxEntity;

interface CalculatorTaxInterface
{
    public function calculate(OperationEntity $operationEntity, float $averagePrice): TaxEntity;
}