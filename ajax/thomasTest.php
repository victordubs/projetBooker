<?php
include_once("DAO.class.php");
$result = array() ;
$result["status"] = "success" ;
$result["artiste"]=array();
$_REQUEST['idp']="3";

if (isset($_REQUEST['idp'])) {
  $reponse=$dao->getArtiste($_REQUEST['idp']);
  if (isset($reponse)) {

    $artiste = array() ;
    $artiste['nom'] = $reponse->nom;
    $artiste['prenom'] = $reponse->prenom;
    $artiste['ville'] = $reponse->ville;
    $artiste['adresse'] = $reponse->adresse;
    $artiste['tel'] = $reponse->tel;
    $artiste['mail'] = $reponse->mail;
    $artiste['siteWeb'] = $reponse->siteweb;
    $artiste['idp'] = $reponse->id;
    $artiste['roles'] = $reponse->role;
    $artiste['groupes'] = $reponse->groupes;
    $result["artiste"]=$artiste;

  } else {
    $result["status"] = "error" ;
    //$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
  }
} else {
  $result["status"] = "error" ;
  $result["errMessage"] = "Param�tre idPersonne manquant" ;
}

var_dump($result["artiste"]);
?>
