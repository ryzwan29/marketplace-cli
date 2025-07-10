<?php
namespace Models;

class Stack {
    private $stack = [];

    public function push($item) {
        array_push($this->stack, $item);
        if (count($this->stack) > 5) {
            array_shift($this->stack); // Hapus item tertua
        }
    }

    public function pop() {
        return array_pop($this->stack);
    }

    public function peek() {
        return end($this->stack);
    }

    public function isEmpty() {
        return empty($this->stack);
    }

    public function getAll() {
        return $this->stack;
    }

    // ✅ Tambahkan ini:
    public function toArray() {
        return array_reverse($this->stack); // biar urutannya dari pencarian terbaru ke lama
    }
}
