<?php
	// Imite l'existence d'une base de donn�es
	$evenements = array() ;

	$evenement = array() ;
	$evenement ["idEvenement"] = "E1" ;
	$evenement ["nomEvenement"] = "GrosseTeuf" ;
	$evenement ["dateDeb"] = "25/04/2014" ;
	$evenement ["dateFin"] = "28/04/2014" ;
	$evenement ["lieu"] = "Grenoble" ;
	$evenements [$evenement ["idEvenement"]] = $evenement;

  $evenement = array() ;
	$evenement ["idEvenement"] = "E2" ;
	$evenement ["nomEvenement"] = "petitTeuf" ;
	$evenement ["dateDeb"] = "01/05/2014" ;
	$evenement ["dateFin"] = "28/06/2015" ;
	$evenement ["lieu"] = "Planfoy" ;
	$evenements [$evenement["idEvenement"]] = $evenement;



?>
