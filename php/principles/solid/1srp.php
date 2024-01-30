<?php
/*
 * Принцип единственной ответственности (single-responsibility principle) -
 * принцип ООП, обозначающий, что каждый объект должен иметь одну ответственность и эта ответственность должна
 * быть полностью инкапсулирована в класс.
 * Все его поведения должны быть направлены исключительно на обеспечение этой ответственности.
 */



/**
 * Плохой пример - класс делает слишком много разных вещей
 */
abstract class Report {
    public array $data;

    abstract public function getHeader();
    abstract public function getContent();
    abstract public function getFooter();
    abstract public function toPrint();
    abstract public function toHTML();
    abstract public function toXML();
    abstract public function toJSON();
}