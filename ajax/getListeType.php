<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


		$reponse=$dao->getListeType();
		if (isset($reponse)) {
			$result["types"]= array() ;
			$result["types"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}


		echo json_encode($result) ;
?>
