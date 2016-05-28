<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;
$_REQUEST['dateDeb']="2016-04-05";

	if (isset($_REQUEST['dateDeb'])) {
		$reponse=$dao->getGroupeDispoAtDate($_REQUEST['dateDeb']);
		if (isset($reponse)) {
			$result["groupesDispo"]= array() ;
			$result["groupesDispo"]=$reponse;

		} else {
			$result["status"] = "error"  ;
			$result["errMessage"] = "réponse vide" ;
		}
}else {
	$result["status"] = "error" ;
	//$rep=$_REQUEST['dateDeb'];
	$result["errMessage"] ="non set";
}
		var_dump($result["groupesDispo"]);

?>
