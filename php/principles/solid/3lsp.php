<?php
// Liskov substitution principle

class Bird { // base class
    public function fly() {
        return 10;
    }
}
 
/**
 * good child class
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
 * bad child class
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