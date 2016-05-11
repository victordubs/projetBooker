<?php
	include "artistes.php" ;

	$result = array() ;
	$result["status"] = "success" ;
  if (count($artistes) > 0) {
		$result["artistes"] = array();

		foreach ($artistes as $idArtiste => $artisteBD) {
			$artiste = array() ;
			$artiste['idArtiste'] = $idArtiste ;
			$artiste['nomArtiste'] = $artisteBD["nom"];
			array_push($result["artistes"], $artiste) ;
		}
	}
	echo json_encode($result);
  ?>
