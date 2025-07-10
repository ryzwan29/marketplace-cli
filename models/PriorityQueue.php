<?php
namespace Models;

class PriorityQueue {
    private $queue = [];

    public function enqueue($product) {
        $this->queue[] = $product;
        usort($this->queue, function ($a, $b) {
            // Semakin tinggi rating → semakin prioritas
            return $b->rating <=> $a->rating;
        });
    }

    public function dequeue() {
        return array_shift($this->queue); // ambil produk dengan prioritas tertinggi
    }

    public function peek() {
        return $this->queue[0] ?? null;
    }

    public function isEmpty() {
        return empty($this->queue);
    }

    public function getAll() {
        return $this->queue;
    }
}
