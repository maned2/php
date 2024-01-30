<?php
/**
 * Принцип инверсии зависимостей (dependency inversion principle) -
 * Зависимость на Абстракциях. Нет зависимости на что-то конкретное
 * Зависимости внутри системы строятся на основе абстракций.
 * Модули верхнего уровня не зависят от модулей нижнего уровня.
 * Абстракции не должны зависеть от деталей.
 * Детали должны зависеть от абстракций.
 */

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

interface C {
    public function test1();
}

class A1 implements C {
    public function test1() {

    }
}

class B1 {
    public function test2(C $var) { //сеттер или конструктор или параметр (как тут)
        $var->test1();
    }
}