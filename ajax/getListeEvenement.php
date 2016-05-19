<?php
	include "evenements.php" ;

	$result = array() ;
	$result["status"] = "success" ;
  if (count($evenements) > 0) {
		$result["evenements"] = array();

		foreach ($evenements as $idEvenement => $evenementBD) {
			$evenement = array() ;
			$evenement['idEvenement'] = $idEvenement;
			$evenement['nomEvenement'] = $evenementBD["nomEvenement"];
      $evenement['dateDeb'] = $evenementBD["dateDeb"];
      $evenement['ville'] = $evenementBD["ville"];
			array_push($result["evenements"], $evenement) ;
		}
	}
	echo json_encode($result);
  ?>
