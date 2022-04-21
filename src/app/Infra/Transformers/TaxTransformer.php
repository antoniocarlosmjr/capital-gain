<?php

namespace App\Infra\Transformers;

class TaxTransformer
{
    public function toStringTax(array $taxesArrayList): string
    {
        $arrayFormated = [];
        foreach ($taxesArrayList as $arrayList => $values) {

        }

        return json_encode($arrayFormated);
    }
}