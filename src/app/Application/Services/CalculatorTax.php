<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorTaxInterface;
use App\Domain\Entities\Operation\OperationEntity;
use App\Domain\Entities\Tax\TaxEntity;
use App\Enumerators\TypesOperationEnum;

class CalculatorTax implements CalculatorTaxInterface
{
    private const PERCENT_TAX_FOR_OPERATION = 0.20;
    private const LIMIT_OPERATION_WITHOUT_TAX = 20000;

    private OperationEntity $operationEntity;

    private float $averagePrice;
    private int $totalPreviousLosses;

    public function __construct()
    {
        $this->totalPreviousLosses = 0;
    }

    public function calculate(OperationEntity $operationEntity, float $averagePrice): TaxEntity
    {
        $this->averagePrice = $averagePrice;
        $this->operationEntity = $operationEntity;

        if ($operationEntity->getType() == TypesOperationEnum::BUY) {
            return new TaxEntity(0);
        }

        if ($this->verifyFreePayTax()) {
            return $this->getTaxCalculatedForFreePayTax();
        }

        return $this->getTaxCalculated();
    }

    private function verifyFreePayTax(): bool
    {
        return $this->operationEntity->getTotalOperation() <= self::LIMIT_OPERATION_WITHOUT_TAX;
    }

    private function getTaxCalculatedForFreePayTax(): TaxEntity
    {
        if ($this->isLoss()) {
            $this->increaseTotalLoss();
        }

        return new TaxEntity(0);
    }

    private function getTaxCalculated(): TaxEntity
    {
        if ($this->isLoss()) {
            $this->increaseTotalLoss();
            return new TaxEntity(0);
        }

        if ($this->isProfit()) {
            $totalOperation = $this->operationEntity->getTotalOperation();
            $totalOperationWithAveragePrice = ($this->operationEntity->getQuantity() * $this->averagePrice);

            $profit = $totalOperation - $totalOperationWithAveragePrice;

            if ($this->totalPreviousLosses > 0) {
                $liquidProfit = $profit - $this->totalPreviousLosses;
                $this->totalPreviousLosses -= $profit;

                if ($liquidProfit > 0) {
                    return new TaxEntity($liquidProfit * self::PERCENT_TAX_FOR_OPERATION);
                }
            }
        }

        return new TaxEntity(0);
    }

    private function isLoss(): bool
    {
        return $this->operationEntity->getUnitCost() < $this->averagePrice;
    }

    private function isProfit(): bool
    {
        return $this->operationEntity->getUnitCost() > $this->averagePrice;
    }

    private function increaseTotalLoss(): void
    {
        $totalOperationWithAveragePrice = ($this->operationEntity->getQuantity() * $this->averagePrice);
        $totalOperation = $this->operationEntity->getTotalOperation();

        $this->totalPreviousLosses += $this->totalPreviousLosses + ($totalOperationWithAveragePrice - $totalOperation);
    }
}