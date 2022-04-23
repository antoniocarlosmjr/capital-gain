<?php

namespace Tests\Unit\Application\Services;

use App\Application\Services\CalculatorTax;
use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use PHPUnit\Framework\TestCase;

class CalculatorTaxTest extends TestCase
{
    public function testCalculateTaxForBuy()
    {
        $operationEntity = new OperationEntity(
            TypesOperationEnum::BUY,
            10.00,
            10000
        );
        $calculatorTax = new CalculatorTax();
        $tax = $calculatorTax->calculate($operationEntity, 0);

        self::assertEquals(0, $tax->getTax());
    }

    public function testCalculateTaxFreePayTax()
    {
        $operationEntity = new OperationEntity(
            TypesOperationEnum::SELL,
            10.00,
            5
        );

        $calculatorTax = new CalculatorTax();
        $tax = $calculatorTax->calculate($operationEntity, 0);

        self::assertEquals(0, $tax->getTax());
    }

    public function testCalculateTaxWithLess()
    {
        $operationEntity = new OperationEntity(
            TypesOperationEnum::SELL,
            20.00,
            10000
        );

        $averagePrice = 30;
        $calculatorTax = new CalculatorTax();
        $tax = $calculatorTax->calculate($operationEntity, $averagePrice);

        self::assertEquals(0, $tax->getTax());
    }

    public function testCalculateTaxWithProfit()
    {
        $operationEntity = new OperationEntity(
            TypesOperationEnum::SELL,
            20.00,
            10000
        );

        $averagePrice = 10;
        $calculatorTax = new CalculatorTax();
        $tax = $calculatorTax->calculate($operationEntity, $averagePrice);

        self::assertEquals(20000, $tax->getTax());
    }
}