<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
include_once("getArtiste.php");
$result = array() ;
//$result["status"] = "success" ;
//$_REQUEST['idArtiste']=1;


//test pour getArtiste
	/*$result = $dao->getArtiste(1);
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
/*
	$result = $dao->getOrganisateur(2);
	var_dump($result);*/



  ?>
