<?php
  include_once("DAO.class.php");
$id="1";
include_once("DAO.class.php");
include_once("getArtiste.php");
$result = array() ;
//$result["status"] = "success" ;
//$_REQUEST['idArtiste']=1;

$result = $dao->getArtiste(1);
var_dump($result);


  ?>
