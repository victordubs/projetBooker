<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
include_once("getArtiste.php");
$result = array() ;
//$result["status"] = "success" ;
//$_REQUEST['idArtiste']=1;


//test pour getArtiste
/*	$result = $dao->getArtiste(1);
	var_dump($result);*/
/*
	$reponse=$dao->getArtiste(1);
	if (isset($reponse)) {

		$artiste = array() ;
		$artiste['nom'] = $reponse->nom;
		$artiste['prenom'] = $reponse->prenom;
		$artiste['ville'] = $reponse->ville;
		$artiste['adresse'] = $reponse->adresse;
		$artiste['tel'] = $reponse->tel;
		$artiste['mail'] = $reponse->mail;
		$artiste['siteWeb'] = $reponse->siteweb;
		$artiste['idp'] = $reponse->id;
		$artiste['roles'] = $reponse->role;
		$artiste['groupes'] = $reponse->groupes;
		$result["artiste"]=$artiste;

	} else {
		$result["status"] = "error" ;
		//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
	}

	var_dump($result["artiste"]);
*/


//test pour autre contact

/*	$result = $dao->getContact(3);
	var_dump($result);*/
/*
		$reponse=$dao->getContact(3);
		if (isset($reponse)) {

			$artiste = array() ;
			$artiste['nom'] = $reponse->nom;
			$artiste['prenom'] = $reponse->prenom;
			$artiste['ville'] = $reponse->ville;
			$artiste['adresse'] = $reponse->adresse;
			$artiste['tel'] = $reponse->tel;
			$artiste['mail'] = $reponse->mail;
			$artiste['siteWeb'] = $reponse->siteweb;
			$artiste['idp'] = $reponse->id;
			$artiste['types'] = $reponse->type;
			$artiste['groupes'] = $reponse->groupes;
			$result["artiste"]=$artiste;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}



	var_dump($result["artiste"]);
*/

//test pour organisateur

/*	$result = $dao->getOrganisateur(2);
	var_dump($result);*/


	/*	$reponse=$dao->getOrganisateur(2);
		if (isset($reponse)) {

			$artiste = array() ;
			$artiste['nom'] = $reponse->nom;
			$artiste['prenom'] = $reponse->prenom;
			$artiste['ville'] = $reponse->ville;
			$artiste['adresse'] = $reponse->adresse;
			$artiste['tel'] = $reponse->tel;
			$artiste['mail'] = $reponse->mail;
			$artiste['siteWeb'] = $reponse->siteweb;
			$artiste['idp'] = $reponse->id;
			$artiste['evenements'] = $reponse->lesEvenements;
			$artiste['nombrePlaces'] = $reponse->nombreplaces;
			$result["artiste"]=$artiste;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

	var_dump($result["artiste"]);*/


//test des groupes
/*	$result = $dao->getGroupe(4);
	var_dump($result);
*/
/*

		$reponse=$dao->getGroupe(4);
		if (isset($reponse)) {

			$groupe = array() ;
			$groupe['nom'] = $reponse->nom;
			$groupe['styles'] = $reponse->styles;
			$groupe['ville'] = $reponse->ville;
			$groupe['adresse'] = $reponse->adresse;
			$groupe['tel'] = $reponse->tel;
			$groupe['mail'] = $reponse->mail;
			$groupe['siteWeb'] = $reponse->siteweb;
			$groupe['idp'] = $reponse->id;
			$groupe['evenements'] = $reponse->evenements;
			$groupe['autresContact'] = $reponse->autresContacts;
			$groupe['artistes']= $reponse->artistes;
			$result["groupe"]=$groupe;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}


		var_dump($result["groupe"]);*/


//test de get groupedispoatdate
/*	$result = $dao->getGroupeDispoAtDate("'2016-05-05'");
	var_dump($result);*/

	/*	$reponse=$dao->getGroupeDispoAtDate("'2016-05-05'");
		if (isset($reponse)) {
			$result["groupesDispo"]= array() ;
			for($i=0;$i<count($reponse);$i++){
				$groupesDispo = array() ;
				$groupesDispo['nom'] = $reponse[$i]['nom'];
				$groupesDispo['idp'] = $reponse[$i]['id'];
				$result["groupesDispo"][$i]=$groupesDispo;
			}

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

	var_dump($result["groupesDispo"]);*/


//test getevenement
/*	$result = $dao->getEvenement(1);
	var_dump($result);*/
/*
		$reponse=$dao->getEvenement(1);
		if (isset($reponse)) {

			$result["evenement"]= array() ;
			$evenement = array() ;
			$evenement['nom'] = $reponse->nom;
			$evenement['datedebut'] = $reponse->datedebut;
			$evenement['datefin'] = $reponse->datefin;
			$evenement['libelle'] = $reponse->libelle;
			$evenement['heuredebut'] = $reponse->heuredebut;
			$evenement['heurefin'] = $reponse->heurefin;
			$evenement['organisateurs'] = $reponse->organisateurs;
			$evenement['idp'] = $reponse->id;
			$evenement['plages'] = $reponse->plages;
			$result["evenement"]=$evenement;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

		var_dump($result["evenement"]);*/

// test liste evenement
/*	$result = $dao->getListeEvenements();
	var_dump($result);*/
/*$reponse=$dao->getListeEvenements();
		if (isset($reponse)) {
			$result["evenements"]= array() ;
			for($i=0;$i<count($reponse);$i++){
				$evenements = array() ;
				$evenements['nom'] = $reponse[$i]['nom'];
				$evenements['idp'] = $reponse[$i]['id'];
				$evenements['datedebut'] = $reponse[$i]['datedebut'];
				$result["evenements"][$i]=$evenements;
			}

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}
var_dump($result["evenements"]);*/


//test listeRole
/*$result = $dao->getListeRole();
var_dump($result);*/
/*		$reponse=$dao->getListeRole();
		if (isset($reponse)) {
			$result["evenements"]= array() ;
			$result["evenement"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

	var_dump($result["evenement"]);*/

//test liste style
/*$reponse=$dao->getListeStyle();
		if (isset($reponse)) {
			$result["styles"]= array() ;
			$result["styles"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

var_dump($result["styles"]);*/

//liste type
$reponse=$dao->getListeType();
		if (isset($reponse)) {
			$result["types"]= array() ;
			$result["types"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

var_dump($result["types"]);

  ?>
