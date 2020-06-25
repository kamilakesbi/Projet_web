<?php

include_once("libs/maLibUtils.php");
include_once("libs/modele.php");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");


$joueur1 = array("idJoueur"=>0, "color"=>"ForestGreen", "nbCarres" =>0);
$joueur2 = array("idJoueur"=>1, "color" =>"Aqua","nbCarres"=>0);
$joueur3 = array("idJoueur"=>2, "color" =>"DarkOrange", "nbCarres"=>0);


$joueurs = array("joueur1"=>$joueur1, "joueur2"=>$joueur2, "joueur3"=>$joueur3);
$salon = array( "joueurs"=>$joueurs, "nombreJoueurs"=>3);

echo json_encode($salon);

?>

