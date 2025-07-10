<?php
namespace Models;

class Product {
    public $id, $name, $category, $rating, $price;

    public function __construct($id, $name, $category, $rating, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->rating = $rating;
        $this->price = $price;
    }
}
