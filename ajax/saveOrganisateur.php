<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	// Normalement, ici : insertion ou mise � jour de la base
	include_once("verifierInitialiser.php");
	if(!isset($_REQUEST["nbPlaces"])){$_REQUEST["nbPlaces"]=0;}
	if (!isset($_REQUEST['idp'])) {

		$id = $dao->getMaxIdPlus1Organisateur();
		$dao->insertOrganisateur($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$id,$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['nbPlaces']);
		$result["idp"] =$id;
	}

	else {
		$dao->updateOrganisateur($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['nbPlaces']);
		$result["idp"] =$_REQUEST['idp'];
	}

	echo json_encode($result);

?>
