<?php

namespace Tests\Unit\Domain\Entities\Operation;

use App\Domain\Entities\Operation\OperationArrayList;
use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use PHPUnit\Framework\TestCase;

class OperationArrayListTest extends TestCase
{
    public function testGetAllOperations()
    {
        $operationEntityOne = new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            5000
        );
        $operationEntityTwo = new OperationEntity(
            TypesOperationEnum::BUY,
            15.00,
            1000
        );

        $operationArrayList = new OperationArrayList();
        $operationArrayList->addOperation($operationEntityOne);
        $operationArrayList->addOperation($operationEntityTwo);

        $allOperations = $operationArrayList->getAllOperations();
        $expected = [
            $operationEntityOne,
            $operationEntityTwo
        ];

        self::assertEquals($expected, $allOperations);
    }
}