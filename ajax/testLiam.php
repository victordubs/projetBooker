<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
$result = array() ;
$result["status"] = "success" ;
/*
$_REQUEST['mail']="testIU@u.com";
$_REQUEST['tel']="0111111111";
$_REQUEST['siteWeb']="www.testChangement66.com";
$_REQUEST['idp']="3";
$_REQUEST['ville']="testVille";
$_REQUEST['adresse']="testAdresse";
$_REQUEST['nom']="Organisat";
$_REQUEST['prenom']="MiJeanChel";
$_REQUEST['type']="publicite";
$_REQUEST['genres']=array("ROck","classique");
$_REQUEST['listeArtiste']=3;
$_REQUEST['listeContact']=2;
$_REQUEST['nbPlaces']=200;
*/

$_REQUEST['nom']="abb";
$_REQUEST['dateDebut']='2016-06-30';
$_REQUEST['dateFin']='2016-06-30';
$_REQUEST['heureDebut']='10:00';
$_REQUEST['heureFin']='16:00';
$_REQUEST['plages']='{"1":"12:00"}';
$_REQUEST['organisateurs']='[2,7]';
$_REQUEST['adresse']="2 rue de la Paix";



//if (isset($_REQUEST['idArtiste'])) {

include_once("DAO.class.php");
$result = array() ;
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

  /*if (isset($reponse)) {

    $artiste = array() ;
    $artiste['nom'] = $reponse->nom;
    $artiste['prenom'] = $reponse->prenom;
    $artiste['ville'] = $reponse->ville;
    $artiste['adresse'] = $reponse->adresse;
    $artiste['tel'] = $reponse->tel;
    $artiste['mail'] = $reponse->mail;
    $artiste['idArtiste'] = $reponse->id ;
    $result["artiste"]=$artiste;

  } else {
    $result["status"] = "error" ;
    $result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
  }
} else {
  $result["status"] = "error" ;
  $result["errMessage"] = "Param�tre idPersonne manquant" ;
}
var_dump(artiste);*/
  ?>
