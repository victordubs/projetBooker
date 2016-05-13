 <?php
	require_once('Contact.php');
	require_once('AutresContacts.php');
	require_once('Artiste.php');
    class Groupe extends Contact {
        public $nomGroupe;   // string. Le nom du groupe
        public $disponibilite;  // tableau. Disponibilités des artistes
        public $genre; // type enumerer ? tableau ? .genre du groupe,
		public $autresContacts; //tableau. Les autres contacts du groupe
		public $artistes; //tableau. Les différents artistes d'un groupe    
    }


?>
