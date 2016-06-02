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

$result["status"] = "success" ;

// Normalement, ici : insertion ou mise � jour de la base
include_once("verifierInitialiserEvenement.php");
if(!empty($_REQUEST["plages"])){$plages = json_decode($_REQUEST["plages"],true);}
else {$plages=null;}
if(!empty($_REQUEST["organisateurs"])){$organisateurs = json_decode($_REQUEST["organisateurs"],true);}
else {$organisateurs=null;}

if (!isset($_REQUEST['idp'])) {
	var_dump("Dans le INSERT");
	$id = $dao->getMaxIdPlus1Evenement();
	$_REQUEST['idp']=$id;
	$dao->insertEvenement($_REQUEST['idp'],$_REQUEST['nom'],$_REQUEST['dateDebut'],$_REQUEST['dateFin'],$_REQUEST['adresse'],$_REQUEST['heureDebut'],$_REQUEST['heureFin'],$plages,$organisateurs);
}

else {
	$dao->updateEvenement($_REQUEST['idp'],$_REQUEST['nom'],$_REQUEST['dateDeb'],$_REQUEST['DateFin'],$_REQUEST['adresse'],$_REQUEST['heureDebut'],$_REQUEST['heureFin'],$plages,$organisateurs);
}


?>
