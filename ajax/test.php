<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
include_once("getArtiste.php");
$result = array() ;
//$result["status"] = "success" ;
//$_REQUEST['idArtiste']=1;


$reponse = $dao->getOrganisateur(2);
var_dump($reponse);





/*$reponse = $dao->getArtiste(3);
var_dump($reponse);*/





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

/*
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
		var_dump($result["artiste"]);*/

/*
		$reponse=$dao->getContact(3);
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
			$artiste['types'] = $reponse->type;
			$artiste['groupes'] = $reponse->groupes;
			$result["artiste"]=$artiste;

		} else {
			$result["status"] = "error" ;
			//$result["errMessage"] = "Artiste {$_REQUEST['idArtiste']} inconnue" ;
		}

	var_dump($result);
	
*/
		
//echo json_encode($result) ;






  ?>
