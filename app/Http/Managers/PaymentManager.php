<?php

namespace App\Http\Managers;



class PaymentManager {

    //Création d'une fonction pour générer un pourcentage des ventes pour l'instructeur utilisée dans CheckoutController
    public function getInstructorPart($total){
        $percent = 75;
        $percentDecimal = $percent / 100;
        $part = $percentDecimal * $total;
        return $part;
    }

    //Création d'une fonction pour générer un pourcentage des ventes pour la plateforme utilisée dans CheckoutController
    public function getElearningPart ($total){
        $percent = 25;
        $percentDecimal = $percent / 100;
        $part = $percentDecimal * $total;
        return $part;
    }

}
