<?php

/**
 * FIFO first in first out
 */
class Queue {
    private array $items = [];

    public function push($item) {
        array_unshift($this->items[], $item);
    }

    public function get() {
        return array_pop($this->items);
    }
}