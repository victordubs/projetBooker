<?php
$param=array("nom","dateDebut","dateFin","adresse","heureDebut","heureFin");
foreach($param as $value){
  if(!isset($_REQUEST[$value])){
  	$_REQUEST[$value]=null;
  }
}


 ?>
