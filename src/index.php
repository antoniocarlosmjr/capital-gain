<?php

use App\Application\Services\CalculatorAveragePrice;
use App\Application\Services\CalculatorTax;
use App\Application\Services\OperationService;
use App\Infra\Factory\OperationFactory;
use App\Infra\Transformers\TaxTransformer;

require_once __DIR__.'/vendor/autoload.php';

$operationFactory = new OperationFactory();
$operationService = new OperationService(
    new CalculatorAveragePrice(),
    new CalculatorTax()
);
$taxTransformer = new TaxTransformer();

while (true) {
    $line = fgets(STDIN);
    $line = strtolower(trim($line));
    $operation = json_decode($line, true);

    if ($line == '') {
        break;
    }

    $operationArrayList = $operationFactory->createOperationFromArray($operation);
    $taxesArrayList = $operationService->calculateTaxOperations($operationArrayList);
    $allTaxes[] = $taxTransformer->transformTax($taxesArrayList);
}

foreach ($allTaxes as $tax) {
    fwrite(STDOUT, json_encode($tax) . PHP_EOL);
}