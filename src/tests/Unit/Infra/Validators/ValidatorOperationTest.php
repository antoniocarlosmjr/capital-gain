<?php

namespace Tests\Unit\Infra\Validators;

use App\Enumerators\TypesOperationEnum;
use App\Exceptions\OperationInvalidException;
use App\Exceptions\OperationQuantityInvalidException;
use App\Exceptions\OperationUnitCostInvalidException;
use App\Infra\Validators\ValidatorOperation;
use PHPUnit\Framework\TestCase;

class ValidatorOperationTest extends TestCase
{
    public function testValidateWithErrorOperation()
    {
        $operation = [
            'operation' => 'OTHER',
            'unit-cost' => 10,
            'quantity' => 10000
        ];

        $this->expectException(OperationInvalidException::class);
        $validatorOperation = new ValidatorOperation();
        $validatorOperation->validateLineOfOperation($operation);
    }

    public function testValidateWithErrorUnitCost()
    {
        $operation = [
            'operation' => TypesOperationEnum::BUY,
            'unit-cost' => -10,
            'quantity' => 10000
        ];

        $this->expectException(OperationUnitCostInvalidException::class);
        $validatorOperation = new ValidatorOperation();
        $validatorOperation->validateLineOfOperation($operation);
    }

    public function testValidateWithErrorQuantity()
    {
        $operation = [
            'operation' => TypesOperationEnum::BUY,
            'unit-cost' => 10,
            'quantity' => -7777
        ];

        $this->expectException(OperationQuantityInvalidException::class);
        $validatorOperation = new ValidatorOperation();
        $validatorOperation->validateLineOfOperation($operation);
    }
}