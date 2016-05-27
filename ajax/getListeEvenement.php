<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


		$reponse=$dao->getListeEvenements();
		if (isset($reponse)) {
			$result["evenements"]= array() ;
			for($i=0;$i<count($reponse);$i++){
				$evenements = array() ;
				$evenements['nom'] = $reponse[$i]['nom'];
				$evenements['idp'] = $reponse[$i]['id'];
				$evenements['datedebut'] = $reponse[$i]['datedebut'];
				$result["evenements"][$i]=$evenements;
			}

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}
		echo json_encode($result) ;
?>
