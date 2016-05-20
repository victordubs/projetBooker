<?php
session_start();
  include_once("DAO.class.php");

	$result = array() ;
	$result["status"] = "success" ;


  if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {

	} else {
		$result["status"] = "error" ;
	}

		echo json_encode($result) ;
  ?>
