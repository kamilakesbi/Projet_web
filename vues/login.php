<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<style>
    .label {
        display: inline;
        margin-bottom: 30px;
    }
    #titrePage {
        text-align: center;
        margin-bottom: 50px;
    }
    #titre {
        margin-bottom: 30px;
        background: linear-gradient(#FDC777, #FA8519);       
    }
    #connexion {
        text-align: center;
        border-style: solid;
        padding-bottom: 10px;
        background: linear-gradient(#F0FFF0, lightgrey);
        margin-top: 100px;
           }
    
    h3 {
		color: #5A3714;
	}
    
    body {
	    background: linear-gradient(#FFF5EE, #FFF0F5);
    
    .val {
        height: 20px;
        margin-top: 5px;
    }
    #btnConnexion {
        margin-top: 10px;
        margin-left: 60px;
        width: 150px;
        height: 40px;
    }
    #creerCompte {
        margin-top: 30px;
        text-align: center;
        border-style: solid;
        padding-bottom: 10px;
       	background: linear-gradient(#F0FFF0, #E2FCFB);
    }
    #btnCreerCompte {
        width: 150px;
        height: 40px;
    }
</style>

<!-- **** H E A D **** -->
<head>
    <title> Connexion jeu des petits carrés </title>
</head>

<!-- **** B O D Y **** -->
<body>
    <!--<h1 id="titrePage">Le jeu des petits carrés</h1> -->
    <form action="controleur.php" method="GET">
        <div id="connexion">
            <h3 id="titre">Se connecter </h3>
            <p class="label">Identifiant</p>
            <input type="text" name="login" class="val"></input> </br> <!--modifié par fberge : pas besoin d'un textarea, et rajout d'un name -->
            <p class="label">Mot de passe</p>
            <input type="password" name="passe" class="val"></input> <!--modifié par fberge : pas besoin d'un textarea, et rajout d'un name -->
            <input id="btnConnexion" type="submit" name="action" value="Connexion"/> <!--un submit pour le form au lieu de juste un bouton -->
            <?php
            //si on recoit un message de la part du controleur, on l'affiche
            if($msg=valider("msg")){
                echo "<p style='color:red'>".$msg."</p>";
            }
            ?>

        </div>
        <div id="creerCompte">
            <h3>Créer un compte</h3>
            <input id="btnCreerCompte" type="submit" name="action" value="Créer un compte"/>
        </div>

    </form>


</body>
