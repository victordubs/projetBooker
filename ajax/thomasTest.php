<?php
	include_once("DAO.class.php");
$result = array() ;
$result["status"] = "success" ;
$result["contact"]=array();
$_REQUEST['idp']="3";
if (isset($_REQUEST['idp'])) {
  $reponse=$dao->getContact($_REQUEST['idp']);
  if (isset($reponse)) {

    $contact = array() ;
    $contact['nom'] = $reponse->nom;
    $contact['prenom'] = $reponse->prenom;
    $contact['ville'] = $reponse->ville;
    $contact['adresse'] = $reponse->adresse;
    $contact['tel'] = $reponse->tel;
    $contact['mail'] = $reponse->mail;
    $contact['siteWeb'] = $reponse->siteweb;
    $contact['idp'] = $reponse->id;
    $result["contact"]=$contact;

  } else {
    $result["status"] = "error" ;
    //$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
  }
} else {
  $result["status"] = "error" ;
  $result["errMessage"] = "Param�tre idPersonne manquant" ;
}

var_dump($result["contact"]);
?>
