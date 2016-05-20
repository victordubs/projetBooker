 <?php
	require('Personne.class.php');
    class Organisateur extends Personne {
        public $nombresPlaces;   // int. Le nombre de place dont l'organisateur dispose
        public $lesEvenements;  // tableau. liste des évènements à venir de l'organisateur.
    }


?>
