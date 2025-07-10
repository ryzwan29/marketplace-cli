<?php
class LinkedListNode {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class LinkedList {
    private $head;

    public function __construct() {
        $this->head = null;
    }

    public function insert($data) {
        $node = new LinkedListNode($data);
        if ($this->head === null) {
            $this->head = $node;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $node;
        }
    }

    public function display() {
        $current = $this->head;
        while ($current !== null) {
            print_r($current->data);
            echo "\\n";
            $current = $current->next;
        }
    }
}
?>