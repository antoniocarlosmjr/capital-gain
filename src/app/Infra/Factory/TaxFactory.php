<?php

namespace App\Infra\Factory;

use App\Domain\Entities\Tax\TaxArrayList;
use App\Domain\Entities\Tax\TaxEntity;

class TaxFactory
{
    public function createTaxFromArray(array $taxes): TaxArrayList
    {
        $taxArrayList = new TaxArrayList();

        foreach ($taxes as $tax) {
            $taxEntity = new TaxEntity($tax);
            $taxArrayList->addTax($taxEntity);
        }

        return $taxArrayList;
    }
}