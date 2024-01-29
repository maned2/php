<?php
namespace classes;

class MyBoolean
{
    const REPEATS = 100000000;

    public function setTrue()
    {
        $array = [];
        for ($i = 0; $i <= REPEATS; $i++) {
            $array[$i] = true;
        }
    }

    public function setFalse()
    {
        $array = [];
        for ($i = 0; $i <= REPEATS; $i++) {
            $array[$i] = false;
        }
    }
}