<?php
	include_once("DAO.class.php");
	$result = array() ;
	$result["status"] = "success" ;


  $types = json_decode($_REQUEST["types"],true);
	$newTypes = json_decode($_REQUEST["newTypes"],true);
	$result["types"]=$types;
	$result["newTypes"]=$newTypes;
	// Normalement, ici : insertion ou mise � jour de la base
	//$metier = "Ingenieur";

	if (!isset($_REQUEST['idp'])) {
		var_dump("Dans le INSERT");
		$result = $dao->getMaxIdPlus1AutresContact();
		$_REQUEST['idp']=$result;
		$dao->insertAutresContact($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['metier'],$_REQUEST['type']);
	}

	else {
		$dao->updateAutresContact($_REQUEST['mail'],$_REQUEST['tel'],$_REQUEST['siteWeb'],$_REQUEST['idp'],$_REQUEST['ville'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['metier'],$_REQUEST['type']);
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
