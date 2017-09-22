<?php

require_once __DIR__.'/../vendor/autoload.php';

use Closure;
use Cake\Collection\Collection as CakeCollection;
use Illuminate\Support\Collection as LaravelCollection;
use Doctrine\Common\Collections\ArrayCollection as SymfonyCollection;
use Ginq\Ginq;
use Zcollection\Zcollection;

$targets = range(0, 500000);
$closure = function ($v) { return intval(($v * $v * $v) / 5) % 12345; };

foreachBench($targets, $closure);

arrayMapBench($targets, $closure);

cakeCollectionBench($targets, $closure);

laravelCollectionBench($targets, $closure);

symfonyCollectionBench($targets, $closure);

ginqBench($targets, $closure);

zcollectionBench($targets, $closure);

zcollectionArrayMapBench($targets, $closure);


/*
 * 以下、ベンチマークコード
 */
function foreachBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "foreach");
    $bench->start();

    foreach ($targets as $key => $val) {
        // $results[$key] = intval(($val * $val * $val) / 5) % 12345;
        $results[$key] = $closure($val);
    }

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function arrayMapBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "array_map");
    $bench->start();

    $results = array_map($closure, $targets);

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function cakeCollectionBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "CakeCollection");
    $bench->start();

    $results = (new CakeCollection($targets))->map($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function laravelCollectionBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "LaravelCollection");
    $bench->start();

    $results = (new LaravelCollection($targets))->map($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function symfonyCollectionBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "SymfonyCollection");
    $bench->start();

    $results = (new SymfonyCollection($targets))->map($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function ginqBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "Ginq");
    $bench->start();

    $results = Ginq::from($targets)->map($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function zcollectionBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "Zcollection");
    $bench->start();

    $results = (new Zcollection($targets))->map($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}

function zcollectionArrayMapBench(array $targets, Closure $closure) {
    $bench = new Ubench;
    printf("%s\n", "Zcollection array_map");
    $bench->start();

    $results = (new Zcollection($targets))->arrayMap($closure)->toArray();

    $bench->end();
    printf("time: %s, peak-memory: %s, memory-in-end: %s\n", $bench->getTime(), $bench->getMemoryPeak(), $bench->getMemoryUsage());
}
