<?php
// interface segregation principle
// many interfaces - better than one

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

