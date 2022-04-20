<?php
require_once __DIR__.'/vendor/autoload.php';

echo "teste123";

while ($line = fgets(STDIN)) {
    $line = strtolower(trim($line));
    $data = json_decode(strtolower(trim($line)), true);

    $response = 'teste 122';
    fwrite(STDOUT, $response);
}
