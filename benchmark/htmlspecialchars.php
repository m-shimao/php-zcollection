<?php

require_once __DIR__.'/../vendor/autoload.php';

use Zcollection\Zcollection;

$target = '<h1>合宿終了！！！</h1>';

phpmethodhBench($target);

zcollectionBench($target);

/*
 * 以下、ベンチマークコード
 */
function phpmethodhBench($target)
{
    $bench = new Ubench;
    printf("%s\n", "php plane");
    $bench->start();

    foreach (range(0, 1000000) as $val) {
        htmlspecialchars($target);
    }

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function zcollectionBench($target)
{
    $bench = new Ubench;
    printf("%s\n", "Zcollection htmlspecialchars");
    $bench->start();

    foreach (range(0, 1000000) as $val) {
        Zcollection::h($target);
    }

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}
