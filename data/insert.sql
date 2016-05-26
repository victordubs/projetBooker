INSERT INTO artistes values ('testArtiste1@gmail.com',0000000001,'testArtiste1.com',0001,'villeArtiste1','adresse Artiste 1','Artiste','Numéro1');

INSERT INTO organisateurs values ('testOrganisateur1@gmail.com',0000000002,'testOrganisateur.com',0002,'villeOrg1','adresse Organisateur 1','Org','Numéro1',100);

INSERT INTO autresContact values ('testAutre1@gmail.com',0000000003,'testAutre.com',0003,'villeOrg1','adresse Autre 1','Autre','Numéro1','métier1');

INSERT INTO groupes values ('testGroupe1@gmail.com',0000000004,'testGroupe.com',0004,'villeGroupe1','adresse Groupe 1','nomGroupe 1','Rock');

INSERT INTO role values ('guitariste'),('batteur'),('chanteur'),('pianiste');

INSERT INTO style values('Rock'),('Pop'),('Classique');

INSERT INTO type values ('Publicite'), ('Radio'), ('Communication');

INSERT INTO evenement values (0001,'Evenement 1','2016-04-04','2016-04-05','Un evenement de qualité','12:00:00','02:00:00');

INSERT INTO liaisonGroupeStyle values (0004,'Rock');

INSERT INTO liaisonAutresContactType values (0003,'Publicite');

INSERT INTO liaisonArtisteRole values(0001,'chanteur');

INSERT INTO liaisonArtisteGroupe values(0001,0004);

INSERT INTO liaisonGroupeAutresContact values(0004,0003);	

INSERT INTO liaisonEvenementOrganisateur values(0002,0001);

INSERT INTO plageHoraire values('13:00:00','15:00:00',0001,0004);

