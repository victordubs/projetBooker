create table contacts(
	mail varchar(30),
	tel varchar(10),
	siteWeb varchar(30),
	id numeric(4) primary key,
	ville varchar(15),
	adresse varchar(30)
);

create table personne(
	nom varchar(10),
	prenom varchar(10)
) INHERITS (contacts);

create table artistes(
	primary key(id)
) INHERITS(personne);

create table organisateurs(
	nombrePlaces numeric(5),
	primary key(id)
) INHERITS (personne);

create table autresContact(
	metier varchar(50),
	primary key(id)
)INHERITS (personne);

create table groupes(
	nom varchar(15),
	genre varchar(10),
	primary key(id)
) INHERITS (contacts);

/* Role de l'artiste : guitariste, batteur, etc. */
create table role(
	nomRole varchar(10) primary key
);

/* Style de musique du groupe */
create table style(
	nomStyle varchar(30) primary key
);

/* Type d'autre contact : publicite, radio, communication */
create table type(
	nomType varchar(50) primary key
);


create table evenement(
	id numeric(4) primary key,
	nom varchar(30),
	dateDebut date,
	dateFin date,
	libelle varchar(50),
	heureDebut time,
	heureFin time
);

create table liaisonArtisteRole(
	idArtiste numeric(4),
	nomRole varchar (10),
	foreign key (idArtiste) references artistes(id),
	foreign key (nomRole) references role(nomRole)
);

create table liaisonArtisteGroupe(
	idArtiste numeric(4),
	idGroupe numeric(4),
	foreign key (idArtiste) references artistes(id),
	foreign key (idGroupe) references groupes(id)
);

create table liaisonGroupeAutresContact(
	idGroupe numeric(4),
	idAutresContact numeric(4),
	foreign key (idGroupe) references groupes(id),
	foreign key (idAutresContact) references autresContact(id)
);

create table liaisonAutresContactType(
	idAutresContact numeric(4),
	nomType varchar(50),
	foreign key (idAutresContact) references autresContact(id),
	foreign key (nomType) references type(nomType)
);

create table liaisonGroupeStyle(
	idGroupe numeric(4),
	nomStyle varchar(30),
	foreign key(idGroupe) references groupes(id),
	foreign key (nomStyle) references style(nomStyle)
);

create table liaisonEvenementOrganisateur(
	idOrganisateur numeric(4),
	idEvenement numeric(4),
	foreign key (idOrganisateur) references organisateurs(id),
	foreign key (idEvenement) references evenement(id)
);

create table liaisonGroupeEvenement(
	idGroupe numeric(4),
	idEvenement numeric(4),
	foreign key (idGroupe) references groupes(id),
	foreign key (idEvenement) references evenement(id)
);

create table plageHoraire(
	heureDebut time,
	heureFin time,
	idEvenement numeric(4),
	idGroupe numeric(4),
	foreign key (idEvenement) references evenement(id),
	foreign key (idGroupe) references groupes(id)
);

create table login (
	id int not null primary key,
	username varchar(30) not null,
	password char(128) not null
);	


