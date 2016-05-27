<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
$result = array() ;
$result["status"] = "success" ;

$_REQUEST['mail']="testIU@u.com";
$_REQUEST['tel']="0111111111";
$_REQUEST['siteWeb']="www.testChangement33.com";
//$_REQUEST['idp']="3";
$_REQUEST['ville']="testVille";
$_REQUEST['adresse']="testAdresse";
$_REQUEST['nom']="Organisat";
$_REQUEST['prenom']="MiJeanChel";
$_REQUEST['type']="publicite";
$_REQUEST['genres']="ROCK";
$_REQUEST['listeArtiste']=3;
$_REQUEST['listeContact']=2;

//if (isset($_REQUEST['idArtiste'])) {

    include_once("saveGroupe.php");

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
