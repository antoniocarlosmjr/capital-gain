<?php

namespace Tests\Unit\Application\Services;

use App\Application\Services\CalculatorAveragePrice;
use App\Application\Services\CalculatorTax;
use App\Application\Services\OperationService;
use App\Domain\Entities\Operation\OperationArrayList;
use App\Domain\Entities\Operation\OperationEntity;
use App\Enumerators\TypesOperationEnum;
use App\Infra\Transformers\TaxTransformer;
use PHPUnit\Framework\TestCase;

class OperationServiceTest extends TestCase
{
    public function testWithOnlyBuys()
    {
        $operationList = new OperationArrayList();
        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                1000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                1000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                1000
            )
        );

        $service = new OperationService(
            new CalculatorAveragePrice(),
            new CalculatorTax()
        );

        $taxArrayList = $service->calculateTaxOperations($operationList);

        foreach ($taxArrayList->getAllTaxes() as $taxEntity) {
            self::assertEquals(0, $taxEntity->getTax());
        }
    }

    public function testeWithProfitAndLossInvolvendBuysAndSells()
    {
        $operationList = new OperationArrayList();
        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                20.00,
                5000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                5.00,
                5000
            )
        );

        $service = new OperationService(
            new CalculatorAveragePrice(),
            new CalculatorTax()
        );

        $taxArrayList = $service->calculateTaxOperations($operationList);
        $taxTransform = new TaxTransformer();
        $returnTaxes = $taxTransform->transformTax($taxArrayList);

        $expected = [['tax' => 0], ['tax' => 10000], ['tax' => 0]];

        self::assertEquals($expected, $returnTaxes);
    }

    public function testWithLossInvolvendBuysAndSells()
    {
        $operationList = new OperationArrayList();
        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                9.00,
                5000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                8.00,
                5000
            )
        );

        $service = new OperationService(
            new CalculatorAveragePrice(),
            new CalculatorTax()
        );

        $taxArrayList = $service->calculateTaxOperations($operationList);
        $taxTransform = new TaxTransformer();
        $returnTaxes = $taxTransform->transformTax($taxArrayList);

        $expected = [['tax' => 0], ['tax' => 0], ['tax' => 0]];

        self::assertEquals($expected, $returnTaxes);
    }

    public function testWithProfitInvolvendBuysAndSells()
    {
        $operationList = new OperationArrayList();
        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                50.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                20.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                50.00,
                10000
            )
        );

        $service = new OperationService(
            new CalculatorAveragePrice(),
            new CalculatorTax()
        );

        $taxArrayList = $service->calculateTaxOperations($operationList);
        $taxTransform = new TaxTransformer();
        $returnTaxes = $taxTransform->transformTax($taxArrayList);

        $expected = [['tax' => 0], ['tax' => 80000], ['tax' => 0], ['tax' => 60000]];

        self::assertEquals($expected, $returnTaxes);
    }

    public function testWithNeitherProfitNorLossInvolvendBuysAndSells()
    {
        $operationList = new OperationArrayList();
        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                10.00,
                10000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::BUY,
                25.00,
                5000
            )
        );

        $operationList->addOperation(
            new OperationEntity(
                TypesOperationEnum::SELL,
                15.00,
                10000
            )
        );

        $service = new OperationService(
            new CalculatorAveragePrice(),
            new CalculatorTax()
        );

        $taxArrayList = $service->calculateTaxOperations($operationList);
        $taxTransform = new TaxTransformer();
        $returnTaxes = $taxTransform->transformTax($taxArrayList);

        $expected = [['tax' => 0], ['tax' => 0], ['tax' => 0]];

        self::assertEquals($expected, $returnTaxes);
    }
}