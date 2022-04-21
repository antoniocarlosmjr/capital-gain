<?php

namespace App\Infra\Factory;

use App\Domain\Entities\Operation\OperationArrayList;
use App\Domain\Entities\Operation\OperationEntity;
use App\Infra\Validators\ValidatorOperation;

class OperationFactory
{
    public function createOperationFromArray(array $operation): OperationArrayList
    {
        $operationArrayList = new OperationArrayList();
        $validatorOperator = new ValidatorOperation();

        foreach ($operation as $index => $value) {
            $validatorOperator->validateLineOfOperation($value);
            $operationEntity = new OperationEntity(
                $value['operation'],
                $value['unit-cost'],
                $value['quantity']
            );
            $operationArrayList->addOperation($operationEntity);
        }
        return $operationArrayList;
    }
}