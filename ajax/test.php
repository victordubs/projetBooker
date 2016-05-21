<?php
  include_once("DAO.class.php");
$id="1";
$reponse=$dao->getArtiste($id);
var_dump($reponse);
  ?>
