<?php
namespace Models;

class MaxHeap {
    private $heap = [];

    public function insert($product) {
        $this->heap[] = $product;
        $this->heapifyUp(count($this->heap) - 1);
    }

    public function extractMax() {
        if (count($this->heap) === 0) return null;
        $max = $this->heap[0];
        $this->heap[0] = array_pop($this->heap);
        $this->heapifyDown(0);
        return $max;
    }

    public function buildHeap($products) {
        foreach ($products as $product) {
            $this->insert($product);
        }
    }

    public function getHeap() {
        return $this->heap;
    }

    private function heapifyUp($index) {
        while ($index > 0) {
            $parent = intval(($index - 1) / 2);
            if ($this->heap[$index]->rating > $this->heap[$parent]->rating) {
                [$this->heap[$index], $this->heap[$parent]] = [$this->heap[$parent], $this->heap[$index]];
                $index = $parent;
            } else {
                break;
            }
        }
    }

    private function heapifyDown($index) {
        $size = count($this->heap);
        while (2 * $index + 1 < $size) {
            $left = 2 * $index + 1;
            $right = 2 * $index + 2;
            $largest = $index;

            if ($left < $size && $this->heap[$left]->rating > $this->heap[$largest]->rating) {
                $largest = $left;
            }

            if ($right < $size && $this->heap[$right]->rating > $this->heap[$largest]->rating) {
                $largest = $right;
            }

            if ($largest !== $index) {
                [$this->heap[$index], $this->heap[$largest]] = [$this->heap[$largest], $this->heap[$index]];
                $index = $largest;
            } else {
                break;
            }
        }
    }
}
?>
