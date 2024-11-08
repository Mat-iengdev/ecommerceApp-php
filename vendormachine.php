<?php

$snacks = [
    [
        "name" => "Snickers",
        "price" => 1,
        "quantity" => 5
    ],
    [
        "name" => "Mars",
        "price" => 1.5,
        "quantity" => 5
    ],
    [
        "name" => "Twix",
        "price" => 2,
        "quantity" => 5
    ],
    [
        "name" => "Bounty",
        "price" => 2.5,
        "quantity" => 5
    ]
];

class VendorMachine
{
    // On crée la propriété $isOn pour savoir si la machine est allumée ou non
    public $isOn = false;
    // On crée la propriété $snacks qui représente les produits à vendre
    // De ma machine sous forme de tableau
    public $snacks = [];
    // Ici la propriété $cashAmount qui par défaut est de 0
    // Et Augmentera selon l'achat de nouveau snacks
    public $cashAmount = 0;

    // On crée une méthode tunrOn(), la machine s'allume si ma propriété isOn retourne vrai
    public function turnOn()
    {
        $this->isOn = true;
    }

    // On crée une méthode turnOff(), on récupère l'heure actuelle grâce à une propriété
    // Et on utilise une condition pour que la machine puisse s'éteindre après 18h
    // On vérifie aussi si la machine est déjà allumée avant de pouvoir l'éteindre
    // Sinon un message d'erreur apparaît
    public function turnOff()
    {
        // Vérifie que l'heure actuelle est après 18h
        $currentHour = (int)date('H');

        if ($this->isOn === true && $currentHour >= 18) {
            $this->isOn = false;
        } else {
            throw new Exception("Impossible d'éteindre la machine avant 18h");
        }
    }

    // Le constructeur initialise la machine avec les snacks
    public function __construct($snacks)
    {
        $this->snacks = $snacks;
        $this->cashAmount = 0;  // Au départ, il n'y a pas d'argent
    }

    // La méthode ici consiste à acheter un snack, on prend en paramètre le nom du snack qu'on
    // retournera dans la création d'un nouvel objet
    // On vérifie si la machine est bien allumée avant de procéder a une boucle forEach
    // qui va parcourir tout les snacks jusqu'à trouver celui correspondant
    public function buySnack($snackName)
    {
        if ($this->isOn === true) {
            // Vérifier si le snack existe et si la quantité est suffisante
            foreach ($this->snacks as &$snack) {
                if ($snack['name'] === $snackName) {
                    if ($snack['quantity'] > 0) {
                        // Décrémenter la quantité du snack
                        $snack['quantity']--;
                        // Ajouter le prix du snack au cashAmount
                        $this->cashAmount += $snack['price'];
                        return;  // Sortir de la fonction après un achat réussi
                    } else {
                        throw new Exception("Malheuresement le snack est en rupture de stock.");
                    }
                }
            }
        } else {
            throw new Exception ("Problème, la machine n'est pas allumée");
        }
    }




    // Méthode pour acheter un snack aléatoirement en "shootant du pied"
    // array_rand ici nous permet de faire une sélection au hasard de clés, ou bien de valeurs
    public function shootWithFoot() {
        if ($this->isOn === true) {
            // Sélectionner un snack aléatoire parmi les snacks disponibles
            $randomSnackIndex = array_rand($this->snacks);  // Sélectionner un snack aléatoire

            // Vérifier si le snack est encore disponible
            if ($this->snacks[$randomSnackIndex]['quantity'] > 0) {
                // Récupérer le prix du snack choisi
                $snackPrice = $this->snacks[$randomSnackIndex]['price'];

                // Décrémenter la quantité du snack
                $this->snacks[$randomSnackIndex]['quantity']--;

                // Générer un montant de cash aléatoire à retirer (entre 1 et le cashAmount)
                $randomCashAmount = mt_rand(1, $this->cashAmount * 100) / 100;
                echo "{$randomCashAmount}€ sont tombés de la machine";
                // Vérifier si le cashAmount est suffisant pour cette décrémentation
                if ($this->cashAmount >= $randomCashAmount) {
                    $this->cashAmount -= $randomCashAmount;  // Retirer le montant aléatoire du cashAmount
                } else {
                    throw new Exception("Il n'y a pas assez d'argent pour compléter cette action.");
                }
            } else {
                throw new Exception("La technique ne peut pas marcher, il n'y a plus assez de stock de snack");
            }
        } else {
            throw new Exception("La machine est éteinte. Impossible d'effectuer l'action.");
        }
    }
}

$machine1 = new VendorMachine($snacks);
// On allume la machine et on achète un snickers
// On peut pas éteindre la machine après utilisation car il n'est pas encore 18h
$machine1->turnOn();
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->shootWithFoot();

$machine2 = new VendorMachine($snacks);

$machine2->turnOn();
$machine2->buySnack("Mars");
$machine2->buySnack("Twix");
$machine2->shootWithFoot();

$machine3 = new VendorMachine($snacks);

$machine3->turnOn();
$machine3->buySnack("Bounty");
$machine3->buySnack("Snickers");
$machine3->buySnack("Snickers");
$machine3->shootWithFoot();


echo "<h2>Les fabuleux achats de Nathan</h2>";
var_dump($machine1);
echo "<h2>Les fabuleux achats d'Edouard</h2>";
var_dump($machine2);
echo "<h2>Les fabuleux achats de Mathis</h2>";
var_dump($machine3);

