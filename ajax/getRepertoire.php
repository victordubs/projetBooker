<?php
include_once("DAO.class.php");

$result = array() ;
$result["status"] = "success" ;


if (isset($_REQUEST['personne'])) {
	$result["personnes"] = array();
	$listePersonnes=$dao->getListePersonnes($_REQUEST['personne']);

	foreach ($listePersonnes as $pers) {
					$personne = array() ;
					$personne['nom'] = $pers->nom;
					$personne['idp'] = $pers->id ;

					array_push($result["personnes"], $personne) ;
	 }
}else{
	$result["status"] = "error" ;
}
	echo json_encode($result);
  ?>
