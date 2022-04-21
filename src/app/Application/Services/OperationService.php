<?php

namespace App\Application\Services;

use App\Domain\Entities\Operation\OperationArrayList;

class OperationService
{
    public function calculateTax(OperationArrayList $listOperation): array
    {
        // percorrer a lista de operacoes e calcular a taxa por cada operacao
        // cumulativa
        return [10.44, 55.55, 66.33];
    }
}