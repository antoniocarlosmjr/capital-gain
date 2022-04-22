<?php

namespace App\Application\Services\Contracts;

use App\Domain\Entities\Operation\OperationArrayList;

interface OperationServiceInterface
{
    public function calculateTaxOperations(OperationArrayList $listOperation): array;
}