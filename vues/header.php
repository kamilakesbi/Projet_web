<?php



// On envoie l'entête Content-type correcte avec le bon charset
header('Content-Type: text/html;charset=utf-8');

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<title>Jeu des carrés</title>
	<link rel="stylesheet" type="text/css" href="ressources/style.css">
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="banniere">


<?php

    // Si l'utilisateur n'est pas connecte, on affiche un lien de connexion
    if (!valider("connecte","SESSION")){
        //supprimé par fberge : ce lien est inutile puisque la
        //première chose à faire est de se connecter
        //echo "<a href=\"index.php?view=login\">Se connecter</a>";
    }

    else{
        //une fois que l'on est connecté apparaissent les liens
        echo "<a href=\'index.php?view=accueil\'>Accueil</a>";
        echo "<a href=\'index.php?view=salons\'>Salons</a>";
        echo "<a href=\'index.php?view=login\'>Profil</a>";
    }
?>

<h1 id="stitre"> Jeu des carrés </h1>

</div>
