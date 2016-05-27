<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


	if (isset($_REQUEST['dateDeb'])) {
		$reponse=$dao->getGroupeDispoAtDate($_REQUEST['dateDeb']);
		if (isset($reponse)) {
			$result["groupesDispo"]= array() ;
			for($i=0;$i<count($reponse);$i++){
				$groupesDispo = array() ;
				$groupesDispo['nom'] = $reponse[$i]['nom'];
				$groupesDispo['idp'] = $reponse[$i]['id'];
				$result["groupesDispo"][$i]=$groupesDispo;
			}

		} else {
			$result["status"] = "error"  ;
			$result["errMessage"] = "réponse vide" ;
		}
}else {
	$result["status"] = "error" ;
	//$rep=$_REQUEST['dateDeb'];
	$result["errMessage"] ="non set";
}
		echo json_encode($result) ;
?>
