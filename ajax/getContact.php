<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;
	$result["contact"]=array();

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getContact($_REQUEST['idp']);
		if (isset($reponse)) {

			$contact = array() ;
			$contact['nom'] = $reponse->nom;
			$contact['prenom'] = $reponse->prenom;
			$contact['ville'] = $reponse->ville;
			$contact['adresse'] = $reponse->adresse;
			$contact['tel'] = $reponse->tel;
			$contact['mail'] = $reponse->mail;
			$contact['siteWeb'] = $reponse->siteweb;
			$contact['idp'] = $reponse->id;
			$contact['types'] = $reponse->type;
			$contact['groupes'] = $reponse->groupes;
			$result["contact"]=$contact;

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
