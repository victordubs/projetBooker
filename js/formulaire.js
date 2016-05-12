$(document).ready(function() {
	// Comportement des boutons de menus
	$('body nav #mnuAccueil').bind('click', function() { // Au clic sur le bouton "mnuAccueil" dans le menu
		activerOptionMenu($(this));
		$('#content').load('pages/accueil.html',afficherAccueil()); // On charge la page accueil.html dans la div content
	});

	$('body nav #mnuRepertoire').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
		activerOptionMenu($(this));
		// On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
		$('#content').load('pages/afficherRep.html',afficherRep());
	});

  $('body nav #mnuOption').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
    activerOptionMenu($(this));
    // On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
    $('#content').load('pages/formulaireContact.html');

  });

	$('body nav #mnuCalendrier').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
		activerOptionMenu($(this));
		// On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
		$('#content').load('pages/calendrier.html');

	});
  $('body nav #mnuAccueil').click();
});

// ---------------------------------------------------------------------------------------------------------------------------
// Active une option du menu (l'�l�ment � activer est pass� en param�tre)
function activerOptionMenu($element) {
	// D�sactive toutes les options du menu (met l'attribut 'actif' � faux)
	$('body nav input[type="button"]').attr('actif', false);
	// Active l'option choisie et re�ue en param�tre (met l'attribut 'actif' � vrai)
	$element.attr('actif', true);
}

//------------AFFICHER LE REPERTOIRE--------------------------------------------------------------------------------------------
function afficherRep(){
	var alphabet=["A","B","C","D","E","F","G","H","I","J"];


	$.ajax({	type: "POST", // envoie une requ�te � getListePersonnes pour demander la liste des personnes
				url: "ajax/getListeArtistes.php",
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {
					for (var id=0; id < result.artistes.length; id++) {
						for(var lettre=0; lettre <alphabet.length;lettre++){
								// On place le contact dans le bon div en fonction de sa première lettre.
								if(result.artistes[id].nomArtiste.substr(0,1)==alphabet[lettre]){

										$liContact = $(document.createElement('li')); // On cr�e un li
										$liContact.append('<p idArtiste="'+result.artistes[id].idArtiste+'">'+result.artistes[id].nomArtiste+'</p>');
										$liContact.append('<img id=\'email\' src = "images/emailBtn.svg" />');
										$liContact.append('<img id=\'sms\' src = "images/smsBtn.svg" />');
										$liContact.append('<a href="tel:+337388388"><img id=\'call\' src = "images/callBtn.svg" /></a>');
										$div='#result'+alphabet[lettre];
										$($div).append($liContact);
					  		}
						}
					}	evenementRep();}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
function afficherAccueil(){

	$.ajax({	type: "POST", // envoie une requ�te � getListeEvenement pour demander la liste des personnes
				url: "ajax/getListeEvenement.php",
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {

								for (var id=0; id < result.evenements.length; id++) {
										$articleAcc = $(document.createElement('article')); // On cr�e un article
										$articleAcc.attr('idEvent',result.evenements[id].idEvenement);
										$articleAcc.append('<h2>'+result.evenements[id].nomEvenement+'</h2>');
										$articleAcc.append('<p> Date :'+result.evenements[id].dateDeb+'<br/ >Lieu :'+result.evenements[id].lieu+'</p>');
										$('section').append($articleAcc);
							  }
							}evenementAccueil();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//-----------------------------------AFFICHER UN EVENEMENT------------------------------------------------
function afficherEvenement(idEvenement){

	$.ajax({	type: "POST",
				url: "ajax/getEvenement.php",
				data: "idEvenement=" + idEvenement,// On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {

						if (result.evenement) {

							if (result.evenement.nomEvenement){$("#nomEvent").prepend(result.evenement.nomEvenement);}
							if (result.evenement.dateDeb) $("#dateDeb").append(result.evenement.dateDeb);
							if (result.evenement.dateFin) $("#dateFin").append(result.evenement.dateFin);
							if (result.evenement.lieu) $("#lieu").append(result.evenement.lieu);
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//-----------------------------------AFFICHER UN CONTACT---------------------------------------------
function afficherArtiste(idArtiste){

	$.ajax({	type: "POST",
				url: "ajax/getArtiste.php",
				data: "idArtiste=" + idArtiste, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.artiste) {

							if (result.artiste.prenom){ $('.nomPrenom').prepend(result.artiste.prenom);$('.nomPrenom').prepend(" ");}
							if (result.artiste.idArtiste)$('section').attr('idArtiste',result.artiste.idArtiste);
							if (result.artiste.nom) $('.nomPrenom').prepend(result.artiste.nom);
							if (result.artiste.mail) $('#mail').append('<a href="mailto:'+result.artiste.mail+'">'+result.artiste.mail+'</a>');
							if (result.artiste.tel) $('#tel').append('<a href="tel:'+result.artiste.tel+'">'+result.artiste.tel+'</a>');

							if (result.artiste.prenom) $('#prenom').append(result.artiste.prenom);
							if (result.artiste.nom) $('#nom').append(result.artiste.nom);
							if (result.artiste.adresse) $('#adresse').append(result.artiste.adresse);
							if (result.artiste.ville) $('#adresse').append(result.artiste.ville);
								evenementArtiste();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}

//------------------------------Evenement sur le Repertoire----------------------------------------------
function evenementRep(){

	$('p').on('click',function() {
		$('#content').load('pages/afficherArtiste.html',afficherArtiste($(this).attr('idArtiste')));
	});

	$('#add').on('click',function() {
		$('#content').load('pages/formulaireArtiste.html',evenementFormulaireArt);
	});
	$("#search").hide();
	$('#searchBtn').on('click',function() {
		$("#search").toggle();
  });

	$('#menuRepArtistes').on('click',function() {
	$('#content').load('pages/formulaireEvenement.html',evenementFormulaireEve);
	});
}
function evenementAccueil() {
	$('article').on('click',function() {
		$('#content').load('pages/afficherEvenement.html',afficherEvenement($(this).attr('idEvent')));
	});
}
//------------------------------Evenement sur le Formulaire creer Evenement----------------------------------------------
var i=1;
function evenementFormulaireEve() {

	$('.btnAjouterContact').on('click',function() {
			enregistrerEvenement();
			});

	$('#nomG1').on('click',function() {$("#G1").toggle();});

	var i=2;
	$('.btnAjouterChamp').on('click',function() {

			$('#lesGroupes').append('<h2 id="nomG'+i+'">Groupe '+i+'</h2>');
			$('#nomG'+i).on('click',function() {$("#G"+i).toggle();});
			$divGroupe = $(document.createElement('div'));
			$($divGroupe).attr('id','G'+i);
			$divGroupe.append('<select class="selectGroupe">');
			$divGroupe.append('<option>Ratata');
			$divGroupe.append('<option>Fat Rat');
			$divGroupe.append('</select></label><label>Heure passage<input type="time" placeholder="Heure de passage"></label>');
			$('#lesGroupes').append($divGroupe);

			i=i+1;
	});

}
//------------------------------Evenement sur l'artiste----------------------------------------------------
function evenementArtiste(){
	$('.option').hide();
	$('#edit').on('click',function() {
		$('.option').toggle();
	});
/*
	$('[id!="option"]').on('click',function() {
		$('.option').hide();
	});*/

	$('#modifier').click(function(){
		$('#content').load('pages/formulaireArtiste.html',modifierArtiste($('section').attr('idArtiste')))
	});
}
//------------------------------Evenement sur le Formulaire creer Artiste------------------------------------
function evenementFormulaireArt() {
	$('.btnAjouterChamp').on('click',function() {
			var nouveauChamp = $('<label><input type="text" placeholder="Nouveau rôle"/></label>');
			$(this).after(nouveauChamp);
		});

	$('.btnAjouterContact').on('click',function() {
		enregistrerArtiste();
		});
}

//------------------------------Afficher champ obligatoire------------------------------------
function afficherChampObligatoire(champ,nb){
			$(champ).css('border-color','red');
			var finElement = $('<div id="error"><img src="./images/error.svg"><p>Attention certain champs sont obligatoire</p></div>');
			if(nb <1){
			$('.button-section').before(finElement);
		}

}
//-------------------------------------------------------------------------------------------------------
var nbErreurEvent=0;
function enregistrerEvenement() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
				var dateDeb=$('#dateDeb').val().substr(0,4)+$('#dateDeb').val().substr(5,2)+$('#dateDeb').val().substr(8,2);
				var dateFin=$('#dateFin').val().substr(0,4)+$('#dateFin').val().substr(5,2)+$('#dateFin').val().substr(8,2);
				dateDebInt=parseInt(dateDeb,10);
				dateFinInt=parseInt(dateFin,10);

				if(dateDebInt>dateDebInt){
						alert("pouet");
				}

				if($('#nom').val()==""){
					afficherChampObligatoire('#nom',nbErreurEvent);nbErreurEvent++;}
				if($('#dateDeb').val()==""){
					afficherChampObligatoire('#dateDeb',nbErreurEvent);nbErreurEvent++;}
				if($('#dateFin').val()==""){
						afficherChampObligatoire('#dateFin',nbErreurEvent);nbErreurEvent++;}
				else{
	var data =	'nom=' + $('#nom').val() +
				'&adresse=' + $('#adresse').val() +
				'&ville=' + $('#ville').val() +
				'&dateDebut=' + $('#dateDeb').val() +
				'&dateFin=' + $('#dateFin').val()+
				'&heureDebut=' + $('#heureDeb').val()+
				'&heureFin=' + $('#heureFin').val();

	$.ajax({	type: "POST",
				url: "ajax/saveEvenement.php",
				data: data, // On passe les informations saisies � l'�cran
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						// A COMPLETER
					} else {
						alert('erreur lors de l\'enregistrement');
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});}
}

//-------------------------------------------------------------------------------------------------------
var nbErreur=0;
function enregistrerArtiste() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
				if($('#nom').val()==""){
					afficherChampObligatoire('#nom',nbErreur);nbErreur++;}
				if($('#prenom').val()==""){
					afficherChampObligatoire('#prenom',nbErreur);nbErreur++;}
				if($('#tel').val()==""){
						afficherChampObligatoire('#tel',nbErreur);nbErreur++;}
				if($('#mail').val()==""){
						afficherChampObligatoire('#mail',nbErreur);nbErreur++}
				else{
	var data =	'nom=' + $('#nom').val() +
				'&prenom=' + $('#prenom').val() +
				'&tel=' + $('#tel').val() +
				'&addresse=' + $('#adresse').val() +
				'&ville=' + $('#ville').val()+
				'&mail=' + $('#mail').val()+
				'&roles=' + $('#listeRole').val()+
				'&genres=' + $('#genre').val();

	$.ajax({	type: "POST",
				url: "ajax/saveArtiste.php",
				data: data, // On passe les informations saisies � l'�cran
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						// A COMPLETER
					} else {
						alert('erreur lors de l\'enregistrement');
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});}
}
//------------------------------------------------------------------------------------------------------
//-----------------------------------MODIFIER UN CONTACT---------------------------------------------
function modifierArtiste(idArtiste){

	$.ajax({	type: "POST",
				url: "ajax/getContact.php",
				data: "idArtiste=" + idArtiste, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.artiste) {
							if (result.artiste.nom) $('#nom').val(result.artiste.nom) ;
							if (result.artiste.prenom) $('#prenom').val(result.artiste.prenom) ;
							if (result.artiste.mail) $('#mail').val(result.artiste.mail);
							if (result.artiste.tel) $('#tel').val(result.artiste.tel);
							if (result.artiste.ville) $('#ville').val(result.artiste.ville);
							evenementFormulaireArt();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

}
//------------------------------------------------------------------------------------------------------
