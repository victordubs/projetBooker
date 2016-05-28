<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['dateDeb'])) {
		$reponse=$dao->getGroupeDispoAtDate($_REQUEST['dateDeb']);
		if (isset($reponse)) {
			$result["groupesDispo"]= array() ;
			$result["groupesDispo"]=$reponse;

		} else {
			$result["status"] = "error"  ;
			$result["errMessage"] = "réponse vide "+$_REQUEST['dateDeb'] ;
		}
}else {
	$result["status"] = "error" ;
	//$rep=$_REQUEST['dateDeb'];
	$result["errMessage"] ="non set";
}
		echo json_encode($result) ;
?>
