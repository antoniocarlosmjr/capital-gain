<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Application\Services\Contracts\CalculatorTaxInterface;
use App\Application\Services\Contracts\OperationServiceInterface;
use App\Domain\Entities\Operation\OperationArrayList;
use App\Enumerators\TypesOperationEnum;

class OperationService implements OperationServiceInterface
{
    public function __construct(
        private CalculatorAveragePriceInterface $calculatorAveragePrice,
        private CalculatorTaxInterface          $calculatorTax
    )
    {
    }

    public function calculateTaxOperations(OperationArrayList $listOperation): array
    {
        $tax = [];
        $averagePrice = 0;
        foreach ($listOperation->getAllOperations() as $operationEntity) {
            if ($operationEntity->getType() == TypesOperationEnum::BUY) {
                $averagePrice = $this->calculatorAveragePrice->calculate($operationEntity);
            }

            if ($operationEntity->getType() == TypesOperationEnum::SELL) {
                $this->calculatorAveragePrice->lessQuantityActions($operationEntity);
            }

            $tax[] = $this->calculatorTax->calculate($operationEntity, $averagePrice)->getTax();
        }

        return $tax;
    }
}