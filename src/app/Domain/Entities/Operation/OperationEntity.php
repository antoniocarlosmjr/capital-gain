<?php

namespace App\Domain\Entities\Operation;

class OperationEntity
{
    public function __construct(
        private string $type,
        private float $unitCost,
        private int $quantity,
        private string $ticker
    )
    {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUnitCost(): float
    {
        return $this->unitCost;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalOperation(): float
    {
        return $this->unitCost * $this->quantity;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }
}