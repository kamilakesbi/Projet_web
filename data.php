<?php


$joueur1 = array("id"=>0, "color"=>"ForestGreen");
$joueur2 = array("id"=>1, "color" =>"Aqua");
$joueur3 = array("id"=>2, "color" =>"DarkOrange");


$joueurs = array("joueur1"=>$joueur1, "joueur2"=>$joueur2, "joueur3"=>$joueur3);
$salon = array( "joueurs"=>$joueurs, "nombreJoueurs"=>3);

echo json_encode($salon);

?>

