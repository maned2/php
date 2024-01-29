<?php
trait Singleton {
    private static $instance = null;

    private function __construct() { /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
    private function __clone() { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    private function __wakeup() { /* ... @return Singleton */ }  // Защищаем от создания через unserialize

    public static function getInstance() {
        return
            self::$instance===null
                ? self::$instance = new static() // Если $instance равен 'null', то создаем объект new self()
                : self::$instance; // Иначе возвращаем существующий объект
    }
}

/**
 * Class Foo
 * @method static Foo getInstance()
 */
class Foo {
    use Singleton;

    private $bar = 0;

    public function incBar() {
        $this->bar++;
    }

    public function getBar() {
        return $this->bar;
    }
}

/*
Применение
*/

$foo = Foo::getInstance();
$foo->incBar();

var_dump($foo->getBar());

$foo = Foo::getInstance();
$foo->incBar();

var_dump($foo->getBar());