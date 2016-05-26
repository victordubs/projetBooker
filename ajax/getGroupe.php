<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getGroupe($_REQUEST['idp']);
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
	} else {
		$result["status"] = "error" ;
		$result["errMessage"] = "Param�tre idPersonne manquant" ;
	}

		echo json_encode($result) ;
?>
