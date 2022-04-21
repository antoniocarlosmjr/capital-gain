<?php

namespace App\Application\Services;

use App\Domain\Entities\Operation\OperationEntity;

class CalculatorTax
{
    private const PERCENT_IMPOST = 0.2;
    private const LIMIT_VALUE_OF_OPERATION_WITHOUT_IMPOST = 20000;

    public function calculate(OperationEntity $operationEntity)
    {
        // lembrar de verificar se é buy não paga taxa.
        // se não for, paga taxa
    }
}