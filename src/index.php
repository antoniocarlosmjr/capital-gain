<?php

use App\Application\Services\OperationService;
use App\Infra\Factory\OperationFactory;
use App\Infra\Factory\TaxFactory;
use App\Infra\Transformers\TaxTransformer;

require_once __DIR__.'/vendor/autoload.php';

$operationFactory = new OperationFactory();
$operationService = new OperationService();
$taxFactory = new TaxFactory();
$taxTransformer = new TaxTransformer();

while (true) {
    $line = fgets(STDIN);
    $line = strtolower(trim($line));
    $operation = json_decode($line, true);

    if ($line == '') {
        break;
    }

    $operationArrayList = $operationFactory->createOperationFromArray($operation);
    $taxList = $operationService->calculateTax($operationArrayList);
    $taxesArrayList[] = $taxFactory->createTaxFromArray($taxList);
}

$arrayTaxes = $taxTransformer->transformTax($taxesArrayList);
foreach ($arrayTaxes as $tax) {
    fwrite(STDOUT, json_encode($tax) . PHP_EOL);
}