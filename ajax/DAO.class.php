<?php
    // Definition de l'unique objet de DAO
    $dao = new DAO();
	//$cat = $dao->getAllCat();
	//var_dump($cat);

    // Le Data Access Object
    // Il représente la base de donnée
    class DAO {
        // L'objet local PDO de la base de donnée
        private $db;
        // Le type, le chemin et le nom de la base de donnée
        private $database = 'sqlite:../data/db/nourriture.db';

        // Constructeur chargé d'ouvrir la BD
        function __construct() {
			try {
				$this->db = new PDO($this->database);
			}
			catch (PDOException $e){
				die("erreur de connexion:   " .$e->getMessage());
			}

        }
    }
?>
