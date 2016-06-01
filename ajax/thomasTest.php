<?php
include_once("DAO.class.php");

$result = array() ;
$result["status"] = "success" ;

$_REQUEST['mail']="testIU@u.com";
$_REQUEST['tel']="0111111111";
$_REQUEST['siteWeb']="www.testChangement33.com";
//$_REQUEST['idp']="3";
$_REQUEST['ville']="testVille";
//$_REQUEST['adresse']="testAdresse";
$_REQUEST['nom']="Organisat";
$_REQUEST['prenom']="MiJeanChel";
$_REQUEST['type']="publicite";
$_REQUEST['genres']="ROCK";
$_REQUEST['listeArtiste']=3;
$_REQUEST['listeContact']=2;

// Normalement, ici : insertion ou mise � jour de la base
//$roles = json_decode($_REQUEST["roles"],true);
$roles=array("guitariste","batteur");
$groupes=1;
if (!isset($_REQUEST['idp'])) {
	//var_dump("Dans le INSERT");
	$result = $dao->getMaxIdPlus1Artiste();
	$_REQUEST['idp']=$result;
	$dao->insertArtiste($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$roles,$groupes);
	//$result["msg"] = "insert effectuer" ;
}
	//	var_dump($result["groupesDispo"]);

?>
