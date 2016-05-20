<?php
  include_once("DAO.class.php");


  $result = array() ;
  $result["status"] = "success" ;
  $result["artistes"] = array();
  $listeArtistes=$dao->getListeArtistes();

  	foreach ($listeArtistes as $art) {
  		$artiste = array() ;
  		$artiste['nom'] = $art->nom;
  		$artiste['idp'] = $art->id ;

  		array_push($result["personnes"], $artiste) ;
  	}


var_dump($result["personnes"]);
  ?>
