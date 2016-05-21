<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;
	$result["artiste"] = array();

	if (isset($_REQUEST['idArtiste'])) {
			$reponse=$dao->getArtiste($id);
		if (isset($reponse)) {

			$artiste = array() ;
			$artiste['nom'] = $reponse->nom;
			$artiste['ville'] = $reponse->ville;
			$artiste['adresse'] = $reponse->adresse;
			$artiste['tel'] = $reponse->tel;
			$artiste['mail'] = $reponse->mail;
			$artiste['idp'] = $reponse->id ;

		} else {
			$result["status"] = "error" ;
			$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}
	} else {
		$result["status"] = "error" ;
		$result["errMessage"] = "Param�tre idPersonne manquant" ;
	}

		echo json_encode($result) ;
?>
