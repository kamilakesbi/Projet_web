<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game</title>
</head>

<script src="jquery-3.4.1.min.js">
</script>

<script>
    var canvas;
    var ctx;
    var path_lines;
    var path_squares;
    var salon;
    var idLastPlayer = 0;
    var refListJoueurs ;
    var refTitre;
    var nbCarres = [0,0,0];

    function init(){

        //On obtient les joueurs et leurs informations :
        salon = $.parseJSON($.ajax({
            type: "GET",
            url: './data.php',
            async : false,
            dataType : "json"
        }).responseText);

        refTitre = document.getElementById("titre");
        refTitre.innerHTML = salon["nomSalon"];

        canvas = document.getElementById("canvas");
        ctx = canvas.getContext("2d");

        // Création des points du canevas  :
        for (var i=1 ; i<10 ; i++){
            for (var j=1 ; j<10 ; j++) {
                ctx.fillRect(i*50, j*50, 5, 5);
            }
        }



        // Création des lignes du Canevas, que l'on stock dans une matrice path_lines :
        path_lines = [];
        for (var i =1 ; i<9; i++){
            for (var j=1; j<9; j++){
                path_lines.push(creatLine(i*50+5 , j*50 + 2.5, (i+1)*50, j*50 +2.5));
                path_lines.push(creatLine(i*50 + 2.5, j*50 +5, i*50 +2.5, (j+1)*50));
            }
        }
        // Ajout de lignes sur les bords :
        for (var j =1 ; j<9; j++){
            path_lines.push(creatLine(9*50 +2.5, j*50+5, 9*50 +2.5, (j+1)*50));
        }
        for (var i =1 ; i <9; i ++){
            path_lines.push(creatLine(i*50+ 5, 9*50 + 2.5, (i+1)*50, 9*50 + 2.5));
        }

        // variable qui stock tous les carrés définis :
        path_squares = [];

        refListJoueurs = document.getElementById("listeJoueurs");
        writePlayers();

    }

    // Fonction qui permet de surligner une ligne lors du passage de la souris par dessus,
    // Si elle n'a pas déjà été clické.
    function hoverOnLine(event){
        var XYrect = canvas.getBoundingClientRect();
        var Xcurseur = Math.round(event.clientX - XYrect.left);
        var Ycurseur = Math.round(event.clientY - XYrect.top);


        for (var p=0; p <path_lines.length; p++) {
            if (path_lines[p].clicked == false) {
                if (ctx.isPointInStroke(path_lines[p].object, Xcurseur, Ycurseur)) {

                    ctx.strokeStyle = 'red';
                    ctx.fill();
                    ctx.stroke(path_lines[p].object);

                } else {

                    ctx.strokeStyle = '#DCDCDC';
                    ctx.fill();
                    ctx.stroke(path_lines[p].object);
                }
            }
        }

    }

    // Fonction qui permet de surligner une ligne de façon permanente,
    // Une fois que l'on a cliqué dessus.
    function clickOnLine(event) {
        var XYrect = canvas.getBoundingClientRect();
        var Xcurseur = Math.round(event.clientX - XYrect.left);
        var Ycurseur = Math.round(event.clientY - XYrect.top);


        // Mettre du PHP pour savoir si c'est au tour de la personne connectée de jouer

        for (var p=0; p <path_lines.length; p++) {
            if (ctx.isPointInStroke(path_lines[p].object, Xcurseur, Ycurseur)) {
                if (path_lines[p].clicked == true){

                } else {
                    joueur = whosTurn();

                    ctx.strokeStyle = joueur.color;
                    ctx.fill();
                    path_lines[p].clicked = true;
                    ctx.stroke(path_lines[p].object);
                    isSquare(Xcurseur, Ycurseur, joueur.color);
                    writePlayers();
                    // Ajax pour mettre en base le canevas actuel
                }

            }
        }

    }

    // fonction qui permet de créer une ligne.
    // Retourne un JSON avec :
    //              - L'objet ligne
    //              - Booléen pour savoir si l'on a cliqué sur l'objet ou non.
    function creatLine(x,y,a,b, color ='#dcdcdc', clicked = false) {
        line = new Path2D();
        line.moveTo(x,y);
        line.lineTo(a, b);
        ctx.strokeStyle = color;
        ctx.lineWidth = 3;
        ctx.stroke(line);
        return {
            object : line,
            clicked : clicked
        };
    }

    // fonction qui permet de créer un carré, dont l'extrémité haut/gauche se situe aux coordonnées x,y.
    // possibilité de spécifier la couleur du carré.
    function creatSquare(x, y, color){
        square = new Path2D();
        square.strokeStyle = color;
        //ctx.fillStyle = color ;
        square.rect(x, y, 35, 35);
        ctx.stroke(square);
        return square

    }

    // Fonction qui place et affiche les différents carrés de la partie :
    function isSquare(x, y, color) {

        for (var p = 0; p < path_lines.length; p++) {
            if (path_lines[p].clicked) {
                for (var i = 0; i < 9; i++) {
                    for (var j = 0; j < 9; j++) {
                        if (isSquareAlreadydefined(i,j) == false) {
                            //ligne horizontale collée à (i,j)
                            if (ctx.isPointInStroke(path_lines[p].object, i * 50 + 25, j * 50 + 2.5)) {
                                for (var k = 0; k < path_lines.length; k++) {
                                    if (path_lines[k].clicked) {
                                        // ligne verticale collée à (i,j)
                                        if (ctx.isPointInStroke(path_lines[k].object, i * 50 + 2.5, j * 50 + 25)) {
                                            for (var l = 0; l < path_lines.length; l++) {
                                                if (path_lines[l].clicked) {
                                                    // ligne verticale collée à (i+1,j)
                                                    if (ctx.isPointInStroke(path_lines[l].object, (i + 1) * 50 + 2.5, j * 50 + 25)) {
                                                        for (var m = 0; m < path_lines.length; m++) {
                                                            if (path_lines[m].clicked) {
                                                                // ligne horizontale collée à (i,j +1)
                                                                if (ctx.isPointInStroke(path_lines[m].object, i * 50 + 25, (j + 1) * 50 + 2.5)) {

                                                                    path_squares.push(creatSquare(i * 50 + 10, j * 50 + 10, color));

                                                                    idLastPlayer -=1;
                                                                    idLastPlayer = idLastPlayer % salon["nombreJoueurs"];
                                                                    //Mettre de l'ajax ici pour update nbCarres

                                                                    nbCarres[idLastPlayer]+=1;

                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }

            }

        }
    }

    // Retourne un json contenant le joueur dont c'est le tour de jouer
    // incrémente idLastplayer
    function whosTurn(){
        //console.log(idLastPlayer);
        for (j in salon.joueurs){
            if (salon["joueurs"][j].idJoueur == idLastPlayer){
                idLastPlayer++;
                idLastPlayer = idLastPlayer % salon["nombreJoueurs"];
                return salon["joueurs"][j];
            }
        }
    }

    // détermine si un carré est déjà défini ou non,
    // de sorte à ce qu'on ne modifie pas sa couleur à chaque click dans isSquare
    function isSquareAlreadydefined(i, j) {
        for (var o=0; o < path_squares.length; o++ ){
            if (ctx.isPointInStroke(path_squares[o],i * 50 + 11, j * 50 + 11)){
                return true;
            }
        }
        return false;
    }

    // Place les pseudos des joueurs dans un div sous forme de liste
    // pseudo en couleurs
    // celui dont c'est le tour de jouer est en gras.
    function writePlayers(){

        refListJoueurs.innerHTML = "<h1>Liste des joueurs </h1>";
        for (j in salon.joueurs){
            if (salon.joueurs[j]["idJoueur"] == idLastPlayer){
                var nb = nbCarres[salon.joueurs[j]["idJoueur"]];
                //nbCarres = salon.joueurs[j].nbCarres;
                couleur = salon.joueurs[j].color;
                refListJoueurs.innerHTML += "<li style='color:" +couleur + "; font-weight: bolder;'>"+ j + " : " +nb.toString() +"</li>";
                refListJoueurs.innerHTML += "<br/>";
            } else {
                var nb = nbCarres[salon.joueurs[j]["idJoueur"]];
                //nbCarres = salon.joueurs[j].nbCarres;
                couleur = salon.joueurs[j].color;
                refListJoueurs.innerHTML += "<li style='color:" +couleur + ";'>"+ j +  " : " +nb.toString() +"</li>";
                refListJoueurs.innerHTML += "<br/>";
            }

        }
    }

    function incrementNbCarres(joueur){
        var n = joueur.nbCarres;
        n++;
        /*
        $.ajax({
            type: "PUT",
            url: 'data.php',
            data : {
                "session": true,
            }
            success: function(oRep){
                console.log(oRep);
            },
            dataType: "json"
        });*/
    }

    function endPartie(){
        for (var i = 0; i < 9; i++) {
            for (var j = 0; j < 9; j++) {
            }
        }
    }


</script>

<style>


    #listeJoueurs {
        border : 3px solid black ;
        float : left ;
        display : inline
    }

    canvas {
        border: 1px solid black ;
        display: inline;
        float : left;
    }
</style>

<body onload="init();">

<h1 id="titre"> Nom du salon  </h1>

<canvas id="canvas" width="500" height="500"  onmousemove="hoverOnLine(event);" onclick="clickOnLine(event);">
    Texte alternatif pour les navigateurs ne supportant pas Canvas.
</canvas>

<div id="listeJoueurs">
    <h1> Liste des Joueurs du Salon : </h1>

</div>

</body>
</html>
