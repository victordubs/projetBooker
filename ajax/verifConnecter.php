<?php
session_start();
  //include_once("../ajax/DAO.class.php");

	$result = array() ;
	$result["status"] = "success" ;

    // Si la session contenu un array de tableau n'est pas créer on l'initialise.
   if (isset($_SESSION['user'])){
      $result["reponse"]="true";
    }else{
      $result["reponse"]="false";
    }
      //$result["reponse"]="false";
	echo json_encode($result);
  ?>
