<?php
/*
 * Принцип подстановки Лисков (Liskov substitution principle) -
 * функции, которые используют базовый тип,
 * должны иметь возможность использовать подтипы базового типа не зная об этом
 */

class Bird { // base class
    public function fly() {
        return 10;
    }
}
 
/**
 * пример хорошего использования принципа
 */
class Duck extends Bird {
 
    public function fly() {
        return 8;
    }
     
    public function swim() {
        return 2;
    }
}
 
/**
 * плохой пример - по принципу так делать нельзя
 */
class Penguin extends Bird {
 
    public function fly() {
    //die('i can`t fly (((');  // not typical for base class
    return 'i can`t fly ((('; // not typical for base class
    }
 
    public function swim() {
        return 4;
    }
}
/**
 * в данном примере что бы выполнить задачу по принципу нужно сделать отдельный класс Penguin
 */

class Penguin0 {
    public function swim() {
        return 4;
    }
}