<?php



include_once("libs/modele.php");
include_once("libs/maLibUtils.php"); // tprint

?>

<style>

	#titrePage {
		text-align: center;
	}
	.cadre {
		border:solid black 2px;
		/*

        border-style: black;
        border-style:solid;
        border-width:2px;
         */
		margin: 10px;
	}
	#titre {
		margin:10px;
	}
	#label {
		margin-left:20px;
		margin-bottom:10px;
	}
	#fiche {
		margin-left:50px;
		margin-bottom:10px;
	}
	#supprimerProfil {
		margin-left:50px;
		margin-top:10px;
		margin-bottom:10px;
	}
    h4 {
        display: inline-block;
    }
    p {
        margin-left:50px;
        display: inline;
    }

</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>
	<title> Profil </title>
</head>

<!-- **** B O D Y **** -->
<body>
<!-- modif par fberge : selon moi il faut les mettre dans le header
    <div id="entete">
        <a href="vues/accueil.php">Accueil</a>
        <a href="vues/login.php">Deconnexion</a>
        <a href="vues/profil.php">Profil</a>
    </div>
    chef oui chef !
    -->
<h1 id="titrePage">Mon Profil</h1>


<div id="autresJoueurs" class="cadre">
	<h3 id="fiche">Fiche Joueur</h3>

    <h4 id="label">Pseudo :</h4>
    <?php
    $pseudo=getPseudo($_SESSION["idJoueur"]);
    echo "<p>";
    echo $pseudo;
    echo "</p>\n";
    ?> </br>

    <h4 id="label">Choix de la couleur du pseudo :</h4>
    <?php
    $color=getColor($_SESSION["idJoueur"]);
    echo "<p>";
    echo $color;
    echo "</p>\n";
    ?> </br>

    <h4 id="label">Nombre de victoires :</h4>
    <?php
    $NbVictoires=getNbVictoires($_SESSION["idJoueur"]);
    echo "<p>";
    echo $NbVictoires;
    echo "</p>\n";
    ?> </br>

    <h4 id="label">Nombre de défaites :</h4>
    <?php
    $NbDefaites=getNbDefaites($_SESSION["idJoueur"]);
    echo "<p>";
    echo $NbDefaites;
    echo "</p>\n";
    ?> </br>

    <h4 id="label">Ratio :</h4>
    <?php
    $ratio=($NbVictoires)/($NbVictoires+$NbDefaites);
    echo "<p>";
    echo $ratio;
    echo "</p>\n";
    ?> </br>

    <input id="supprimerProfil" type="submit" name="supprimerProfil" value="Supprimer Profil"/>

</div>

</body>


















