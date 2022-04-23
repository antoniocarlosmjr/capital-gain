<?php

namespace Tests\Unit\Application\Services;

use App\Application\Services\CalculatorAveragePrice;
use App\Domain\Entities\Operation\OperationArrayList;
use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use PHPUnit\Framework\TestCase;

class CalculatorAveragePriceTest extends TestCase
{
    public function testCalculationAverageOperationRandom()
    {
        $randomOperationEntity = new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            random_int(1, 999)
        );
        
        $calculator = new CalculatorAveragePrice();
        $averagePrice = $calculator->calculate($randomOperationEntity);

        self::assertIsFloat($averagePrice);
    }

    public function testCalculationAverageWithOneEspecificOperation()
    {
        $randomOperationEntity = new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            1000
        );

        $calculator = new CalculatorAveragePrice();
        $averagePrice = $calculator->calculate($randomOperationEntity);

        self::assertIsFloat($averagePrice);
        self::assertEquals(10, $averagePrice);
    }

    public function testCalculationAverageWithMoreThanOneOperation()
    {
        $listOperation = new OperationArrayList();
        $listOperation->addOperation(new OperationEntity(
            TypesOperationEnum::BUY,
            20.00,
            10
        ));
        $listOperation->addOperation(new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            5
        ));

        $calculator = new CalculatorAveragePrice();
        foreach ($listOperation->getAllOperations() as $operation) {
            $averagePrice = $calculator->calculate($operation);
        }

        self::assertIsFloat($averagePrice);
        self::assertEquals(16.67, $averagePrice);
    }

    public function testCalculationAverageWithBuyAndSell()
    {
        $listOperation = new OperationArrayList();
        $listOperation->addOperation(new OperationEntity(
            TypesOperationEnum::BUY,
            20.00,
            10
        ));

        $listOperation->addOperation(new OperationEntity(
            TypesOperationEnum::SELL,
            10.00,
            5
        ));

        $listOperation->addOperation(new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            5
        ));

        $calculator = new CalculatorAveragePrice();
        foreach ($listOperation->getAllOperations() as $operation) {
            if ($operation->getType() == TypesOperationEnum::SELL) {
                $calculator->lessQuantityActions($operation);
                continue;
            }

            $averagePrice = $calculator->calculate($operation);
        }

        self::assertIsFloat($averagePrice);
        self::assertEquals(15, $averagePrice);
    }
}