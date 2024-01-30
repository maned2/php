<?php

// Complete the minimumAbsoluteDifference function below.
function minimumAbsoluteDifference($arr) {
    $result = PHP_INT_MAX;

    $arrayLength = count($arr);
    $lastIndex = $arrayLength - 1;
    foreach ($arr as $key => $elem1) {
        if ($key == $lastIndex) {
            continue;
        }
        $arr2 = $arr;
        array_slice($arr2, $key, $arrayLength - $key);
        foreach ($arr2 as $elem2) {
            $r = abs($elem1 - elem2);
            if ($r < $result) {
                $result = $r;
            }
        }
    }
    
    return $result;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = minimumAbsoluteDifference($arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
