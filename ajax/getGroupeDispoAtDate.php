<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getOrganisateur($_REQUEST['idp']);
		if (isset($reponse)) {

			$result["groupesDispo"]= array() ;
			$groupesDispo = array() ;
			$groupesDispo['nom'] = $reponse->nom;
			$groupesDispo['idp'] = $reponse->id;
			$result["groupesDispo"]=$groupesDispo;

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
