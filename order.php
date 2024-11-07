<?php

// Création d'une class Order qui va regrouper des variables
// Ces variables vont être rapelé dans des fonctions avec des conditions
class Order {

    public $id;
    public $customerName;

    // On initialise la valeur de status à "cart", signifiant que la commande est en cours
    public $status = "cart";
    public $totalPrice;
    public $products = [];

    // Fonction addProduct pour ajouter un produit à la commande si elle est en cours (status = "cart")
    // Ajoute un produit "Pringles" et augmente le total de 3
    public function addProduct() {
        if ($this->status === "cart") {
            $this->products[] = "Pringles";
            $this->totalPrice += 3;
        }
    }

    // Fonction pay pour finaliser la commande en changeant
    // le statut en "paid" si elle est encore en cours
    public function pay() {
        if($this->status === "cart") {
            $this->status = "paid";
        }
    }
}

// Création nouvelle variable $order1 et ajout de produit pour enfin payer
$order1 = new Order();
$order1->addProduct();
$order1->addProduct();
$order1->pay();


var_dump($order1);