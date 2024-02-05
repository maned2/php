<?php
/**
 * Позднее статическое связывание (Late Static Bindings)
 * - может быть использована для того, чтобы получить ссылку на вызываемый класс в контексте статического наследования
 * "Перенаправленный вызов" - это статический вызов, начинающийся с self::, parent::, static::
 */
class A {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        self::who();
    }
}

class B extends A {
    public static function who() {
        echo __CLASS__;
    }
}

B::test(); // A

class A1 {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        static::who(); // Здесь действует позднее статическое связывание
    }
}

class B1 extends A1 {
    public static function who() {
        echo __CLASS__;
    }
}

B1::test(); // B

class A2 {
    private function foo() {
        echo "success!\n";
    }
    public function test() {
        $this->foo();
        static::foo();
    }
}

class B2 extends A2 {
    /* foo() будет скопирован в В, следовательно его область действия по прежнему А,
       и вызов будет успешным */
}

class C2 extends A2 {
    private function foo() {
        /* исходный метод заменён; область действия нового метода - С */
    }
}

$b = new B2();
$b->test(); // success! success! success!
$c = new C2();
$c->test();   // потерпит ошибку

class A4 {
    public static function foo() {
        static::who();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}

class B4 extends A4 {
    public static function test() {
        A4::foo();
        parent::foo();
        self::foo();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}
class C4 extends B4 {
    public static function who() {
        echo __CLASS__."\n";
    }
}

C4::test();