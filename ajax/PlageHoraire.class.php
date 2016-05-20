<?php
	require_once('Groupe.php');
	require_once('Evenement.php');
    class PlageHoraire {
        public $heueDebut;   // gregorian calendar. heure de début de passage
        public $heureFin;  // gregorian calendar. heure de fin de passage
	public $groupe; // groupe auquel est associé la plage horaire
	public $evenement // evenement auquel est associé la plage horaire
    }
?>