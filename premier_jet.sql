


/*DROP SCHEMA IF EXISTS JDC ;


CREATE SCHEMA JDC;*/

 
/*SET search_path TO JDC, PUBLIC;*/
 

-- -------------------------------------------------------------------------- --
--	Table salons
-- -------------------------------------------------------------------------- --
drop table SALONS;
 
CREATE TABLE SALONS 
( 
   
	id_salon   	INTEGER, 
					 	
	partie_commencee	BOOLEAN not null ,
	partie_finie		BOOLEAN not NULL,
	nom_salon      	varchar(16) NOT NULL, 
	nb_joueurs   	INTEGER NOT NULL,
	
	id_joueurs		INTEGER array[4], 
	nb_carres   	INTEGER array,
	tour  	INTEGER,
	
	vainqueur INTEGER,
	etat_partie INTEGER array,  
						
	
	--	définition des contraintes
	
	CONSTRAINT PK_SALONS
					PRIMARY KEY(id_salon),

		
	CONSTRAINT CK_SALONS_PARTIE_FINIE check (partie_finie is not null)
	
	

		/* 	Nombre de cases max */
	
/*	CONSTRAINT ck_constraint_nbcarres
					check (nbcarres)
	*/
)
;
select * from SALONS;

-- -------------------------------------------------------------------------- --
--	Table actions
-- -------------------------------------------------------------------------- --

CREATE TABLE ACTIONS
( 
    --	attributs de la classe Compte_depot
	id_action            INTEGER 
							GENERATED ALWAYS AS IDENTITY,
	id_salon        INTEGER NOT NULL, 
    id_joueur     INTEGER NOT NULL,
    
	coup_jouee         integer array,     
	date_action		date,		
	
		--définition des contraintes
	CONSTRAINT PK_ACTIONS
						PRIMARY KEY(id_action),
	CONSTRAINT FK_ACTIONS_JOUEURS 
					FOREIGN KEY (id_joueur) 
						REFERENCES JOUEURS(id),	
	CONSTRAINT FK_ACTIONS_SALONS 
					FOREIGN KEY (id_salon) 
						REFERENCES SALONS(id_salon),

	
	
	CONSTRAINT CK_ACTIONS_coup_jouee
		CHECK 	( coup_jouee is not null)
)
;


-- -------------------------------------------------------------------------- --
--	Table joueurs
-- -------------------------------------------------------------------------- --
drop table JOUEURS;

CREATE TABLE JOUEURS
( 
	id integer ,
	pseudo  varchar (16) ,
    couleur_pseudo  varchar (16) ,
	mdp      	varchar (16) ,
	connecte 	boolean not null,
	nbVictoires integer, 
	nbDefaites integer, 
	isPlaying  boolean not null,
	
	
	
	--	définition des contraintes
	
	CONSTRAINT PK_JOUEURS
					PRIMARY KEY(id)
/*	CONSTRAINT FK_JOUEURS_SALONS
					FOREIGN KEY (ID_COMPTE) */
						/*REFERENCES COMPTE_DEPOT(NUMERO),*/	
/*	CONSTRAINT FK_RATTACHEMENT_ID_TITULAIRE 
					FOREIGN KEY (ID_TITULAIRE) 
						REFERENCES PERSONNE(ID),*/
	
	
)
;

