<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


	if (isset($_REQUEST['idArtiste'])) {
			$reponse=$dao->getArtiste($_REQUEST['idArtiste']);
		if (isset($reponse)) {

			$artiste = array() ;
			$artiste['nom'] = $reponse->nom;
			$artiste['prenom'] = $reponse->prenom;
			$artiste['ville'] = $reponse->ville;
			$artiste['adresse'] = $reponse->adresse;
			$artiste['tel'] = $reponse->tel;
			$artiste['mail'] = $reponse->mail;
			$artiste['siteWeb'] = $reponse->siteweb;
			$artiste['id'] = $reponse->id;
			$artiste['roles'] = $reponse->role;
			$artiste['groupes'] = $reponse->groupes;
			$result["artiste"]=$artiste;

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
