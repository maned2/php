<?php

$a = PHP_INT_MAX;

$result = $a < 2;
var_dump($result);

$a = array();
$b = $a;
$b['foo'] = 42;
var_dump($a);

$c = [1,2,3];
array_slice($c, 1);
var_dump($c);