<?php
// dependency inversion principle


// bad example:
class A {
    public function test1() {

    }
}

class B {
    public function test2() {
        $a = new A;
        $a->test1();
    }
}

//good example:

interface E {
    public function test1();
}

class C implements E {
    public function test1() {

    }
}

class D {
    public function test2(E $var) { //in params or in constructor
        $var->test1();
    }
}