<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Application\Services\Contracts\CalculatorDamageProfitInterface;
use App\Application\Services\Contracts\CalculatorTaxInterface;
use App\Application\Services\Contracts\OperationServiceInterface;
use App\Domain\Entities\Operation\OperationArrayList;
use App\Enumerators\TypesOperationEnum;

class OperationService implements OperationServiceInterface
{
    public function __construct(
        protected CalculatorAveragePriceInterface $calculatorAveragePrice,
        protected CalculatorDamageProfitInterface $calculatorDamageProfit,
        protected CalculatorTaxInterface $calculatorTax
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

            $tax[] = $this->calculatorTax->calculate($operationEntity, $averagePrice);
        }

        print_r($tax);
        exit;

        return $tax;
    }
}