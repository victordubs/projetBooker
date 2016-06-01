<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	// Normalement, ici : insertion ou mise � jour de la base

	$plages = json_decode($_REQUEST["groupes"],true);
	$organisateurs = json_decode($_REQUEST["groupes"],true);

	if (!isset($_REQUEST['idp'])) {
		var_dump("Dans le INSERT");
		$result = $dao->getMaxIdPlus1Evenement();
		$_REQUEST['idp']=$result;
		$dao->insertEvenement($_REQUEST['idp'],$_REQUEST['nom'],$_REQUEST['dateDeb'],$_REQUEST['DateFin'],$_REQUEST['adresse'],$_REQUEST['heureDebut'],$_REQUEST['heureFin'],$plages,$organisateurs);
	}

	else {
		$dao->updateEvenement($_REQUEST['idp'],$_REQUEST['nom'],$_REQUEST['dateDeb'],$_REQUEST['DateFin'],$_REQUEST['adresse'],$_REQUEST['heureDebut'],$_REQUEST['heureFin'],$plages,$organisateurs);
	}

	

	
	
	echo json_encode($result);
/*		try {
			$requete = "insert into Personne (nom, prenom) values (\"" . getNom() . "\", (\"{$_REQUEST["prenom"]}\"";
			$result['idPersonne'] = mysqlxxx.getlastInsertId();
		} catch($error) {
			$result['status'] = 'error' ;
			$result['errMsg'] = 'Erreur dans la requête $requete' ;
		}
	} else {
	// update
	}
	echo json_encode($result) ;

	fonction getNom() {
		return $_REQUEST["nom"];
	}*/
?>
