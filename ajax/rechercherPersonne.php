<?php
include_once("DAO.class.php");

$result = array() ;
$result["status"] = "success" ;

if (isset($_REQUEST['nomPersonne'])) {
	$result["personnes"] = array();
	$listePersonnes=$dao->recherchePersonnes($_REQUEST['nomPersonne']);
 if(!empty($listePersonnes)){

	  foreach ($listePersonnes as $pers) {
					$personne = array() ;
					$personne['nom'] = $pers['nom'];
					$personne['idp'] = $pers['id'];
					array_push($result["personnes"], $personne) ;
    }
  }else{
   $result["msg"] = "non Trouvé" ;
 }
}else{
	$result["status"] = "error" ;
}

	echo json_encode($result);

?>
