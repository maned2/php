<?php
/**
 * Принцип разделения интерфейса (interface segregation principle) -
 * много интерфейсов, специально предназначенных для клиентов, лучше, чем один интерфейс общего назначения
 */

/**
 * bad interface
 */
interface ExampleInterface {
    public function setColor();
    public function setSize();
}

// good
interface ColorInterface {
    public function setColor();
}

interface SizeInterface {
    public function setSize();
}

