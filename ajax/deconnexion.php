<?php
session_start();
//include_once("../ajax/DAO.class.php");

$result = array() ;
$result["status"] = "success" ;

  // Si la session contenu un array de tableau n'est pas créer on l'initialise.
 if (isset($_SESSION['user'])){
    session_destroy();
    $result["reponse"]="true";
    if (isset($_SESSION['user'])){
       $result["reponse"]="false";
     }
  }
  
echo json_encode($result);

?>
