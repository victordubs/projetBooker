<?php
include_once("DAO.class.php");

$_REQUEST['mail']="testIU@u.com";
$_REQUEST['tel']="0111111111";
$_REQUEST['siteWeb']="www.testChangement33.com";
$_REQUEST['idp']="3";
$_REQUEST['ville']="testVille";
//$_REQUEST['adresse']="testAdresse";
$_REQUEST['nom']="super Groupe";
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

$param=array("nom","adresse","ville","mail","tel","siteWeb");
foreach($param as $value){
	if(!isset($_REQUEST[$value])){
		$_REQUEST[$value]=null;
	}
}

include_once("verifierInitialiser.php");
if(!empty($_REQUEST["artistes"])){$artistes = json_decode($_REQUEST["artistes"],true);}
else{$artistes=null;}


if(!empty($_REQUEST["newGenres"])){$newGenres = json_decode($_REQUEST["newGenres"],true);}
else{$newGenres=null;}

if(!empty($_REQUEST["autresContact"])){$contacts = json_decode($_REQUEST["autresContact"],true);}
else{$contacts=null;}

if (!isset($_REQUEST['idp'])) {

	$id = $dao->getMaxIdPlus1Groupe();
	$dao->insertGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$id,$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$newGenres,$artistes,$contacts);
}

else {
	$dao->updateGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$newGenres,$artistes,$contacts);
}



?>
