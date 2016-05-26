<?php
include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	if (isset($_REQUEST['idp'])) {
		$reponse=$dao->supprimerOrganisateur($_REQUEST['idp']);
    
  } else {
		$result["status"] = "error" ;
		$result["errMessage"] = "Erreur dans la rêquete au serveur" ;
	}

?>
