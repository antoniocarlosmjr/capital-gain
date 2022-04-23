<?php

namespace Tests\Unit\Domain\Entities\Operation;

use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use PHPUnit\Framework\TestCase;

class OperationEntityTest extends TestCase
{
    public function testOperationConstruct()
    {
        $operation = new OperationEntity(
            TypesOperationEnum::BUY,
            10,
            10000
        );

        self::assertEquals(TypesOperationEnum::BUY, $operation->getType());
        self::assertEquals(10, $operation->getUnitCost());
        self::assertEquals(10000, $operation->getQuantity());
    }

    public function testTotalOperation()
    {
        $operation = new OperationEntity(
            TypesOperationEnum::BUY,
            10,
            10000
        );

        self::assertEquals((10*10000), $operation->getTotalOperation());
    }
}