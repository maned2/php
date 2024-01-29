<?php

require 'autoload.php';

$repeats = 100000000;

$array = [];

// start the timer
StopWatch::start();

// your script - this is an example
for ($i=0; $i<=$repeats; $i++) {
    $array[$i] = true;
}

// check how long 2 seconds is...
echo StopWatch::elapsed() . PHP_EOL;

StopWatch::start();

// your script - this is an example
for ($i=0; $i<=$repeats; $i++) {
    $array[$i] = false;
}

// check how long 2 seconds is...
echo StopWatch::elapsed() . PHP_EOL;