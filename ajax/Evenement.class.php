 <?php
    class Evenement {
        public $nom;   // string. Le nom de l'�v�nement
        public $datedebut;  // GregorianCalendar. date du d�but de l'�v�nement
        public $datefin; // GregorianCalendar. date de fin de l'�v�nement
        public $libelle;   // string. description de l'�vv�nement
        public $heuredebut;  // GregorianCalendar. heure de d�but de l'�v�nement
        public $heurefin; //GregorianCalendar. heure de fin de l'�v�nement
	       public $organisateurs; //tableau. Listes des diff�rents organisateurs de l'�v�nement
	        //public $application; //application. Utilisateur auquel est li� cet �v�nement.
	         public $plages; // tableau. Contient les diff�rentes plages horaires de l'�v�nement. Permet d'obtenir la liste des artiste li� a l'�v�nement
    }
?>
