<?php

namespace App\Application\Services\Contracts;

use App\Domain\Entities\Operation\OperationArrayList;
use App\Domain\Entities\Tax\TaxArrayList;

interface OperationServiceInterface
{
    public function calculateTaxOperations(OperationArrayList $listOperation): TaxArrayList;
}