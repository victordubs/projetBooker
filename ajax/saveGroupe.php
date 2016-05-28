<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	$types = json_decode($_REQUEST["artistes"],true);
//	$newTypes = json_decode($_REQUEST["newTypes"],true);
	$result["artistes"]=$types["1"];
	//$result["newTypes"]=$newTypes;
	// Normalement, ici : insertion ou mise � jour de la base
/*
	if (!isset($_REQUEST['idp'])) {
		var_dump("Dans le INSERT");
		$result = $dao->getMaxIdPlus1Groupe();
		$_REQUEST['idp']=$result;
		$dao->insertGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['genres'],$_REQUEST['listeArtiste'],$_REQUEST['listeContact']);
	}

	else {
		$dao->updateGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['genres'],$_REQUEST['listeArtiste'],$_REQUEST['listeContact']);
	}*/





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
