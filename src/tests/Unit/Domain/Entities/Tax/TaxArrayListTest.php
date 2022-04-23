<?php

namespace Tests\Unit\Domain\Entities\Tax;

use App\Domain\Entities\Tax\TaxArrayList;
use App\Domain\Entities\Tax\TaxEntity;
use PHPUnit\Framework\TestCase;

class TaxArrayListTest extends TestCase
{
    public function testGetAllTaxs()
    {
        $taxEntityOne = new TaxEntity(0);
        $taxEntityTwo = new TaxEntity(500);

        $taxArrayList = new TaxArrayList();
        $taxArrayList->addTax($taxEntityOne);
        $taxArrayList->addTax($taxEntityTwo);

        $allTaxes = $taxArrayList->getAllTaxes();
        $expected = [$taxEntityOne, $taxEntityTwo];

        self::assertEquals($expected, $allTaxes);
    }
}