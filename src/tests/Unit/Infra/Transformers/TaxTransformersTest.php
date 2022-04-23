<?php

namespace Tests\Unit\Infra\Transformers;

use App\Domain\Entities\Tax\TaxArrayList;
use App\Domain\Entities\Tax\TaxEntity;
use App\Infra\Transformers\TaxTransformer;
use PHPUnit\Framework\TestCase;

class TaxTransformersTest extends TestCase
{
    public function testWithArrayTaxsFormatedSuccess()
    {
        $taxArrayList = new TaxArrayList();
        $taxArrayList->addTax(
            new TaxEntity(0)
        );

        $taxArrayList->addTax(
            new TaxEntity(50)
        );

        $taxArrayList->addTax(
            new TaxEntity(60)
        );

        $taxTransform = new TaxTransformer();
        $return = $taxTransform->transformTax($taxArrayList);
        $expected = [['tax' => 0], ['tax' => 50], ['tax' => 60]];

        self::assertEquals($expected, $return);
    }

    public function testWithArrayEmpty()
    {
        $taxArrayList = new TaxArrayList();
        $taxTransform = new TaxTransformer();
        $return = $taxTransform->transformTax($taxArrayList);
        $expected = [];

        self::assertEquals($expected, $return);
    }
}