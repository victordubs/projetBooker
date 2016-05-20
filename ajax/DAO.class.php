<?php
    require_once('Artiste.class.php');
    require_once('AutresContacts.class.php');
    require_once('Evenement.class.php');
    // Definition de l'unique objet de DAO
    $dao = new DAO();

    // Le Data Access Object
    // Il représente la base de donnée
    class DAO {
        // L'objet local PDO de la base de donnée
        private $db;
        // Le type, le chemin et le nom de la base de donnée
        private $database = 'sqlite:projetBooker/data/booker.db';
      
        // Constructeur chargé d'ouvrir la BD
        function __construct() {
			       try {
				           $this->db = new PDO($this->database);
			       }
			      catch (PDOException $e){
				          die("erreur de connexion:   " .$e->getMessage());
			      }

        }


        function getArtiste($id) {
            $req = "select * from artiste where id = $id;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');
            return $result;
          }

          function getArtistev2($id) {
              $req = "select g.nom, a.nom, a.prenom, a.mail, a.tel, a.siteWeb, a.id, a.ville, a.adresse
                      from artiste a, liaisonArtisteGroupe l, groupe g
                      where a.id = $id and a.id = idArtiste  and idGroupe = g.id;";
              $sth = $this->db->query($req);
              $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');
              return $result;
            }

        function getContact($id) { //attention renvoie les autres contacts
            $req = "select * from autresContact where id = $id ;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'AutresContacts');
            return $result;
        }

        function getEvenement($id) {
            $req = "select * from evenement where id = $id;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Evenement');
            return $result;
        }

        function getListeArtistes() {
            $req = "select * from artiste;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');
            return $result;
        }

        function getListeEvenements() {
            $req = "select * from evenement;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Evenement');
            return $result;
        }




      }
?>
