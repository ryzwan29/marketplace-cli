<?php
namespace Models;

require_once 'Product.php';

class AVLNode {
    public $product;
    public $left;
    public $right;
    public $height;

    public function __construct($product) {
        $this->product = $product;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}

class AVLTree {
    public $root = null;

    public function insert($product) {
        //$this->root = $this->insertNode($this->root, $product);
        // return $this->insertNode($this->root, $product);
        $this->root = $this->insertNode($this->root, $product);
        return $this->root;
    }

    private function insertNode($node, $product) {
        if (!$node) return new AVLNode($product);

        if ($product->id < $node->product->id) {
            $node->left = $this->insertNode($node->left, $product);
        } elseif ($product->id > $node->product->id) {
            $node->right = $this->insertNode($node->right, $product);
        } else {
            return $node;
        }

        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        $balance = $this->getBalance($node);

        if ($balance > 1 && $product->id < $node->left->product->id)
            return $this->rotateRight($node);

        if ($balance < -1 && $product->id > $node->right->product->id)
            return $this->rotateLeft($node);

        if ($balance > 1 && $product->id > $node->left->product->id) {
            $node->left = $this->rotateLeft($node->left);
            return $this->rotateRight($node);
        }

        if ($balance < -1 && $product->id < $node->right->product->id) {
            $node->right = $this->rotateRight($node->right);
            return $this->rotateLeft($node);
        }

        return $node;
    }

    public function search($id) {
        return $this->searchNode($this->root, $id);
    }

    private function searchNode($node, $id) {
        if (!$node) return null;
        if ($id == $node->product->id) return $node->product;
        if ($id < $node->product->id) return $this->searchNode($node->left, $id);
        return $this->searchNode($node->right, $id);
    }

    private function getHeight($node) {
        return $node ? $node->height : 0;
    }

    private function getBalance($node) {
        return $node ? $this->getHeight($node->left) - $this->getHeight($node->right) : 0;
    }

    private function rotateRight($y) {
        $x = $y->left;
        $T2 = $x->right;

        $x->right = $y;
        $y->left = $T2;

        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;
        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;

        return $x;
    }

    private function rotateLeft($x) {
        $y = $x->right;
        $T2 = $y->left;

        $y->left = $x;
        $x->right = $T2;

        $x->height = max($this->getHeight($x->left), $this->getHeight($x->right)) + 1;
        $y->height = max($this->getHeight($y->left), $this->getHeight($y->right)) + 1;

        return $y;
    }
}
