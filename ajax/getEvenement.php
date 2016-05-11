<?php
	include "evenements.php" ;
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idEvenement'])) {
		if (isset($evenements[$_REQUEST['idEvenement']])) {
			// On a re�u idPersonne en POST OU GET, on a une personne avec cet id
			$result["evenement"] = $evenements[$_REQUEST['idEvenement']];
		} else {
			$result["status"] = "error" ;
			$result["errMessage"] = "evenement {$_REQUEST['idEvenement']} inconnue" ;
		}
	} else {
		$result["status"] = "error" ;
		$result["errMessage"] = "Param�tre idPersonne manquant" ;
	}

		echo json_encode($result) ;
?>
