 <?php
	require_once('Contact.php');
	require_once('AutresContacts.php');
	require_once('Artiste.php');
	require_once('PlageHoraire.php');
    class Groupe extends Contact {
        public $nomGroupe;   // string. Le nom du groupe
        public $disponibilite;  // tableau. Disponibilit�s des artistes
        public $genre; // type enumerer ? tableau ? .genre du groupe,
	public $autresContacts; //tableau. Les autres contacts du groupe
	public $artistes; //tableau. Les diff�rents artistes d'un groupe    
	public $horaires; // tableau. Les diff�rentes plages horaire d'�v�venements auquel participe l'artiste, permet d'obtenir via les plages horaires les evenements du groupes
    }
?>