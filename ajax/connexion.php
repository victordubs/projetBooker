<?php
session_start();
  include_once("DAO.class.php");

	$result = array() ;
	$result["status"] = "success" ;

  if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {

    $reponse=$dao->connexion($_REQUEST['login'],$_REQUEST['password']);
    if(!empty($reponse)){
      $result["reponse"] = "true" ;
      $_SESSION['user']= $_REQUEST['login'];
    }else{
      $result["reponse"] = "false" ;
    }
	} else {
		$result["status"] = "error" ;
	}

		echo json_encode($result) ;
  ?>
