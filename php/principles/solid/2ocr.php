<?php
// open–closed principle
// entities must be opened for exposing and closed for changing

# example:

class A {
    public function test1(string $string)
    {

    }
}

# bad example - if we need add method test2 in A - we will need add to all subclasses (B)
class B extends A {
    public function test1(string $string, ?int $int = null)
    {

    }
}

# good
interface ExampleInterface {
    public function test1(string $string);
}

class A1 implements ExampleInterface {
    public function test1(string $string)
    {

    }
}

class B1 implements ExampleInterface {
    public function test1(string $string, ?int $int = null)
    {

    }
}