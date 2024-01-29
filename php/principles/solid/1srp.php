<?php
// single-responsibility principle

/**
 * example - class can do many things
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