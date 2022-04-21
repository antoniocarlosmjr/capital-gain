<?php

namespace App\Infra\Validators;

use App\Enumerators\TypesOperationEnum;
use App\Exceptions\OperationInvalidException;
use App\Exceptions\OperationQuantityInvalidException;
use App\Exceptions\OperationUnitCostInvalidException;

class ValidatorOperation
{
    public const NUM_MIN_QUANTITY = 0;
    public const NUM_MIN_UNIT_COST = 0;

    public function validateLineOfOperation(array $operation): void
    {
        $this->validateOperation($operation['operation']);
        $this->validateUnitCost($operation['unit-cost']);
        $this->validateQuantity($operation['quantity']);
    }

    private function validateOperation(string $operation): void
    {
        $operations = TypesOperationEnum::getFields();

        if (!in_array($operation, $operations)) {
            throw new OperationInvalidException();
        }
    }

    private function validateUnitCost(float $unitCost): void
    {
        if ($unitCost <= self::NUM_MIN_UNIT_COST) {
            throw new OperationUnitCostInvalidException('Unit const cannot be negative');
        }
    }

    private function validateQuantity(int $quantity): void
    {
        if ($quantity <= self::NUM_MIN_QUANTITY) {
            throw new OperationQuantityInvalidException('Quantity cannot be negative');
        }
    }
}