<?php

namespace App\Infra\Transformers;

use App\Domain\Entities\Tax\TaxArrayList;

class TaxTransformer
{
    public function transformTax(TaxArrayList $taxesArrayList): array
    {
        $allTaxes = $taxesArrayList->getAllTaxes();
        $arrayFormated = [];
        foreach ($allTaxes as $taxEntity) {
            $arrayFormated[] = ['tax' => $taxEntity->getTax()];
        }

        return $arrayFormated;
    }
}