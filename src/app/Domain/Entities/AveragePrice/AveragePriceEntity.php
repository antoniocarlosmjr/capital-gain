<?php

namespace App\Domain\Entities\AveragePrice;

class AveragePriceEntity
{
    public function __construct(
        protected float $averagePrice,
    )
    {
    }

    public function getAveragePrice(): float
    {
        return $this->averagePrice;
    }
}