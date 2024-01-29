<?php
function test_gen() {
    for ($i = 0; $i <= 5; $i++) {
        yield;
    }
}

$genFunction = test_gen();
foreach ($genFunction as $value) {
    var_dump($value);
}