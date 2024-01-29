<?php

/**
 * LIFO last in first out
 */
class Stack {
    private array $items = [];

    public function push($item) {
        $this->items[] = $item;
    }

    public function pop() {
        return array_pop($this->items);
    }
}