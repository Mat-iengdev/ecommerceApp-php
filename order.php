<?php

require_once './partials/_header.php';

// Création d'une class Order qui va regrouper des variables
// Ces variables vont être rapelé dans des fonctions avec des conditions
class Order {

    public $id;
    public $customerName;

    // On initialise la valeur de status à "cart", signifiant que la commande est en cours
    public $status = "cart";
    public $totalPrice;
    public $products = [];

    // Le constructeur est une méthode "magique" car elle est appelée automatiquement
    // Elle est appelée quand un nouvel objet est crée pour cette classe
    public function __construct($customerName) {
        $this->customerName = $customerName;
        $this->id = uniqid();
    }

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

    // Ici, on crée une fonction qui va permettre de retirer un produit donc si
    // on est en cours de commande "cart", on retire le dernier produit ajouté
    // et du coup on enleve 3 au prix total
    public function removeProduct() {
        if ($this->status === "cart" && !empty($this->products)) {
            array_pop($this->products);
            $this->totalPrice -= 3;
        }
    }
}
// Création nouvelle variable $order1 et ajout de produit pour enfin payer

$order1 = new Order("Mathis Ieng");
$order1->addProduct();
$order1->addProduct();
$order1->removeProduct();
$order1->pay();
// Dans cet exemple, on ajoute 2 produits (6 € au total), puis on en retire un
// Résultat final : 1 produit = 3 €

$order2 = new Order("Nathan Julio");
$order2->addProduct();
$order2->addProduct();
$order2->addProduct();
$order2->addProduct();
$order1->removeProduct();
$order1->removeProduct();
$order2->pay();

echo "<h2>Details de la commande de Mathis Ieng</h2>";
var_dump($order1);

echo "<h2>Details de la commande de Nathan Julio</h2>";
var_dump($order2);