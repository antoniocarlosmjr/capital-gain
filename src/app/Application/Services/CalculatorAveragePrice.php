<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Domain\Entities\Operation\OperationArrayList;
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
        $dividend = (($this->quantityActions * $this->averagePrice) + $operationEntity->getTotalOperation());
        $divisor = ($this->quantityActions + $operationEntity->getQuantity());
        $this->averagePrice =  round(($dividend / $divisor), 2);
        $this->quantityActions += $operationEntity->getQuantity();

        return $this->averagePrice;
    }

    public function getAveragePrice(OperationArrayList $listOperation): array
    {
        $listAveragePriceForTicker = [];
        foreach ($listOperation as $operationEntity) {
            $listAveragePriceForTicker[$operationEntity->getTicker()]['averagePrice']
            $listAveragePriceForTicker[$operationEntity->getTicker()]['averagePrice']
            $listAveragePriceForTicker[$operationEntity->getTicker()] = $this->calculate($operationEntity);
        }
        return $listAveragePriceForTicker;
    }

    public function lessQuantityActions(OperationEntity $operationEntity): void
    {
        $this->quantityActions -= $operationEntity->getQuantity();
    }
}