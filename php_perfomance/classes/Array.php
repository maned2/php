<?php

namespace classes;

use helpers\StopWatch;

require './autoload.php';

const REPEATS = 100000000;

$array = [];
for ($i=0; $i<=REPEATS; $i++) {
    $array[$i] = 1;
}

// start the timer
StopWatch::start();

// your script - this is an example
for ($i=0; $i<=REPEATS; $i++) {
    $array[$i]++;
}
echo StopWatch::elapsed() . PHP_EOL;

StopWatch::start();
foreach ($array as $elem) {
    $elem++;
}
echo StopWatch::elapsed() . PHP_EOL;

StopWatch::start();
foreach ($array as $key => $elem) {
    $elem++;
}
echo StopWatch::elapsed() . PHP_EOL;