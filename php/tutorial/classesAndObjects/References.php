<?php

namespace tutorial\classesAndObjects;

class References {
    public $a = 0;
}

$references = new References();

var_dump($references);

function increaseClass(References $references) {
    $references->a = 1;
}


increaseClass($references);
var_dump($references);

$var = 0;

function increase($a) {
    $a = $a + 1;
}
increase($var);
var_dump($var);

function increaseReference(&$a) {
    $a = $a + 1;
}
increaseReference($var);
var_dump($var);
