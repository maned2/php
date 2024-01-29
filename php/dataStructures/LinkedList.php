<?php

class Node {
    public $data;
    public $next = NULL;

    public function __construct($data) {
        $this->data = $data;
    }
}

class LinkedList {
    private $header;

    public function __construct($data)
    {
        $this->header = new Node($data);
    }

    public function find($item) {
        $current = $this->header;
        while ($current->data != $item) {
            $current = $current->next;
        }
        return $current;
    }

    public function insert(Node $item, $new) {
        $newNode = new Node($new);
        $current = $this->find($item);
        $newNode->next = $current->next;
        $current->next = $newNode;
        return true;
    }
}