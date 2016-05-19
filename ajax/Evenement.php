 <?php
	require_once('Organisateur.php');
	require_once('Application');
    class Evenement {
        public $nom;   // string. Le nom de l'évènement
        public $dateDebut;  // GregorianCalendar. date du début de l'évènement
        public $dateFin; // GregorianCalendar. date de fin de l'évènement   
        public $libelle;   // string. description de l'évvènement
        public $heureDebut;  // GregorianCalendar. heure de début de l'évènement   
        public $heureFin; //GregorianCalendar. heure de fin de l'évènement
	public $organisateurs; //tableau. Listes des différents organisateurs de l'évènement 
	public $application; //application. Utilisateur auquel est lié cet évènement.
    }


?>
