<?php
use Zcollection\Zcollection;

$array = [1,2,3,4,5,6,7,8,9];

var_dump($array);

$collection = new Zcollection($array);
$results = $collection
    ->map(
        function ($v) { return intval(($v * $v) / 2); }
    )
    ->map(
        function ($v) { return (($v % 5) + 1000) / 8; }
    )
    ->toArray();
var_dump($results);
