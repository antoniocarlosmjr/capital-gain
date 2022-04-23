<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Domain\Entities\Operation\OperationEntity;

class CalculatorAveragePrice implements CalculatorAveragePriceInterface
{
    private float $averagePrice;
    private int $quantityActions;

    public function __construct()
    {
        $this->averagePrice = 0;
        $this->quantityActions = 0;
    }

    public function calculate(OperationEntity $operationEntity): float
    {
        $divisor = (($this->quantityActions * $this->averagePrice) + $operationEntity->getTotalOperation());
        $dividend = ($this->quantityActions + $operationEntity->getQuantity());
        $this->averagePrice =  round(($divisor / $dividend), 2);
        $this->quantityActions += $operationEntity->getQuantity();

        return $this->averagePrice;
    }

    public function lessQuantityActions(OperationEntity $operationEntity): void
    {
        $this->quantityActions -= $operationEntity->getQuantity();
    }
}