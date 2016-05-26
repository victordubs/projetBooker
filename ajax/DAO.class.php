<?php
    require_once('Artiste.class.php');
    require_once('AutresContact.class.php');
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
            $req = "select * from artistes  where id=$id; ";
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


        function getContact($id) { //attention renvoie les autres contacts
            $req = "select * from autresContact where id = $id ;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'AutresContacts');

            $req ="select  G.nom,G.id 
				   from  autrescontact A,groupes G,liaisongroupeautrescontact AG 
				   where A.id=$id and AG.idautrescontact=A.id and AG.idgroupe=G.id;";
            $sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->groupes=$result1;

			$req ="select  R.nomtype 
				   from  artistes A,type R,liaisonautrescontacttype Ar 
				   where A.id=$id and Ar.idautrescontact=A.id and Ar.nomtype = r.nomtype;";
            $sth = $this->db->query($req);
            $result2 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->type=$result2;

            return $result[0];
        }

        function getEvenement($id) {
            $req = "select * from evenement where id = $id;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Evenement');
            return $result;
        }

        function getListeArtistes() {
            $req = "select * from artiste order by nom;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Artiste');
            return $result;
        }

	function getListePersonnes($personne) {
            $req = "select * from $personne order by nom;";
            $sth = $this->db->query($req);
            // pour pouvoir acceder à la class "artiste" car avant $personnes vaut "artistes"

            if($personnes!='AutresContact'){
              $personne=substr($personne,0,-1);
            }

            $result = $sth->fetchAll(PDO::FETCH_CLASS,$personne);
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

        function getOrganisateur($id) {
            $req = "select *
		    from organisateurs 
		    where id=$id; ";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Organisateur');

            $req ="select  e.nom,e.id 
		   from  organisateurs o,evenement e,liaisonevenementorganisateur AG 
		   where o.id=$id and AG.idorganisateur=o.id and AG.idevenement=e.id;";
	    $sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->lesEvenements=$result1;



            return $result[0];
          }

        function getGroupe($id) {
            $req = "select *
		    from groupes
		    where id=$id; ";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Groupe');

            $req ="select  a.nom,a.id 
		   from  artistes a,groupes g,liaisonartistegroupe AG 
		   where g.id=$id and AG.idgroupe=g.id and AG.idartiste=a.id;";
	    	$sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->artistes=$result1;

            $req ="select  a.nom,a.id 
		   from  autrescontact a,groupes g,liaisongroupeautrescontact AG 
		   where g.id=$id and AG.idgroupe=g.id and AG.idautrescontact=a.id;";
	    	$sth = $this->db->query($req);
            $result2 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->autresContacts=$result2;

            $req ="select  s.nomstyle
		   from  style s,groupes g,liaisongroupestyle Ast
		   where g.id=$id and Ast.idgroupe=g.id and Ast.nomstyle=s.nomstyle;";
			var_dump($req);
	    	$sth = $this->db->query($req);
            $result3 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->styles=$result3;



            return $result[0];
          }


  }
?>
