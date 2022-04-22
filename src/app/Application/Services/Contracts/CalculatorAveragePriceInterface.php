<?php

namespace App\Application\Services\Contracts;

use App\Domain\Entities\Operation\OperationEntity;

interface CalculatorAveragePriceInterface
{
    public function calculate(OperationEntity $operationEntity): float;
    public function updateQuantityActions(OperationEntity $operationEntity): void;
}