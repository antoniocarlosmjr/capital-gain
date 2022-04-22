<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;

class CalculatorAveragePrice implements CalculatorAveragePriceInterface
{
    private float $averagePrice = 0;
    private float $quantityActions;

    public function calculate(OperationEntity $operationEntity): float
    {
        $totalValueOperation = $operationEntity->getUnitCost() * $operationEntity->getQuantity();
        $this->averagePrice = ($this->quantityActions * $this->averagePrice) + $totalValueOperation / $this->quantityActions;
        return $this->averagePrice;
    }

    public function updateQuantityActions(OperationEntity $operationEntity): void
    {
        $this->quantityActions = $operationEntity->getType() == TypesOperationEnum::BUY
            ? +$operationEntity->getQuantity()
            : -$operationEntity->getQuantity();
    }
}