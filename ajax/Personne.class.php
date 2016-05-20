 <?php
	require_once('Contact.php');
	require_once('Application');
    class Personne extends Contact {
        public $nom;   // string. nom de la personne
        public $prenom;  // string. prenom de la personne
	public $application; // application. L'utilisateur auquel est lié ce contact
    }


?>
