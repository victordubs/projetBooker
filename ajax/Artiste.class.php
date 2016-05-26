 <?php
	require_once('Personne.class.php');
    class Artiste extends Personne {
        public $role;    // tableau. Les différents rôles de l'artiste dans son groupe
	public $groupes; //tableau. Les différents groupes dont l'artiste fait partie
    }


?>
