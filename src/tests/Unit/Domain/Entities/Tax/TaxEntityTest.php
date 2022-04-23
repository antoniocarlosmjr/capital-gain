<?php

namespace Tests\Unit\Domain\Entities\Tax;

use App\Domain\Entities\Tax\TaxEntity;
use PHPUnit\Framework\TestCase;

class TaxEntityTest extends TestCase
{
    public function testOperationConstruct()
    {
        $tax = new TaxEntity(1000);
        self::assertEquals(1000, $tax->getTax());
    }
}