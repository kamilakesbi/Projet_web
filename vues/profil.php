<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "users.php")
{
	header("Location:../index.php?view=users");
	die("");
}



// Hypo : l'user doit etre connecté 
if (! valider("connecte","SESSION")) {
	header("Location:?view=accueil&msg_feedback=" . urlencode("Il faut etre connecte !"));
	die("");
}

?>

<h1>Mon profil :</h1>

<?php

echo "Utilisateur <b>$_SESSION[pseudo]</b> :"
echo "Nombre de parties gagnées : <b>$_JOUEURS[nbVictoires]</b> &nbsp; ";
echo "Nombre de parties perdues : <b>$_SESSION[nbDefaites]</b> &nbsp; ";

?>


















