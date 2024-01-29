<?php
require __DIR__ . '/vendor/autoload.php';

use classes\RangeArray;

$tests = [
    [
        't' => [[1,2], [2,7]], //right
        'r' => [[1,7]],
    ],
    [
        't' => [[1,5], [3,7]], //right
        'r' => [[1,7]],
    ],
    [
        't' => [[1,7], [3,4]], //have
        'r' => [[1,7]],
    ],
    [
        't' => [[1,2], [4,7]], //not collapse
        'r' => [[1,2], [4,7]],
    ],
    [
        't' => [[1,2], [4,5], [8,12], [6,7], [13,20], [2,7]], //retries
        'r' => [[1,7], [8,12],[13,20]]
    ],
    [
        't' => [[3,4], [1,7]], //include
        'r' => [[1,7]],
    ],
    [
        't' => [[1,3], [3,5], [5, 7]],
        'r' => [[1,7]],
    ],
    [
        't' => [[1,7], [3,7]],
        'r' => [[1,7]],
    ],
    [
        't' => [[-2,0], [-1,7]], //negative
        'r' => [[-2,7]],
    ],
];

foreach ($tests as $key => $test) {
    $rangeArray = new RangeArray($test['t']);
    $result = $rangeArray->collapse();
    if (count(array_diff($result, $test['r'])) === 0) {
        print_r("{$key} success \n");
//        print_r($result);
//        print_r($test['r']);
    } else {
        print_r($result);
    }
}
