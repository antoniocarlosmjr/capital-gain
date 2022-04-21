<?php

namespace App\Domain\Entities\Operation;

class OperationArrayList
{
    private array $operations;

    public function __construct()
    {
        $this->operations = [];
    }

    public function addOperation(OperationEntity $newOperation): void
    {
        $this->operations[] = $newOperation;
    }

    public function getAllOperations(): array
    {
        return $this->operations;
    }
}