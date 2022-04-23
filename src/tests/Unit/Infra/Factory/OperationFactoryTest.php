<?php

namespace Tests\Unit\Infra\Factory;

use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use App\Infra\Factory\OperationFactory;
use PHPUnit\Framework\TestCase;

class OperationFactoryTest extends TestCase
{
    public function testCreateOperationListFromArray()
    {
        $operation = [
            [
                'operation' => TypesOperationEnum::BUY,
                'unit-cost' => 10,
                'quantity' => 10000
            ]
        ];

        $operationFactory = new OperationFactory();
        $operationArrayList = $operationFactory->createOperationFromArray($operation);
        $expectedOperations = [
            new OperationEntity(
                TypesOperationEnum::BUY,
                10,
                10000
            )
        ];

        self::assertIsObject($operationArrayList);
        self::assertEquals($expectedOperations, $operationArrayList->getAllOperations());
    }
}