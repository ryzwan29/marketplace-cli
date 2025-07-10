<?php
namespace Models;

class Graph {
    private $adjList = [];

    public function addEdge($category, $subCategory) {
        if (!isset($this->adjList[$category])) {
            $this->adjList[$category] = [];
        }

        if (!in_array($subCategory, $this->adjList[$category])) {
            $this->adjList[$category][] = $subCategory;
        }
    }

    public function addProduct($product) {
        // Misalnya kategori = "Elektronik > Laptop"
        $parts = explode('>', $product->category);
        $parts = array_map('trim', $parts);

        for ($i = 0; $i < count($parts) - 1; $i++) {
            $this->addEdge($parts[$i], $parts[$i + 1]);
        }
    }

    public function bfs($start) {
        $visited = [];
        $queue = [$start];
        $result = [];

        while (!empty($queue)) {
            $node = array_shift($queue);
            if (!isset($visited[$node])) {
                $visited[$node] = true;
                $result[] = $node;

                if (isset($this->adjList[$node])) {
                    foreach ($this->adjList[$node] as $neighbor) {
                        $queue[] = $neighbor;
                    }
                }
            }
        }

        return $result;
    }

    public function getAdjList() {
        return $this->adjList;
    }
}
