<?php

namespace App\Infra\Transformers;

class TaxTransformer
{
    public function transformTax(array $taxesArrayList): array
    {
        $arrayFormated = [];
        foreach ($taxesArrayList as $indexArrayList => $taxArrayList) {
            $taxes = $taxArrayList->getAllTaxes();
            $taxesOfOperation = [];

            foreach ($taxes as $index => $taxEntity) {
                $taxesOfOperation[] = ['tax' => $taxEntity->getTax()];
            }
            $arrayFormated[] = $taxesOfOperation;
        }
        return $arrayFormated;
    }
}