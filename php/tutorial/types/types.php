<?php

class TestObject
{

}

class Types {
    # Four scalar types:
    public bool $bool = false;
    public int $int = 1;
    public float $float = 1.1; # not 1,1
    public string $string = 'abc';

    # Four compound types:
    public array $array = [];
    public ?object $object = null;
    # public callable $callable; # error
    public ?iterable $iterable = []; # this can be generator

    # And finally two special types:
    # resource
    # NULL

    public function __construct()
    {
        $this->object = new TestObject();
    }

    public function callableTest(callable $func) { # callable can be defined here
        var_dump($this);
        $callable = function (&$a) {$a++;};
        var_dump($callable);
        $var = 1;
        $func($var);
        var_dump($var);
    }
}

$types = new Types();
$func = fn(&$a) => $a++;
$types->callableTest($func);
