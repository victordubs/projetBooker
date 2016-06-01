<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	// Normalement, ici : insertion ou mise � jour de la base
	$roles = json_decode($_REQUEST["roles"],true);

	if (!isset($_REQUEST['idp'])) {
		//var_dump("Dans le INSERT");
		$result = $dao->getMaxIdPlus1Artiste();
		$_REQUEST['idp']=$result;
		$dao->insertArtiste($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$roles);
	//	$result["msg"] = "insert effectuer" ;
	}

	else {
		$dao->updateArtiste($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['roles']);
	//	$result["msg"] =$_REQUEST['idp'] ;
	}

	echo json_encode($result);

?>
