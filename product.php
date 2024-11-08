<?php

require_once "./partials/_header.php";

class Product {
    protected $id;
    protected $price;
    protected $title;
    protected $shippingCost;

    public function __construct() {
        $this->price = 0;
        $this->shippingCost = 0;
    }
    public function buy() {
        echo "Produit acheté : {$this->title}.";
    }

    public function ship() {
        echo "Produit expédié avec des frais de : {$this->shippingCost}.";
    }
}

$product = new Product();

$product->buy();
$product->ship();

var_dump($product);