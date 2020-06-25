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

// Partie du prof

function listerUtilisateurs($classe = "both")
{
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés


	$SQL = "select * from users";
	if($classe=="bl"){
		$SQL = "select * from users where blacklist=1";
	}
	else if($classe=="nbl"){
		$SQL = "select * from users where blacklist=0";
	}

	return parcoursRs(SQLSelect($SQL));

}

function interdireUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL ="UPDATE users SET blacklist=1 WHERE id=$idUser";
	SQLUpdate($SQL);

}

function autoriserUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL ="UPDATE users SET blacklist=0 WHERE id=$idUser";
	SQLUpdate($SQL);
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


function isAdmin($idUser)
{
	// vérifie si l'utilisateur est un administrateur
	$sql = "SELECT admin FROM users WHERE id='$idUser'";
	return SQLGetChamp($sql);
	
}

/********* EXERCICE 5 *********/

function listerConversations($mode="tout")
{
	// Liste toutes les conversations ($mode="tout")
	// OU uniquement celles actives  ($mode="actives"), ou inactives  ($mode="inactives")
	$SQL = "select * from conversations";
	if($mode=="actives"){
		$SQL = "select * from conversations where active=1";
	}
	else if($mode=="inactives"){
		$SQL = "select * from conversations where active=0";
	}

	return parcoursRs(SQLSelect($SQL));

}

function archiverConversation($idConversation)
{
	// rend une conversation inactive
	$SQL ="UPDATE conversations SET active=0 WHERE id=$idConversation";
	return SQLUpdate($SQL);

}

function reactiverConversation($idConversation)
{
	// rend une conversation active
	$SQL ="UPDATE conversations SET active=1 WHERE id=$idConversation";
	return SQLUpdate($SQL);

}

function creerConversation($theme)
{
	// crée une nouvelle conversation et renvoie son identifiant
	$SQL = "INSERT INTO conversations(`theme`) VALUES('$theme')";
	return SQLInsert($SQL);

}

function supprimerConversation($idConv)
{
	// supprime une conversation et ses messages
	// Utiliser pour cela des mises à jour en cascade en appliquant l'intégrité référentielle
	$SQL = "DELETE FROM conversations WHERE id=$idConv";
	return SQLDelete($SQL);
}


/********* EXERCICE 6 *********/

function enregistrerMessage($idConversation, $idAuteur, $contenu)
{
	// Enregistre un message dans la base en encodant les caractères spéciaux HTML : <, > et & 
	// pour interdire les messages HTML

	
}
function listerMessages($idConv)
{
	// Liste les messages de cette conversation
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés
	//$SQL = "SELECT * FROM messages WHERE idConversation='$idConv'";
	$SQL="SELECT m.contenu, u.pseudo, u.couleur";
	$SQL .= " FROM messages m INNER JOIN users u ON m.idAuteur=u.id";
	$SQL .= " WHERE m.idConversation=$idConv";
	$SQL .= " AND u.blacklist=0";
	return parcoursRs(SQLSelect($SQL));


}

function listerMessagesFromIndex($idConv,$index)
{
	// Liste les messages de cette conversation, 
	// dont l'id est superieur à l'identifiant passé
	// Champs à extraire : contenu, auteur, couleur 
	// en ne renvoyant pas les utilisateurs blacklistés

}

function getConversation($idConv)
{	
	// Récupère les données de la conversation (theme, active)
	$SQL = "SELECT theme, active FROM conversations WHERE id='$idConv'";
	$listConversations = parcoursRs(SQLSelect($SQL));

	// Attention : parcoursRS nous renvoie un tableau contenant potentiellement PLUSIEURS CONVERSATIONS
	// Il faut renvoyer uniquement la première case de ce tableau, c'est à dire la case 0 
	// OU false si la conversation n'existe pas
	 
	if (count($listConversations) == 0) return false;
	else return $listConversations[0];
}

?>
