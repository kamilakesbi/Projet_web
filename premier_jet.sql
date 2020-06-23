/*DROP SCHEMA IF EXISTS JDC ;
CREATE SCHEMA JDC;*/

 
/*SET search_path TO JDC, PUBLIC;*/
 
-- -------------------------------------------------------------------------- --
--	Table joueurs
-- -------------------------------------------------------------------------- --


CREATE TABLE JOUEURS
( 
	id integer 
	GENERATED ALWAYS AS IDENTITY (START WITH 1 INCREMENT BY 1),
	pseudo  varchar (16) not NULL,
	mail varchar (64) not null,
    couleur_pseudo  varchar (16) not NULL ,
	mdp      	varchar (16) not NULL,
	connecte 	boolean not null,
	nbVictoires integer, 
	nbDefaites integer, 
	ratio numeric (3,2), 
	salon_actuel  int ,
	
	
	
	--	définition des contraintes
	
	CONSTRAINT PK_JOUEURS
					PRIMARY KEY(id),
/*	CONSTRAINT FK_JOUEURS_SALONS
					FOREIGN KEY (ID_COMPTE) */
						/*REFERENCES COMPTE_DEPOT(NUMERO),*/	
/*	CONSTRAINT FK_RATTACHEMENT_ID_TITULAIRE 
					FOREIGN KEY (ID_TITULAIRE) 
						REFERENCES PERSONNE(ID),*/
	constraint UK_JOUEURS unique (mail,pseudo),
	CONSTRAINT FK_JOUEURS_SALONS 
					FOREIGN KEY (salon_actuel) 
						REFERENCES SALONS(id_salon),
    CONSTRAINT  ck_JOUEURS_RATIO
					check (ratio between 0 and 1)
    )

;

insert into joueurs (mail,pseudo,couleur_pseudo,mdp,connecte,ratio)
values ('ulysse1603@gmail.com','Ulysse','ROUGE','OK',true,0.89),
		('KA@gmail.com','Kamilm','Bleu','Ola',true,0.56);

select * from joueurs;
-- -------------------------------------------------------------------------- --
--	Table actions
-- -------------------------------------------------------------------------- --
/*drop table ACTIONS cascade;
CREATE TABLE ACTIONS
( 
    --	attributs de la classe Compte_depot
	id_action            INTEGER 
							GENERATED ALWAYS AS IDENTITY (START WITH 1 INCREMENT BY 1),
	id_salon        INTEGER NOT NULL, 
    id_joueur     INTEGER NOT NULL,
    
	coup_jouee         integer [8] [8],     
	date_action		date ,		
	
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
		CHECK 	( coup_jouee is not null),
	
		constraint UK_ACTION unique (id_salon)
)
;
insert into ACTIONS (id_salon,id_joueur,coup_jouee , date_action ) values
(5,1,'{{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0}}',CURRENT_TIMESTAMP );
insert into ACTIONS (id_salon,id_joueur,coup_jouee , date_action ) values
(5,2,'{{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0}}',CURRENT_TIMESTAMP );
insert into ACTIONS (id_salon,id_joueur,coup_jouee , date_action ) values
(5,1,'{{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0},{1,0,0,1,0,0,1,0}}',CURRENT_TIMESTAMP );
select * from actions a ;*/
-- -------------------------------------------------------------------------- --
--	Table salons
-- -------------------------------------------------------------------------- --
drop table if EXISTS SALONS;
 
CREATE TABLE SALONS 
( 
   
	id_salon   	INTEGER
	 GENERATED ALWAYS AS IDENTITY (START WITH 1 INCREMENT BY 1),
	partie_commencee	BOOLEAN not null ,
	partie_finie		BOOLEAN not NULL,
	nom_salon      	varchar(16) NOT NULL, 
	nb_joueurs   	INTEGER NOT NULL,
	id_joueurs		integer [], 
	nb_carres   	INTEGER [],
	tour  	integer,
	
	vainqueur INTEGER,
	etat_partie INTEGER [][],  
						
	
	--	définition des contraintes
	
	CONSTRAINT PK_SALONS
					PRIMARY KEY(id_salon),

	CONSTRAINT CK_SALONS_nb_JOUEUR check (nb_joueurs between 2 and 4),
	
    CONSTRAINT CK_SALONS_PARTIE_FINIE check (partie_finie is not null)
	
	

		/* 	Nombre de cases max */
	
/*	CONSTRAINT ck_constraint_nbcarres
					check (nbcarres)
	*/
)
;
select * from SALONS;

/*
insert into SALONS (id_salon,partie_commencee,partie_finie,nom_salon ,nb_joueurs,id_joueurs,nb_carres,tour,etat_partie) values 
(1,true,false, 'test1', 3,'{121,324}','{8,9}',121,'{1,0,0,1,0,0,1,0}');
insert into SALONS (id_salon,partie_commencee,partie_finie,nom_salon ,nb_joueurs,id_joueurs,nb_carres,tour,etat_partie) values 
(2,true,false, 'test1', 3,'{121,324}','{8,9}',121,'{1,0,0,1,0,0,1}');*/


insert into SALONS (partie_commencee,partie_finie,nom_salon ,nb_joueurs,id_joueurs,nb_carres,tour,etat_partie) values 
(true, false , 'test1', 2,'{121,324,659,342,225}','{8,9}',121,'{{1,0,0,1,0,0,1,0},{1,0,1,0,1,0,1,0},{0,1,0,1,1,1,0,1}}' );


insert into SALONS (partie_commencee,partie_finie,nom_salon ,nb_joueurs,id_joueurs,nb_carres,tour,etat_partie) values 
(true, false , 'test1', 8,'{121,324,659,342,225}','{8,9}',121,'{{1,0,0,1,0,0,1,0},{1,0,1,0,1,0,1,0},{0,1,0,1,1,1,0,1}}' );
insert into SALONS (partie_commencee,partie_finie,nom_salon ,nb_joueurs,id_joueurs,nb_carres,tour,etat_partie) values 
(true, false , 'test1', 2,'{121,324,659,342,225}','{8,9}',121,'{{1,0,0,1,0,0,1,0},{1,0,1,0,1,0,1,0},{0,1,0,1,1,1,0,1}}' );


-- -------------------------------------------------------------------------- --
--	Table Messages
-- -------------------------------------------------------------------------- --
CREATE TABLE MESSAGES(
  id_message int(11) NOT NULL COMMENT 'Identifiant du message',
  id_conversation int(11) NOT NULL COMMENT 'Clé étrangère vers la table des conversations',
  id_Auteur int(11) NOT NULL COMMENT 'clé étrangère vers la table des auteurs',
  contenu varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Contenu du message'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- -------------------------------------------------------------------------- --
--	Table Conversations
-- -------------------------------------------------------------------------- --

CREATE TABLE CONVERSATIONS (
  id_conv int(11) NOT NULL COMMENT 'Clé primaire',
  active tinyint(1) NOT NULL DEFAULT '1' COMMENT 'indique si la conversation est active',
  theme varchar(40) CHARACTER SET latin1 NOT NULL COMMENT 'Thème de la conversation'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



/* Mettres les données des tazbleaux entre accolades et les doubler pour tableau double entree */
