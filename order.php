<?php

require_once './partials/_header.php';

// Création d'une class Order qui va regrouper des variables
// Ces variables vont être rapelé dans des fonctions avec des conditions
class Order
{

    public $id;
    public $customerName;

    // On initialise la valeur de status à "cart", signifiant que la commande est en cours
    public $status = "cart";
    public $totalPrice = 0;
    public $products = [];
    // On ajoute un nouveau paramètre pour délivrer l'adresse de livraison
    public $deliveryAddress;

    // Le constructeur est une méthode "magique" car elle est appelée automatiquement
    // Elle est appelée quand un nouvel objet est crée pour cette classe
    public function __construct($customerName, $deliveryAddress) {
        $this->customerName = $customerName;
        $this->deliveryAddress = $deliveryAddress;
        $this->id = uniqid();
    }

    // Fonction addProduct pour ajouter un produit à la commande si elle est en cours (status = "cart")
    // Ajoute un produit "Pringles" et augmente le total de 3
    public function addProduct()
    {
        if ($this->status === "cart") {
            $this->products[] = "Pringles";
            $this->totalPrice += 3;
        } else {
            throw new Exception("Vous ne pouvez ajouter de produit que lorsque la commande est en cours.");
        }
    }

    // Ici, on crée une fonction qui va permettre de retirer un produit donc si
    // on est en cours de commande "cart", on retire le dernier produit ajouté
    // et du coup on enleve 3 au prix total
    public function removeProduct()
    {
        if ($this->status === "cart" && !empty($this->products)) {
            array_pop($this->products);
            $this->totalPrice -= 3;
        } else {
            throw new Exception("Vous ne pouvez retirer des produits que lorsque la commande est en cours et contient des produits.");
        }
    }

    public function setDeliveryAddress($deliveryAddress) {
        if ($this->status === "cart") {
            $this->deliveryAddress = $deliveryAddress;
            $this->status = "deliveryAddressSet";
        } else {
            throw new Exception("Vous ne pouvez définir une adresse de livraison pour cette commande.");
        }
    }

    // Fonction pay pour finaliser la commande en changeant
    // le statut en "paid" si elle est encore en cours
    public function pay()
    {
        if ($this->status === "cart" && !empty($this->products)) {
            $this->status = "paid";
        } else {
            throw new Exception("Vous devez définir une adresse de livraison et ajouter des produits avant de payer.");
        }
    }

    //Nouvelle méthode pour envoyer la commande
    public function sendOrder() {
        if ($this->status === "paid") {
            // Si la commande à été payer et qu'elle n'est pas vide en produits
            // Elle passe en livraison
            $this->status = "shipped";
        } else {
            throw new Exception("La commande doit être payée avant de pouvoir être envoyée.");
        }
    }
}
// Création nouvelle variable $order1 et ajout de produit pour enfin payer

$order1 = new Order("Mathis Ieng", "9 Rue de blablacar");
$order1->addProduct();
$order1->addProduct();
$order1->removeProduct();
$order1->pay();
// Dans cet exemple, on ajoute 2 produits (6 € au total), puis on en retire un
// Résultat final : 1 produit = 3 €

$order2 = new Order("Nathan Julio", "89 Rue du zoubékoula");

$order2->addProduct();
$order2->addProduct();
$order2->addProduct();
$order2->addProduct();
$order2->removeProduct();
$order2->removeProduct();
$order2->pay();

// Création d'une commande et test des nouvelles méthodes
$order3 = new Order("Marine Roulland", "4 Avenue du boulebard");
$order3->addProduct();
$order3->pay();
$order3->sendOrder();

echo "<h2>Details de la commande de Mathis Ieng</h2>";
var_dump($order1);

echo "<h2>Details de la commande de Nathan Julio</h2>";
var_dump($order2);

echo "<h2>Details de la commande de Marine Roulland</h2>";
var_dump($order3);

echo "</br>";

// NE PAS FAIRE ATTENTION
echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://www.cards-capital.com/88924/entei.jpg'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";

echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://static.pkmcards.fr/cards/fr/dex/image-cartes-a-collectionner-pokemon-card-game-tcg-pkmcards-dex-fr-038-noir-blanc-explorateurs-obscurs-raikou-ex.webp'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";
echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://static.pkmcards.fr/cards/fr/evs/image-cartes-a-collectionner-pokemon-card-game-tcg-pkmcards-evs-fr-173-epee-et-bouclier-evolution-celeste-suicune-v.webp'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";
echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://www.cards-capital.com/89449/groudon.jpg'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";
echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://static.pkmcards.fr/cards/fr/cel/image-cartes-a-collectionner-pokemon-card-game-tcg-pkmcards-cel-fr-003-epee-et-bouclier-celebrations-kyogre.webp'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";
echo "<div class='card-container'>
        <div class='flip-card'>
            <div class='flip-card-inner'>
                <div class='flip-card-front'>
                    <img width='200' height='300' src='https://static.wixstatic.com/media/6d3f51_32c1a485756e465cbe7c84a8ed18ff4f~mv2.jpg/v1/fill/w_480,h_670,al_c,lg_1,q_80,enc_auto/6d3f51_32c1a485756e465cbe7c84a8ed18ff4f~mv2.jpg'>
                </div>
                <div class='flip-card-back'>
                    <img width='200' height='300' src='https://i.etsystatic.com/29988796/r/il/e48668/3102482850/il_570xN.3102482850_kznq.jpg'>
                </div>
            </div>
        </div>
      </div>";