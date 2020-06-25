<?php
session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$qs = "";

	if ($action = valider("action"))
	{
		ob_start ();

		echo "Action = ". $action ." <br />";

		// ATTENTION : le codage des caractères peut poser PB 
		// si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		/* TODO: exercice 4
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{
			
			// Connexion //////////////////////////////////////////////////


			case 'Connexion' :
				// On verifie la presence des champs login et passe
				$qs="?view=login&msg=".urlencode("Identifiants vides !");
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					// On verifie l'utilisateur, et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if($id=verifUser($login,$passe)){
						//joueur conncecté
						connexionBdd($id);//on dit a la bdd que le joueur est connecte
						$qs="?view=accueil&msg=".urlencode("Bienvenue ")."$login";
					}
					else{
						$qs="?view=login&msg=".urlencode("Identifiants incorrects !");
					}
				}

				// On redirigera vers la page index automatiquement
			break;

			case 'Creation salon' :
				if($nomSalon=valider("nomSalon"))
				if($nbJoueurs=valider("nbJoueurs")){
					creerSalon($nomSalon, $nbJoueurs);
				}
				$qs="?view=jeu"; //il faudra mettre cette ligne quand
									//la vue jeu sera dispo
				//$qs="?view=accueil";
			break;

			//Lorsque l'on rejoint un salon, on est dirigé sur la page de jeu
			case 'Rejoindre' :
				$qs="?view=jeu";
			break;

			case 'Interdire' :
				if($idUser = valider("idUser")){
					interdireUtilisateur($idUser);
					$qs= "?view=users&idLastUser="."$idUser";
				}
			break;

			case 'Autoriser' :
				if($idUser = valider("idUser")){
					autoriserUtilisateur($idUser);
					$qs= "?view=users&idLastUser="."$idUser";
				}
			break;

			case 'Logout':
				$id=$_SESSION["idJoueur"];
				session_destroy();
				deconnexionBdd($id);
				$qs="?view=login&msg=".urlencode("A bientôt, au revoir !");
			break;

			case 'Archiver':
				if($idConv = valider("idConv")){
					archiverConversation($idConv);
					$qs= "?view=conversations&idLastConv="."$idConv";
				}
			break;

			case 'Réactiver' :
				if($idConv = valider("idConv")){
					reactiverConversation($idConv);
					$qs= "?view=conversations&idLastConv="."$idConv";
				}
			break;

			case 'Supprimer' :
				if($idConv = valider("idConv")){
					supprimerConversation($idConv);
					$qs= "?view=conversations&idLastConv="."$idConv";
				}
			break;
		}

	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	header("Location:" . $urlBase . $qs);
	//qs doit contenir le symbole '?'

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>










