<?php
include_once("DAO.class.php");

$_REQUEST['mail']="testIU@u.com";
$_REQUEST['tel']="0111111111";
$_REQUEST['siteWeb']="www.testChangement33.com";
$_REQUEST['idp']="3";
$_REQUEST['ville']="testVille";
//$_REQUEST['adresse']="testAdresse";
$_REQUEST['nom']="DUV";
$_REQUEST['prenom']="Lolo";
$_REQUEST['type']="publicite";
$_REQUEST['genres']="ROCK";
$_REQUEST['listeArtiste']=3;
$_REQUEST['listeContact']=2;

// Normalement, ici : insertion ou mise � jour de la base
//$roles = json_decode($_REQUEST["roles"],true);
//$roles=array("guitariste","batteur");

$result = array() ;
$result["status"] = "success" ;

// Normalement, ici : insertion ou mise � jour de la base
include_once("verifierInitialiser.php");
if(!isset($_REQUEST["nbPlaces"])){$_REQUEST["nbPlaces"]=null;}
if (!isset($_REQUEST['idp'])) {

	$id = $dao->getMaxIdPlus1Organisateur();
	$dao->insertOrganisateur($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$id,$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['nbPlaces']);
}

else {
	echo("id present");
	$result["status"]="error";
	$dao->updateOrganisateur($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['nbPlaces']);
	var_dump($_REQUEST["nbPlaces"]);
}


?>
