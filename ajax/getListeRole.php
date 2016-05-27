<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


		$reponse=$dao->getListeRole();
		if (isset($reponse)) {
			$result["roles"]= array() ;
			$result["roles"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}


		echo json_encode($result) ;
?>
