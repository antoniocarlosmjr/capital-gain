<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\CalculatorAveragePriceInterface;
use App\Domain\Entities\Operation\OperationEntity;

class CalculatorAveragePrice implements CalculatorAveragePriceInterface
{
    private float $averagePrice;
    private float $quantityActions;

    /*

    formula = ((quantidade-de-acoes-atual * media-ponderada-atual) + (quantidade-de-acoes * valor-de-compra))
                 / (quantidade-de-acoes-atual + quantidadede-acoes-compradas)
     */

    public function calculate(OperationEntity $operationEntity): float
    {
        return 0;
    }
}