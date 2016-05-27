<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


		$reponse=$dao->getListeStyle();
		if (isset($reponse)) {
			$result["styles"]= array() ;
			$result["styles"]=$reponse;
		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}


		echo json_encode($result) ;
?>
