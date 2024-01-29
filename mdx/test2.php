<?php


function test(string $input, string $remove): string
{
    if (empty($input)) {
        return $input;
    }

    $result = $input;
    while (strpos($result, $remove) !== false) {
        $result = str_replace($remove, '', $result);
    }
    return $result;
}