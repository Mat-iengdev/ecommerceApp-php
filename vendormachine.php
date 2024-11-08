<?php

require_once "./partials/_header.php";
class VendorMachine
{
    public $snacks;

    public $cashAmount;

    public $isOn;

    public function __construct() {
        $this->isOn = true;
        $this->cashAmount = 0.00;
        $this->snacks = [
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

    }

    public function turnOn() {
        $this->isOn = true;
    }

    public function turnOff() {
        $currentDate = new DateTime();
        $currentHour = $currentDate->format('H');

        if ($currentHour >= 10) {
            $this->isOn = false;
        } else {
            throw new Exception('Vous ne pouvez pas éteindre la machine avant 18h');
        }
    }

    public function buySnack($selectedSnack) {
        if ($this->isOn) {

            // on initialise une variable "flag" à false
            $snackFound = false;

            foreach ($this->snacks as $index => $snack) {
                if ($snack['name'] === $selectedSnack) {

                    if ($snack['quantity'] > 0) {
                        $this->cashAmount += $snack['price'];
                        $this->removeSnackQuantity($index);
                    } else {
                        throw new Exception('snack trouvé mais pas de quantité suffisante');
                    }
                    // si le snack a été trouvé dans la boucle,
                    // on modifie la variable "flag"
                    $snackFound = true;
                    break;
                }

            }
            // après la boucle, on regarde la valeur de
            // la variable flag
            // et on lance une exception si le snack n'a pas été trouvé
            if (!$snackFound) {
                throw new Exception('snack non trouvé');
            }

        }
    }

    public function shootWithFoot() {
        if ($this->isOn) {
            $randomIndex = rand(0, count($this->snacks) - 1);
            $randomSnack = $this->snacks[$randomIndex];

            if ($randomSnack['quantity'] > 0) {
                $this->removeSnackQuantity($randomIndex);
            }

            $randomInsideCash =  rand(0, $this->cashAmount * 100) / 100;
            $this->cashAmount -= $randomInsideCash;
            echo "Eh bien joué ! + {$randomInsideCash} € </br>";
        }
    }

    private function removeSnackQuantity($index) {
        $this->snacks[$index]['quantity'] -= 1;
    }

}


$machine1 = new VendorMachine();
// On allume la machine et on achète un snickers
// On peut pas éteindre la machine après utilisation car il n'est pas encore 18h
$machine1->turnOn();
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->buySnack("Snickers");
$machine1->shootWithFoot();

$machine2 = new VendorMachine();

$machine2->turnOn();
$machine2->buySnack("Mars");
$machine2->buySnack("Twix");
$machine2->shootWithFoot();

$machine3 = new VendorMachine();

$machine3->turnOn();
$machine3->buySnack("Bounty");
$machine3->buySnack("Snickers");
$machine3->buySnack("Snickers");
$machine3->shootWithFoot();


echo "<h2>Les fabuleux achats de Nathan le Dieu cosmique</h2>";
var_dump($machine1);
echo "<h2>Les fabuleux achats d'Edouard cet enculé avec son deck foudre</h2>";
var_dump($machine2);
echo "<h2>Les fabuleux achats de Dylan ce fumier il représente 50% du CA d'Otéra</h2>";
var_dump($machine3);

