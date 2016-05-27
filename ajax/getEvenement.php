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
			$evenement['dateDeb'] = $reponse->datedebut;
			$evenement['dateFin'] = $reponse->datefin;
			$evenement['libelle'] = $reponse->libelle;
			$evenement['heureDeb'] = substr($reponse->heuredebut,0,-3);
	  	$evenement['heureFin'] = substr($reponse->heurefin,0,-3);
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

}
		echo json_encode($result) ;
?>
