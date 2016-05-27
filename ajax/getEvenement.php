<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getEvenement($_REQUEST['idp']);
		if (isset($reponse)) {

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
	} else {
		$result["status"] = "error" ;
		$result["errMessage"] = "Param�tre idPersonne manquant" ;
	}

		echo json_encode($result) ;
?>
