<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Domain\Entities\Operation\OperationEntity;

class CalculatorAveragePrice implements CalculatorAveragePriceInterface
{
    private float $averagePrice = 0;
    private int $quantityActions = 0;

    public function calculate(OperationEntity $operationEntity): float
    {
        $totalValueOperation = $operationEntity->getUnitCost() * $operationEntity->getQuantity();
        $divisor = (($this->quantityActions * $this->averagePrice) + $totalValueOperation);
        $dividend = ($this->quantityActions + $operationEntity->getQuantity());
        $this->averagePrice =  $divisor / $dividend;
        $this->quantityActions += $operationEntity->getQuantity();

        return $this->averagePrice;
    }

    public function lessQuantityActions(OperationEntity $operationEntity): void
    {
        $this->quantityActions -= $operationEntity->getQuantity();
    }
}