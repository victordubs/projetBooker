<?php
$param=array("nom","prenom","adresse","ville","mail","tel","siteWeb");
foreach($param as $value){
  if(!isset($_REQUEST[$value])){
  	$_REQUEST[$value]=null;
  }
}


 ?>
