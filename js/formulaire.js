var erreurs = {
	erreurArtiste : 0,
	erreurEvent : 0,
	erreurGroupe : 0,
	erreurContact : 0,
	erreurOrganisateur : 0,
}

$(document).ready(function() {
	// Comportement des boutons de menus
	$('body nav #mnuAccueil').bind('click', function() { // Au clic sur le bouton "mnuAccueil" dans le menu
		$('#content').load('pages/accueil.html',afficherAccueil); // On charge la page accueil.html dans la div content
	});

	$('body nav #mnuRepertoire').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
		// On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
		$('#content').load('pages/afficherRep.html',eventMenuRep);
	});

  $('body nav #mnuOption').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
    // On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
    $('#content').load('pages/formulaireGroupe.html',evenementFormulaireGroupe);

  });

	$('body nav #mnuCalendrier').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
		// On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
		$('#content').load('pages/formulaireEvenement.html');

	});
  $('body nav #mnuAccueil').click();
});
// ---------------------------------------------------------------------------------------------------------------------------
// Active une option du menu (l'�l�ment � activer est pass� en param�tre)
function activerOptionMenu($element) {
	// D�sactive toutes les options du menu (met l'attribut 'actif' � faux)
	$('.menuRep input').attr('actif', false);
	// Active l'option choisie et re�ue en param�tre (met l'attribut 'actif' � vrai)
	$element.attr('actif', true);
}

//------------AFFICHER LE REPERTOIRE--------------------------------------------------------------------------------------------
function afficherRep(personne){

	$.ajax({	type: "POST", // envoie une requ�te � getListePersonnes pour demander la liste des personnes
				url: "ajax/getListeArtistes.php",
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {
						for (var id=0; id < result.artistes.length; id++) {

								if(document.getElementById(result.artistes[id].nomArtiste.substr(0,1))==null){

													$article = $(document.createElement('article'));
													$titre = $(document.createElement('h2'));
													$titre.html(result.artistes[id].nomArtiste.substr(0,1).toUpperCase());
													$article.append($titre);
													$ul = $(document.createElement('ul'));
													$ul.attr('id',result.artistes[id].nomArtiste.substr(0,1));
													$article.append($ul);
													$('#repertoire').append($article);
								}

										$liContact = $(document.createElement('li')); // On cr�e un li
										$liContact.append('<p idArtiste="'+result.artistes[id].idArtiste+'">'+result.artistes[id].nomArtiste+'</p>');
										$liContact.append('<img id=\'email\' src = "images/emailBtn.svg" />');
										$liContact.append('<img id=\'sms\' src = "images/smsBtn.svg" />');
										$liContact.append('<a href="tel:+337388388"><img id=\'call\' src = "images/callBtn.svg" /></a>');
										$('#'+result.artistes[id].nomArtiste.substr(0,1)).append($liContact);

						}
						evenementRep(personne);
					}
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
										$articleAcc.append('<p> Date :'+result.evenements[id].dateDeb+'<br/ >Lieu :'+result.evenements[id].ville+'</p>');
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
							if (result.evenement.idEvenement)$('section').attr('idEvent',result.evenement.idEvenement);
							if (result.evenement.nomEvenement){$("#nomEvent").prepend(result.evenement.nomEvenement);}
							if (result.evenement.dateDeb) $("#dateDeb").append(result.evenement.dateDeb);
							if (result.evenement.dateFin) $("#dateFin").append(result.evenement.dateFin);
							if (result.evenement.ville) $("#ville").append(result.evenement.ville);
						}
					}eventEvenement();
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
function evenementRep(personne){

	if(personne=="artiste"){
		$('p').on('click',function() {
			var param=$(this).attr('idArtiste');
			$('#content').load('pages/afficherArtiste.html',function(){afficherArtiste(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireArtiste.html',evenementFormulaireArt);
		});
	}
	else if(personne=="groupe"){
		$('p').on('click',function() {
			var param=$(this).attr('idGroupe');
			$('#content').load('pages/afficherGroupe.html',function(){afficherGroupe(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireGroupe.html',evenementFormulaireArt);
		});
	}
	else if(personne=="organisateur"){
		$('p').on('click',function() {
			var param=$(this).attr('idOrganisateur');
			$('#content').load('pages/afficherArtiste.html',function(){afficherArtiste(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireOrganisateur.html',evenementFormulaireGroupe);
		});
	}
	else if(personne=="contact"){
		$('p').on('click',function() {
			var param=$(this).attr('idContact');
			$('#content').load('pages/afficherArtiste.html',function(){afficherArtiste(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireContact.html');
		});
	}
}
//------------------------------Evenement sur le Menu du Repertoire----------------------------------------------
function eventMenuRep(){

	$("#search").hide();
	$('#searchBtn').on('click',function() {
		$("#search").toggle();
	});

	$('#menuRepArtistes').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("artiste");
	});

	$('#menuRepGroupe').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("groupe");
	});

	$('#menuRepOrganisateur').on('click',function() {
	activerOptionMenu($(this));
	$("#repertoire").empty();
	afficherRep("organisateur");
	});

	$('#menuRepContact').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("contact");
	});

	$('#menuRepContact').click();
}
function evenementAccueil() {
	$('article').on('click',function() {
		var param=$(this).attr('idEvent');
		$('#content').load('pages/afficherEvenement.html',function(){afficherEvenement(param)});// ====================================================
	});
}
//------------------------------Evenement sur le Formulaire creer Evenement----------------------------------------------

function evenementFormulaireEve() {

	$('.btnAjouterContact').on('click',function() {
			enregistrerEvenement();
			});

	$('#nomG1').on('click',function() {$("#G1").toggle();});

	var i=2;
	$('.btnAjouterChamp').on('click',function() {

		$titreGroupe = $(document.createElement('h2'));
    $titreGroupe.attr('id', 'nomG'+i) ;
		$titreGroupe.attr('numGroupe', i) ;
    $titreGroupe.html('Groupe '+i);
    $titreGroupe.on('click',function() {$("#G"+$(this).attr('numGroupe')).toggle();});
    $('#lesGroupes').append($titreGroupe);

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
//------------------------------Evenement sur l'evenement----------------------------------------------------
function eventEvenement(){
	$('.option').hide();
	$('#edit').on('click',function() {
		$('.option').show();
		$('.option').focus();
	});

	$('.option').focusout(function() {
		alert(pouet);
		$('.option').hide();
	});

	$('#modifier').click(function(){
		var param=$('section').attr('idEvent');
		$('#content').load('pages/formulaireEvenement.html',function(){modifierEvenement(param)})
	});
}
//------------------------------Evenement sur l'artiste----------------------------------------------------
function evenementArtiste(){
	$('.option').hide();
	$('#edit').on('click',function() {
		$('.option').show();
		$('.option').focus();
	});

	$('.option').focusout(function() {
		alert(pouet);
		$('.option').hide();
	});

	$('#modifier').click(function(){
		var param=$('section').attr('idArtiste');
		$('#content').load('pages/formulaireArtiste.html',function(){modifierArtiste(param)})
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

function evenementFormulaireGroupe() {

	$.ajax({	type: "POST",
						url: "ajax/getListeArtistes.php",
						success: function(data, textStatus, jqXHR) {
							var result = JSON.parse(data) ;
							if (result.status == 'success') {
								 for (var id=0; id < result.artistes.length; id++) {
									 $('#listeArtiste').append('<option>'+result.artistes[id].nomArtiste+'</option>');
								 }
								 $('.btnAjouterContact').on('click',function() {
									 enregistrerGroupe();
									 });
							} else {
								alert('erreur lors de l\'enregistrement');
							}
						},
						error: function() {
							alert('Erreur dans la requ�te au serveur.');
						}

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

function enregistrerEvenement() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
				var dateDeb=$('#dateDeb').val().substr(0,4)+$('#dateDeb').val().substr(5,2)+$('#dateDeb').val().substr(8,2);
				var dateFin=$('#dateFin').val().substr(0,4)+$('#dateFin').val().substr(5,2)+$('#dateFin').val().substr(8,2);
				dateDebInt=parseInt(dateDeb,10);
				dateFinInt=parseInt(dateFin,10);

				if(dateDebInt>dateFinInt){
						alert("pouet");
				}
				else if (dateDebInt==dateFinInt) {
					alert("les dates sont les même");
				}

				if($('#nom').val()==""){
					afficherChampObligatoire('#nom',erreurs.erreurEvent);erreurs.erreurEvent++;}
				if($('#dateDeb').val()==""){
					afficherChampObligatoire('#dateDeb',erreurs.erreurEvent);erreurs.erreurEvent++;}
				if($('#dateFin').val()==""){
						afficherChampObligatoire('#dateFin',erreurs.erreurEvent);erreurs.erreurEvent++;}
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

function enregistrerArtiste() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
				if($('#nom').val()==""){
					afficherChampObligatoire('#nom',erreurs.erreurArtiste);erreurs.erreurArtiste++;}
				if($('#prenom').val()==""){
					afficherChampObligatoire('#prenom',erreurs.erreurArtiste);erreurs.erreurArtiste++;}
				if($('#tel').val()==""){
						afficherChampObligatoire('#tel',erreurs.erreurArtiste);erreurs.erreurArtiste++;}
				if($('#mail').val()==""){
						afficherChampObligatoire('#mail',erreurs.erreurArtiste);erreurs.erreurArtiste++}
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
						  		alert('L\'enregistrement de l\'artiste a été effectué');
							}
							else {
								alert('erreur lors de l\'enregistrement');
							}
						},
					error: function() {
							alert('Erreur dans la requ�te au serveur.');
					}
			});}
}

//-------------------------------------------------------------------------------------------------------------------
//-------------------------------------------ENREGISTRER UN GROUPE------------------------------------------------
function enregistrerGroupe() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
	if($('#nom').val()==""){
					afficherChampObligatoire('#nom',erreurs.erreurGroupe);erreurGroupe++;
	}
	else{
		var data =	'nom=' + $('#nom').val() +
				'&siteWeb=' + $('#siteWeb').val()+
				'&listeArtiste=' + $('#listeArtiste').val();
				alert(data);
		$.ajax({	type: "POST",
				url: "ajax/saveGroupe.php",
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
//-----------------------------------ENREGISTRER UN ORGANISATEUR---------------------------------------------

function enregistrerOrganisateur() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
	if($('#nom').val()==""){
					afficherChampObligatoire('#nom',erreurs.erreurOrganisateur);erreurs.erreurOrganisateur++;
	}
	if($('#tel').val()==""){
					afficherChampObligatoire('#tel',erreurs.erreurOrganisateur);erreurs.erreurOrganisateur++;
	}

	else{
		var data =	'nom=' + $('#nom').val() +
				'&prenom=' + $('#prenom').val()+
				'&tel=' + $('#tel').val()+
				'&addresse=' + $('#adresse').val() +
				'&ville=' + $('#ville').val()+
				'&mail=' + $('#mail').val()+
				'&siteWeb=' + $('#siteWeb').val();
				alert(data);
		$.ajax({	type: "POST",
				url: "ajax/saveOrganisateur.php",
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
//-----------------------------------MODIFIER UN GROUPE---------------------------------------------
function modifierGroupe(idGroupe){

	$.ajax({	type: "POST",
				url: "ajax/getGroupe.php",
				data: "idGroupe=" + idGroupe, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.artiste) {
							if (result.groupe.nom) $('#nom').val(result.artiste.nom) ;

						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

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
//-----------------------------------MODIFIER UN CONTACT---------------------------------------------
function modifierEvenement(idEvent){

	$.ajax({	type: "POST",
				url: "ajax/getEvenement.php",
				data: "idEvenement=" + idEvent, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.evenement) {
							if (result.evenement.nomEvenement) $('#nom').val(result.evenement.nomEvenement) ;
							if (result.evenement.dateDeb) $('#dateDeb').val(result.evenement.dateDeb) ;
							if (result.evenement.dateFin) $('#dateFin').val(result.evenement.dateFin);
							if (result.evenement.ville) $('#ville').val(result.evenement.ville);
							evenementFormulaireEve();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

}
