<?php
namespace Models;
class TrieNode {
    public $children = [];
    public $isEndOfWord = false;

    public function __construct() {
        $this->children = [];
    }
}

class Trie {
    private $root;

    public function __construct() {
        $this->root = new TrieNode();
    }

    public function insert($word) {
        $node = $this->root;
        foreach (str_split($word) as $char) {
            if (!isset($node->children[$char])) {
                $node->children[$char] = new TrieNode();
            }
            $node = $node->children[$char];
        }
        $node->isEndOfWord = true;
    }

    public function search($word) {
        $node = $this->root;
        foreach (str_split($word) as $char) {
            if (!isset($node->children[$char])) {
                return false;
            }
            $node = $node->children[$char];
        }
        return $node->isEndOfWord;
    }

    public function startsWith($prefix) {
        $node = $this->root;
        foreach (str_split($prefix) as $char) {
            if (!isset($node->children[$char])) return [];
            $node = $node->children[$char];
        }
        $results = [];
        $this->dfs($node, $prefix, $results);
        return $results;
    }

    private function dfs($node, $prefix, &$results) {
        if ($node->isEndOfWord) $results[] = $prefix;
        foreach ($node->children as $char => $childNode) {
            $this->dfs($childNode, $prefix . $char, $results);
        }
    }
}
?>