<?php
    require_once('Artiste.class.php');
    require_once('AutresContacts.class.php');
    require_once('Evenement.class.php');
    require_once('Groupe.class.php');
    require_once('Organisateur.class.php');
    //require_once('Organisateur.class.php');

    // Definition de l'unique objet de DAO
    $dao = new DAO();

    // Le Data Access Object
    // Il représente la base de donnée
    class DAO {
        // L'objet local PDO de la base de donnée
        private $db;
        // Le type, le chemin et le nom de la base de donnée
        private $dbname="bases3da13";
        private $host="postgres-info";
        private $dbuser="users3da13";
        private $dbpass="Liam1996";

       //$dbh = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpass);
        // Constructeur chargé d'ouvrir la BD
        function __construct() {
			       try {

				           $this->db = new PDO("pgsql:dbname=$this->dbname;host=$this->host", $this->dbuser, $this->dbpass);
			       }
			      catch (PDOException $e){
				          die("erreur de connexion:   " .$e->getMessage());
			      }

        }


        function getArtiste($id) {
            $req = "select distinct a.nom, a.prenom, a.mail, a.tel, a.id, a.ville, a.adresse, a.siteweb from artistes A, liaisonartisterole L where L.idartiste=A.id and id=$id; ";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');

            $req ="select  G.nom,G.id from  artistes A,groupes G,liaisonartistegroupe AG where A.id=$id and AG.idartiste=A.id and AG.idgroupe=G.id;";
            $sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->groupes=$result1;

			$req ="select  R.nomRole from  artistes A,role R,liaisonartisterole Ar where A.id=$id and Ar.idartiste=A.id and Ar.nomrole = r.nomrole;";
            $sth = $this->db->query($req);
            $result2 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->role=$result2;

            return $result[0];
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
            $req = "select * from artistes order by nom;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');
            return $result;
        }

        function getListePersonnes($personne) {
            $req = "select * from $personne order by nom;";
            $sth = $this->db->query($req);
            // pour pouvoir acceder à la class "artiste" car avant $personnes vaut "artistes"
            $personne=substr($personne,0,-1);
            $result = $sth->fetchAll(PDO::FETCH_CLASS,'groupe');
            return $result;
        }


        function getListeEvenements() {
            $req = "select * from evenement;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Evenement');
            return $result;
        }

        function connexion($login,$password) {
            $req = "select * from login where username='$login' and password='$password';";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $result[0];
        }


  }
?>
