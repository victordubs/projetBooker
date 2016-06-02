<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	// Normalement, ici : insertion ou mise � jour de la base
	include_once("verifierInitialiser.php");
	if(!empty($_REQUEST["roles"])){$roles = json_decode($_REQUEST["roles"],true);}
	else{$roles=null;}

	if (!isset($_REQUEST['idp'])) {

		$id = $dao->getMaxIdPlus1Artiste();
		$dao->insertArtiste($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$id,$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$roles);
		$result["idp"] =$id;
	}

	else {
		$dao->updateArtiste($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$roles);
			$result["idp"] =$_REQUEST['idp'];
			$result["r"]=$roles;
	}

	echo json_encode($result);

?>
