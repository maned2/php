<?php
/*
 * Принцип открытости/закрытости (open–closed principle)
 * Программные сущности должны быть открыты для расширения но закрыты для модификации.
 */

// Пример:
// Есть класс

class A0 {
    public function test1(string $string)
    {

    }
}

// мы хотим изменить поведение метода test1.
// мы могли бы унаследоваться от класса А и изменить поведение
class B extends A0 {
    public function test1(string $string)
    {
        // другое поведение
    }
}
// это плохое решение потому, что если мы поменяем метод test1 в классе А, нам нужно будет менять их так же в классе B


// хороший пример - создание интерфейса который будет реализовываться двумя новыми классами
interface ExampleInterface {
    public function test1(string $string);
}

class A1 implements ExampleInterface {
    public function test1(string $string)
    {

    }
}

class B1 implements ExampleInterface {
    public function test1(string $string)
    {

    }
}

class A {
    private $realization;

    public function setRealization(ExampleInterface $foo) {
        $this->realization = $foo;
    }

    public function test1(string $string) {
        $this->realization->test1();
    }
}