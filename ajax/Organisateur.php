 <?php
	require_once('Personne.php');
	require_once('Evenement.php');
    class Organisateur extends Personne {
        public $nombresPlaces;   // int. Le nombre de place dont l'organisateur dispose
        public $lesEvenements;  // tableau. liste des évènements à venir de l'organisateur. 
    }


?>
