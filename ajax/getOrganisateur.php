<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getOrganisateur($_REQUEST['idp']);
		if (isset($reponse)) {

			$result["organisateur"]= array() ;
			$organisateur = array() ;
			$organisateur['nom'] = $reponse->nom;
			$organisateur['prenom'] = $reponse->prenom;
			$organisateur['ville'] = $reponse->ville;
			$organisateur['adresse'] = $reponse->adresse;
			$organisateur['tel'] = $reponse->tel;
			$organisateur['mail'] = $reponse->mail;
			$organisateur['siteWeb'] = $reponse->siteweb;
			$organisateur['idp'] = $reponse->id;
			$organisateur['evenements'] = $reponse->lesEvenements;
			$organisateur['nombrePlaces'] = $reponse->nombreplaces;
			$result["organisateur"]=$organisateur;

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
