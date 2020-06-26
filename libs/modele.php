<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre TP d'identification. Deux parties sont à compléter, en suivant les indications données dans le support de TP
*/



/********* EXERCICE 2 : prise en main de la base de données *********/


// inclure ici la librairie faciliant les requêtes SQL (en veillant à interdire les inclusions multiples)
include_once("libs/maLibSQL.pdo.php");

function getPseudo($idJoueur) {
	$sql = "SELECT pseudo FROM joueurs WHERE idJoueur='$idJoueur'";
	return SQLGetChamp($sql);
}

function getColor($idJoueur) {
	$sql = "SELECT color FROM joueurs WHERE idJoueur='$idJoueur'";
	return SQLGetChamp($sql);
}

function nbCarres($idJoueur) {
	$sql = "SELECT nbCarres FROM joueurs WHERE idJoueur='$idJoueur'";
	return SQLGetChamp($sql);
}

function getNbVictoires($idJoueur) {
	$sql = "SELECT nbVictoires FROM joueurs WHERE idJoueur='$idJoueur'";
	return SQLGetChamp($sql);
}

function getNbDefaites($idJoueur) {
	$sql = "SELECT nbDefaites FROM joueurs WHERE idJoueur='$idJoueur'";
	return SQLGetChamp($sql);
}

function getJoueursSalon($idSalon) {
	$sql = "SELECT idJoueurs FROM salons WHERE idSalon='$idSalon'";
	return SQLGetChamp($sql);
}

function getNombreJoueurs($idSalon) {
	$sql = "SELECT nbJoueurs FROM salons WHERE idSalon='$idSalon'" ;
	return SQLGetChamp($sql);
}

function getNomSalon($idSalon) {
	$sql = "SELECT nomSalon FROM salons WHERE idSalon='$idSalon'";
	return SQLGetChamp($sql);
}

function getRatio($idJoueur) {
	$vic = SQLGetChamp("SELECT nbVictoires FROM joueurs WHERE idJoueur='$idJoueur'");
	$def = SQLGetChamp("SELECT nbDefaites FROM joueurs WHERE idJoueur='$idJoueur'");
	if($vic==0 && $def==0){
		return 0;
	}
	$ratio = $vic/($def+$vic);
	return $ratio;
}

function listerJoueurs(){
	$SQL= "SELECT * FROM joueurs";
	return parcoursRs(SQLSelect($SQL));
}
//rajouté par fberge : on modifie la colonne "connecte" de la table joueurs
function connexionBdd($id){
	$SQL ="UPDATE joueurs SET connecte=1 WHERE idJoueur=$id";
	return SQLUpdate($SQL);
}

function deconnexionBdd($id){
	$SQL ="UPDATE joueurs SET connecte=0 WHERE idJoueur=$id";
	return SQLUpdate($SQL);
}

function listerJoueursConnectes(){
	$SQL = "select * from joueurs where connecte=1";
	return parcoursRs(SQLSelect($SQL));
}

function listerSalonsDisponibles(){
	$SQL = "select * from salons where started=0";
	return parcoursRs(SQLSelect($SQL));
}

function creerSalon($nomSalon, $nbJoueurs){
	$SQL = "INSERT INTO salons(`nomSalon`, `nbJoueurs`) VALUES('$nomSalon', '$nbJoueurs')";
	return SQLInsert($SQL);
}







/********* EXERCICE 4 *********/

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL = "SELECT idJoueur FROM joueurs WHERE pseudo='$login' AND passe='$passe'";
	return SQLGetChamp($SQL);
	
	// On utilise SQLGetCHamp
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}







?>
