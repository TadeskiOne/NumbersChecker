<?php

use NumbersChecker\App\Entities\CalcEntitiesCollection;
use NumbersChecker\App\Entities\CalcEntity;
use NumbersChecker\Services\Calc;
use NumbersChecker\Services\CalcRules\ModRule;

require_once __DIR__ . '/../vendor/autoload.php';

$collection = new CalcEntitiesCollection();
$service = (new Calc())
    ->setCondition(new ModRule(3, 'pa'))
    ->setCondition(new ModRule(5, 'pow'));

for ($i = 1; $i <= 20; $i++) {
    $collection->append(new CalcEntity($i));
}

echo 'Task v1:', PHP_EOL,
implode(' ', iterator_to_array($service->process($collection))),
PHP_EOL,
PHP_EOL;

$collection->flush();
$service = (new Calc())
    ->setCondition(new ModRule(2, 'hatee'))
    ->setCondition(new ModRule(7, 'ho'));

for ($i = 1; $i <= 15; $i++) {
    $collection->append(new CalcEntity($i));
}

echo 'Task v2:', PHP_EOL,
implode('-', iterator_to_array($service->process($collection))),
PHP_EOL,
PHP_EOL;