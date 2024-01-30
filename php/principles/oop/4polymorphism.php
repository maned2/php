<?php
/*
Полиморфизм
- свойство системы, позволяющее иметь множество реализаций одного интерфейса.
*/

interface Queue {
    public function execute();
}

class MyQueue implements Queue {
    public function execute() {
        // realization
    }
}

class OtherQueue implements Queue {
    public function execute() {
        // realization
    }
}