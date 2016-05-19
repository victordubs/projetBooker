 <?php
	require_once('Personne.php');
	require_once('Groupe.php');
    class AutresContacts extends Personne {
        public $metier;   // string. metier du contact
        public $type;  // classe énumerer 'type'. type de contact
	public $groupes; //tableau. les différents groupe dont le contact fait partie.
    }


?>
