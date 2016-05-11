<?php
	include "artistes.php" ;
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idArtiste'])) {
		if (isset($artistes[$_REQUEST['idArtiste']])) {
			// On a re�u idPersonne en POST OU GET, on a une personne avec cet id
			$result["artiste"] = $artistes[$_REQUEST['idArtiste']];
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
