<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->getGroupeDispoAtDate($_REQUEST['idp']);
		if (isset($reponse)) {
			$result["groupesDispo"]= array() ;
			for($i=0;$i<count($reponse);$i++){
				$groupesDispo = array() ;
				$groupesDispo['nom'] = $reponse[$i]['nom'];
				$groupesDispo['idp'] = $reponse[$i]['id'];
				$result["groupesDispo"][$i]=$groupesDispo;
			}

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

		echo json_encode($result) ;
?>
