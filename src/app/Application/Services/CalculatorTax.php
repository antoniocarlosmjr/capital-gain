<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorTaxInterface;
use App\Domain\Entities\Operation\OperationEntity;
use App\Domain\Entities\Tax\TaxEntity;
use App\Enumerators\TypesOperationEnum;

class CalculatorTax implements CalculatorTaxInterface
{
    private const PERCENT_IMPOST_OBTAINED_FOR_OPERATION = 0.20;
    private const LIMIT_VALUE_OF_OPERATION_WITHOUT_IMPOST = 20000;

    public function calculate(OperationEntity $operationEntity, float $averagePrice): TaxEntity
    {
        if ($operationEntity->getType() == TypesOperationEnum::BUY) {
            return new TaxEntity(0);
        }

        return new TaxEntity(0);

        // calcular taxa para vendas aqui
        // se não for, paga taxa

    }
}