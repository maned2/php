<?php

// Complete the circularArrayRotation function below.
function circularArrayRotation($a, $k, $queries) {

    for ($i = 0; $i < $k; $i++) {
        $lastIndex = count($a)-1;
        array_unshift($a, $a[$lastIndex]);
        unset($a[$lastIndex+1]);
    }
    
    $result = [];
    foreach ($queries as $q) {
        $result[] = $a[$q];
    }
    
    return $result;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $nkq_temp);
$nkq = explode(' ', $nkq_temp);

$n = intval($nkq[0]);

$k = intval($nkq[1]);

$q = intval($nkq[2]);

fscanf($stdin, "%[^\n]", $a_temp);

$a = array_map('intval', preg_split('/ /', $a_temp, -1, PREG_SPLIT_NO_EMPTY));

$queries = array();

for ($i = 0; $i < $q; $i++) {
    fscanf($stdin, "%d\n", $queries_item);
    $queries[] = $queries_item;
}

$result = circularArrayRotation($a, $k, $queries);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
