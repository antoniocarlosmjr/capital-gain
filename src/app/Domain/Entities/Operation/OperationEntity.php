<?php

namespace App\Domain\Entities\Operation;

class OperationEntity
{
    public function __construct(
        protected string $type,
        protected float $unitCost,
        protected int $quantity
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

}