<?php

//C'est la propriété php_self qui nous l'indique :
// Quand on vient de index :
// [PHP_SELF] => /chatISIG/index.php
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=accueil");
    die("");
}


?>

<style>
    #entete {
        padding:10px;
        border-bottom-color: black;
        border-bottom-style:solid;
        border-bottom-width:3px;
    }
    #entete a {
        padding-right : 20px;
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
    #titrePage {
        text-align: center;
    }
    #titre {
        margin:10px;
    }
    li {
        margin-left:20px;
        margin-bottom:10px;
    }
    .P2 {
        display: inline;
        margin-left:20px;
    }
    textarea {
        height:20px;
    }
    select{
        margin-top:10px;
    }
    #creerSalon {
        margin-left:50px;
        margin-top:10px;
        margin-bottom:10px;
    }
    .P3 {
        display:inline;
        margin-right:40px;
    }
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>
    <title> Accueil jeu des petits carrés </title>
</head>

<!-- **** B O D Y **** -->
<body>
<!-- modif par fberge : selon moi il faut les mettre dans le header
    <div id="entete">
        <a href="vues/accueil.php">Accueil</a>
        <a href="vues/login.php">Deconnexion</a>
        <a href="vues/profil.php">Profil</a>
    </div>
    -->
   <h1 id="titrePage">Accueil</h1>

   <div id="autresJoueurs" class="cadre">
       <h3 id="titre">Liste des autres joueurs connectes</h3>
       <!-- Devra être mise à jour avec la liste des joueurs connectés -->
       <li> Joueur 1</li>
       <li> Joueur 2</li>
       <li>A rendre dynamique</li>
   </div>

<div id="creerSalons" class="cadre">
    <h3 id="titre">Creer un salon</h3>
    <p class="P2">Nom du salon : </p>
    <textarea id="nomSalon" value="Choisir un nom de salon"></textarea> </br>
    <p class="P2">Nombre de joueurs : </p>
    <select id="nbJoueurs">
        <option value="2"> 2 joueurs </option>
        <option value="3"> 3 joueurs </option>
        <option value="4"> 4 joueurs </option>
    </select> </br>
    <input id="creerSalon" type="button" value="Creer un nouveau salon"/>

</div>

<div id="salonsDisponibles" class="cadre">
    <h3 id="titre">Liste des salons disponibles</h3>
    <!-- Devra être mise à jour avec la liste des salons disponibles -->
    <li>
        <p class="P3">Salon 1</p>
        <input id="rejoindreSalon" type="button" value="Rejoindre"/>
    </li>
    <li>
        <p class="P3">Salon 2</p>
        <input id="rejoindreSalon" type="button" value="Rejoindre"/>
    </li>
    <li>
        <p class="P3">Salon 3</p>
        <input id="rejoindreSalon" type="button" value="Rejoindre"/>
    </li>
    <li>
        <p class="P3">A rendre dynamique aussi</p>
        <input id="rejoindreSalon" type="button" value="Rejoindre"/>
    </li>
</div>

</body>