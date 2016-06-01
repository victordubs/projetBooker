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
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'AutresContact');

            $req ="select  G.nom,G.id
		   		  from  autrescontact A,groupes G,liaisongroupeautrescontact AG
		   		  where A.id=$id and AG.idautrescontact=A.id and AG.idgroupe=G.id;";
            $sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->groupes=$result1;

	    	$req ="select  nomtype
				   from liaisonautrescontacttype
				   where idautrescontact=$id;";
            $sth = $this->db->query($req);
            $result2 = $sth->fetchAll(PDO::FETCH_COLUMN);
            $result[0]->type=$result2;

            return $result[0];
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
            if($personne!=='AutresContact'){
              $personne=substr($personne,0,-1);
            }

            $result = $sth->fetchAll(PDO::FETCH_CLASS,$personne);
            return $result;
        }


        function getListeEvenements() {
            $req = "select nom, datedebut, id from evenement;";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
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
	   		$sth = $this->db->query($req);
            $result3 = $sth->fetchAll(PDO::FETCH_COLUMN);
            $result[0]->styles=$result3;

            $req ="select  e.id, e.nom, e.datedebut
		    from  evenement e,groupes g, plagehoraire ph
		    where g.id=$id and ph.idgroupe=g.id and ph.idevenement=e.id;";
	    	$sth = $this->db->query($req);
            $result3 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->evenements=$result3;



            return $result[0];
          }

      function recherchePersonnes($nompersonne) {
              $req = "select id,nom,tel from artistes where nom='$nompersonne'
                      union
                      select id,nom,tel from groupes where nom='$nompersonne'
                      union
                      select id,nom,tel from organisateurs where nom='$nompersonne'
                      union
                      select id,nom,tel from autresContact where nom='$nompersonne';";

              $sth = $this->db->query($req);
              $result = $sth->fetchAll(PDO::FETCH_ASSOC);
              return $result;
      }

		function getGroupeDispoAtDate($date) {

			$req = "select nom, id
					from groupes
					where id
					not in (select idgroupe
							from plagehoraire ph, evenement e
							where idevenement = id and datedebut = '$date');";

			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
		}



		function getMaxIdPlus1Artiste() {
			$req="select MAX(id) from artistes;";
			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($result[0]['max']);
			return (intval($result[0]['max'])+1);
		}

		function getMaxIdPlus1AutresContact() {
			$req="select MAX(id) from autresContact;";
			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($result[0]['max']);
			return (intval($result[0]['max'])+1);
		}

		function getMaxIdPlus1Organisateur() {
			$req="select MAX(id) from organisateurs;";
			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($result[0]['max']);
			return (intval($result[0]['max'])+1);
		}

		function getMaxIdPlus1Groupe() {
			$req="select MAX(id) from groupes;";
			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($result[0]['max']);
			return (intval($result[0]['max'])+1);
		}
		
		function getMaxIdPlus1Evenement() {
			$req="select MAX(id) from evenement;";
			$sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
			var_dump($result[0]['max']);
			return (intval($result[0]['max'])+1);
		}


		function insertArtiste($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$role,$groupes) {
			$req ="insert into artistes values ('$mail','$tel','$siteWeb',$id,'$ville','$adresse','$nom','$prenom');";	
			
			$nbLignes=$this->db->exec($req);
			var_dump($nbLignes);

			$req ="insert into liaisonartisterole values ($id,'$role');";
			$nbLignes2=$this->db->exec($req);
			var_dump($nbLignes2);
			
			foreach($role as $value) {
				$req ="insert into liaisonartisterole values ($id,'$value');";
				$this->db->exec($req);
			}
	
		}

		function updateArtiste($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$role,$groupes) {
			$req ="update artistes set mail = '$mail' where id=$id;";
			$this->db->exec($req);	
			$req ="update artistes set tel = '$tel'where id=$id;";
			$this->db->exec($req);
			$req ="update artistes set siteWeb = '$siteWeb'where id=$id;";
			$this->db->exec($req);
			$req ="update artistes set ville = '$ville'where id=$id;";
			$this->db->exec($req);
			$req ="update artistes set adresse = '$adresse'where id=$id;";
			$this->db->exec($req);
			$req ="update artistes set nom = '$nom'where id=$id;";
			$this->db->exec($req);
			$req ="update artistes set prenom = '$prenom'where id=$id;";
			$this->db->exec($req);
			foreach($role as $value) {
				$req="update liaisonartisterole set nomRole='$value' where idArtiste=$id;";
				$this->db->exec($req);
			}
			
			
		
		}

		function insertAutresContact($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$metier,$type) {
			$req ="insert into autresContact values ('$mail','$tel','$siteWeb',$id,'$ville','$adresse','$nom','$prenom','$metier');";	
			$nbLignes=$this->db->exec($req);
			var_dump($req);

			$req="insert into liaisonautrescontacttype values($id,'$type');";
			
	
		}

		function updateAutresContact($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$metier,$type) {
			$req ="update autresContact set mail = '$mail' where id=$id;";
			$this->db->exec($req);	
			$req ="update autresContact set tel = '$tel' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set siteWeb = '$siteWeb' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set ville = '$ville' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set adresse = '$adresse' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set nom = '$nom' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set prenom = '$prenom' where id=$id;";
			$this->db->exec($req);
			$req ="update autresContact set prenom = '$metier' where id=$id;";
			$this->db->exec($req);
			
			$req="update liaisonautrescontacttype set nomtype='$type' where id=$id;";
			$this->db->exec($req);
		
		}

		function insertOrganisateur($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$nbPlaces) {
			$req ="insert into organisateurs values ('$mail','$tel','$siteWeb',$id,'$ville','$adresse','$nom','$prenom',$nbPlaces);";	
			$nbLignes=$this->db->exec($req);
			var_dump($req);
			var_dump($nbLignes);
		}

		function updateOrganisateur($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$prenom,$nbPlaces) {
			$req ="update organisateurs set mail = '$mail' where id=$id;";
			$this->db->exec($req);	
			$req ="update organisateurs set tel = '$tel' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set siteWeb = '$siteWeb' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set ville = '$ville' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set adresse = '$adresse' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set nom = '$nom' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set prenom = '$prenom' where id=$id;";
			$this->db->exec($req);
			$req ="update organisateurs set nombreplaces = $nbPlaces where id=$id;";
			$this->db->exec($req);
		}

		function insertGroupe($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$genres,$artistes,$contacts) {
			$req ="insert into groupes values ('$mail','$tel','$siteWeb',$id,'$ville','$adresse','$nom');";	
			$nbLignes=$this->db->exec($req);
			var_dump($req);
			var_dump($nbLignes);

			foreach($genres as $value) {
				$req ="insert into liaisongroupestyle values ($id,'$value');";
				$this->db->exec($req);
			}
			foreach($artistes as $value) {
				$req ="insert into liaisonartistegroupe values ($id,$value);";
				$this->db->exec($req);
			}
			foreach($contacts as $value) {
				$req ="insert into liaisongroupeautrescontact values ($id,$value);";
				$this->db->exec($req);
			}
		}

		function updateGroupe($mail,$tel,$siteWeb,$id,$ville,$adresse,$nom,$genres,$artistes,$contacts) {
			$req ="update groupes set mail = '$mail' where id=$id;";
			$this->db->exec($req);	
			$req ="update groupes set tel = '$tel' where id=$id;";
			$this->db->exec($req);
			$req ="update groupes set siteWeb = '$siteWeb' where id=$id;";
			$this->db->exec($req);
			$req ="update groupes set ville = '$ville' where id=$id;";
			$this->db->exec($req);
			$req ="update groupes set adresse = '$adresse' where id=$id;";
			$this->db->exec($req);
			$req ="update groupes set nom = '$nom' where id=$id;";
			$this->db->exec($req);

			foreach($genres as $value) {
				$req ="update liaisongroupestyle set style = '$value' where idgroupe=$id;";
				$this->db->exec($req);
			}
			foreach($artistes as $value) {
				$req ="update liaisonartistegroupe set idArtiste=$value where idgroupe=$id;";
				$this->db->exec($req);
			}
			foreach($contacts as $value) {
				$req ="update liaisongroupeautrescontact set idautrescontact=$value where idgroupe=$id;";
				$this->db->exec($req);
			}
		}

		function insertEvenement($id,$nom,$datedebut,$datefin,$libelle,$heuredebut,$heurefin,$plages,$organisateurs) {
			$req ="insert into evenement values ($id,'$nom','$datedebut',$datefin,'$libelle','$heuredebut','$heurefin');";	
			$nbLignes=$this->db->exec($req);
			var_dump($req);
			var_dump($nbLignes);

			foreach($organisateurs as $value) {
				$req ="insert into liaisonevenementorganisateur values ($id,$value);";
				$this->db->exec($req);
			}
			foreach($plages as $key=>$value) {
				$req ="insert into plagehoraire values ($value,NULL,$id,$key);";
				$this->db->exec($req);
			}

		}

		function updateEvenement($id,$nom,$datedebut,$datefin,$libelle,$heuredebut,$heurefin,$plages,$organisateurs) {
			$req ="update evenement set nom = '$nom' where id=$id;";
			$this->db->exec($req);	
			$req ="update evenement set datedebut = '$datedebut' where id=$id;";
			$this->db->exec($req);
			$req ="update evenement set datefin = '$datefin' where id=$id;";
			$this->db->exec($req);
			$req ="update evenement set libelle = '$libelle' where id=$id;";
			$this->db->exec($req);
			$req ="update evenement set heuredebut = '$heuredebut' where id=$id;";
			$this->db->exec($req);
			$req ="update evenement set heurefin = '$heurefin' where id=$id;";
			$this->db->exec($req);

			foreach($organisateurs as $value) {
				$req ="update liaisonevenementorganisateur set idorganisateur = $value where idevenement=$id;";
				$this->db->exec($req);
			}
			foreach($plages as $key=>$value) {
				$req ="update plagehoraire set idGroupe=$key where idEvenement=$id;";
				$this->db->exec($req);

				$req ="update plagehoraire set heureDebut=$value where idEvenement=$id;";
				$this->db->exec($req);

			}
		}

		function supprimerOrganisateur($id) {
			$req ="delete from organisateurs where id=$id;";
			$this->db->exec($req);
			$req ="delete from liaisonevenementorganisateur where idorganisateur=$id;";
			$this->db->exec($req);
		}

        function getEvenement($id) {
            $req = "select *
		    from evenement
		    where id=$id; ";
            $sth = $this->db->query($req);
            $result = $sth->fetchAll(PDO::FETCH_CLASS, 'Evenement');

            $req ="select  o.nom,o.id
		   from  liaisonevenementorganisateur eo, organisateurs o
		   where idevenement = $id and idorganisateur=o.id;";

	    	$sth = $this->db->query($req);
            $result1 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->organisateurs=$result1;

            $req ="select  heuredebut, heurefin, idgroupe, g.nom
		   from  plagehoraire ph, groupes g
		   where idevenement=$id and idgroupe=g.id ;";
	    	$sth = $this->db->query($req);
            $result2 = $sth->fetchAll(PDO::FETCH_ASSOC);
            $result[0]->plages=$result2;


            return $result[0];
          }

	function getListeRole() {
		$req = "select * from role;";
        $sth = $this->db->query($req);
        $result = $sth->fetchAll(PDO::FETCH_COLUMN);

		return $result;
	}

	function getListeStyle() {
		$req = "select * from style;";
        $sth = $this->db->query($req);
        $result = $sth->fetchAll(PDO::FETCH_COLUMN);

		return $result;
	}

	function getListeType() {
		$req = "select * from type;";
        $sth = $this->db->query($req);
        $result = $sth->fetchAll(PDO::FETCH_COLUMN);

		return $result;
	}


  }
?>
