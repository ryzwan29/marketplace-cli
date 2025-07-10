<?php

namespace Models;
class HashTable {
    private $table = [];

    public function insert($product) {
        $key = $product->id;
        $this->table[$key] = $product;
    }

    public function get($id) {
        return $this->table[$id] ?? null;
    }

    public function delete($id) {
        if (isset($this->table[$id])) {
            unset($this->table[$id]);
            return true;
        }
        return false;
    }

    public function getAll() {
        return $this->table;
    }
}
?>
