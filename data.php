<?php

include_once("libs/maLibUtils.php");
include_once("libs/modele.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
session_start();

$idSalon = 1;


if(($_SESSION["idJoueur"])){

    $id_joueurs_salon = explode(" ", getJoueursSalon($idSalon));

    $joueurs = array()  ;
    foreach ($id_joueurs_salon as $i){
        $joueur = array();
        $joueur["idJoueur"]=$i;
        $joueur["color"]= getColor($i);
        $joueur["nbCarres"] = nbCarres($i); 

        //array_push( $joueur, getPseudo($i));
        //array_push( $joueur, getColor($i));
        $joueurs[getPseudo($i)] = $joueur ;
    }

    $salon = array();
    $salon["joueurs"]=$joueurs;
    $salon["nombreJoueurs"] = getNombreJoueurs($idSalon)  ;
    $salon["nomSalon"]  = getNomSalon($idSalon);
    //echo json_encode($salon);
    echo json_encode($salon);



    //Fixture :
    $joueur1 = array("idJoueur"=>0, "color"=>"ForestGreen", "nbCarres" =>0);
    $joueur2 = array("idJoueur"=>1, "color" =>"Aqua","nbCarres"=>0);
    $joueur3 = array("idJoueur"=>2, "color" =>"DarkOrange", "nbCarres"=>0);


    $joueurs = array("joueur1"=>$joueur1, "joueur2"=>$joueur2, "joueur3"=>$joueur3);
    $salon = array( "joueurs"=>$joueurs, "nombreJoueurs"=>3);



}

?>

