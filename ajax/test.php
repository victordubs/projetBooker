<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
include_once("getArtiste.php");
$result = array() ;
$result["status"] = "success" ;
$_REQUEST['idArtiste']=1;

//if (isset($_REQUEST['idArtiste'])) {

    //$reponse=getArtiste($_REQUEST['idArtiste']);
	//var_dump($reponse);
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


	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;



			$reponse=$dao->getArtiste($_REQUEST['idArtiste']);
		if (isset($reponse)) {

			$artiste = array() ;
			$artiste['nom'] = $reponse->nom;
			$artiste['prenom'] = $reponse->prenom;
			$artiste['ville'] = $reponse->ville;
			$artiste['adresse'] = $reponse->adresse;
			$artiste['tel'] = $reponse->tel;
			$artiste['mail'] = $reponse->mail;
			$artiste['siteWeb'] = $reponse->siteweb;
			$artiste['id'] = $reponse->id;
			$artiste['roles'] = $reponse->role;
			$artiste['groupes'] = $reponse->groupes;
			$result["artiste"]=$artiste;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}
	
		//echo json_encode($result) ;
		var_dump($result["artiste"]);

  ?>
