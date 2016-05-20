 <?php
	require_once('Personne.php');
	require_once('Evenement.php');
    class Application {
        public $nomUtilisateur;   // string. nom de l'utilisateur
        public $prenomUtilisateur;  // string. prenom de l'utilisateur
	public $mailUtilisateur; //string. mail de l'utilisateur
        public $adresseUtilisateur;   // string. adresse de l'utilisateur
        public $telUtilisateur;  // string. telephone de l'utilisateur
	public $identifiant; //string. identifiant de l'utilisateur
        public $motDePasse;   // string. mot de passe de l'utilisateur
        public $numeroEnregistrement;  // int. id de l'utilisateur
	public $personnes; //tableau. les différents contacts de l'utilisateur.
	public $evenements; //tableau. les différents évènement lié à l'utilisateur
    }


?>
