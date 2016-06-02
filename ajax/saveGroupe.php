<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;

	$artistes = json_decode($_REQUEST["artistes"],true);
	$newGenres = json_decode($_REQUEST["newGenres"],true);
	$contacts = json_decode($_REQUEST["autresContact"],true);
	// Normalement, ici : insertion ou mise � jour de la base

	if (!isset($_REQUEST['idp'])) {
		var_dump("Dans le INSERT");
		$id = $dao->getMaxIdPlus1Groupe();
		$_REQUEST['idp']=$id;
		$dao->insertGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$newGenres,$artistes,$contacts);
	}

	else {
		$dao->updateGroupe($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$newGenres,$artistes,$contacts);
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
