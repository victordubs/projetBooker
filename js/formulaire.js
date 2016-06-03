var erreurs = {
	erreurArtiste : 0,
	erreurEvent : 0,
	erreurGroupe : 0,
	erreurContact : 0,
	erreurOrganisateur : 0,
	erreurConnexion:0,
}
var autreChamp = {
	nbRole : 1,
	nbGenre : 1,
	nbType : 1,
}

var nbGroupeEvenement=0;


$(document).ready(function() {
					verifeConnecter();
});
//--------------------------------------------------------------------------------------------------------------------------
//-----------------------------------VERIFE CONNECCTER---------------------------------------------------------------------
function verifeConnecter(){
$.ajax({	type: "POST",
			url: "ajax/verifConnecter.php",
			success: function(data, textStatus, jqXHR) {
				var result = JSON.parse(data) ;
				if (result.status == 'success') {
					if (result.reponse == 'true') {
							$('#menu').load('pages/menu.html',chargeSite);

					}else{
							$('#content').load('pages/formulaireConnexion.html',eventConnexion);

					}
				}
			},
			error: function() {
				alert('Erreur dans la requ�te au serveur.');
			}
});
}
//--------------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVEMENT FORMULAIRE CONNECTION---------------------------------------------------------------------
function eventConnexion(){
	$(".bouton").on('click',function(){
		connection();
	});
}
//--------------------------------------------------------------------------------------------------------------------------
//-----------------------------------CONNECTION AU SITE---------------------------------------------------------------------
function connection(){

	if($("#login").val()==""){
		afficherChampObligatoire('#login',erreurs.erreurConnexion);
	}
	if($("#password").val()==""){
		afficherChampObligatoire('#login',erreurs.erreurConnexion);
	}
	else if($("#password").val()!="" && $("#login").val()!=""){
				var data='login='+$("#login").val()+
									'&password='+$("#password").val();
//alert(data);
				$.ajax({	type: "POST",
						url: "ajax/connexion.php",
						data:data,
						success: function(data, textStatus, jqXHR) {
							var result = JSON.parse(data) ;
							if (result.status == 'success') {
								if (result.reponse == 'true') {
										$('#menu').load('pages/menu.html',chargeSite);
								}
					 	 }
					},
					error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
			});
	}
}
//--------------------------------------------------------------------------------------------------------------------------
//-----------------------------------CHARGE LE SITE ET LE MENU--------------------------------------------------------------
function chargeSite(){
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
		$('#content').load('pages/afficherParametres.html',eventOption);

	});

	$('body nav #mnuCalendrier').bind('click', function() { // Au clic sur le bouton "mnuPersonne" dans le menu
		// On charge la page voirPersonne.html dans la div content et on appelle la fonction d'initialisation de cette page
	//	$('#content').load('pages/formulaireEvenement.html',evenementFormulaireEve);
	    $('#content').load('pages/calendrier.html',eventCalendrier);
	});

	$('body nav #mnuAccueil').click();
}

//--------------------------------------------------------------------------------------------------------------------------
//-----------------------------------ACTIVE UNE OPTION DU MENU--------------------------------------------------------------

function activerOptionMenu($element) {
	// D�sactive toutes les options du menu (met l'attribut 'actif' � faux)
	$('.menuRep input').attr('actif', false);
	// Active l'option choisie et re�ue en param�tre (met l'attribut 'actif' � vrai)
	$element.attr('actif', true);
}

//-----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER LE REPERTOIRE--------------------------------------------------------------
function afficherRep(personne){

	$.ajax({	type: "POST", // envoie une requ�te � getListePersonnes pour demander la liste des personnes
				url: "ajax/getRepertoire.php",
				data:"personne="+personne,
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {

						for (var id=0; id < result.personnes.length; id++) {

							var chaineNom=result.personnes[id].nom.charAt(0).toUpperCase() + result.personnes[id].nom.substring(1).toLowerCase();

								if(document.getElementById(chaineNom.substr(0,1))==null){

													$article = $(document.createElement('article'));
													$titre = $(document.createElement('h2'));
													$titre.html(chaineNom.substr(0,1).toUpperCase());
													$article.append($titre);
													$ul = $(document.createElement('ul'));
													$ul.attr('id',chaineNom.substr(0,1));
													$article.append($ul);
													$('#repertoire').append($article);
								}

										$liContact = $(document.createElement('li')); // On cr�e un li
										$liContact.append('<p id="'+result.personnes[id].idp+'">'+chaineNom+'</p>');
										$liContact.append('<img id=\'email\' src = "images/emailBtn.svg" />');
										$liContact.append('<img id=\'sms\' src = "images/smsBtn.svg" />');
										$liContact.append('<a href="tel:'+result.personnes[id].tel+'"><img id=\'call\' src = "images/callBtn.svg" /></a>');
										$('#'+chaineNom.substr(0,1)).append($liContact);

						}
						evenementRep(personne);
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER ACCUEIL--------------------------------------------------------------
function afficherAccueil(){

	$.ajax({	type: "POST", // envoie une requ�te � getListeEvenement pour demander la liste des personnes
				url: "ajax/getListeEvenement.php",
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {

								for (var id=0; id < result.evenements.length; id++) {

										$articleAcc = $(document.createElement('article')); // On cr�e un article
										$articleAcc.attr('idEvent',result.evenements[id].idp);
										$articleAcc.append('<h2>'+result.evenements[id].nom+'</h2>');
										$articleAcc.append('<p> Date :'+result.evenements[id].dateDeb+/*+'<br/ >Lieu :'+result.evenements[id].ville+*/'</p>');
										$('section').append($articleAcc);
							  }
							}evenementAccueil();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}

//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AJOUTER CALENDRIER--------------------------------------------------------------
function ajouterCalendrier(){

	$.ajax({	type: "POST", // envoie une requ�te � getListeEvenement pour demander la liste des personnes
				url: "ajax/getListeEvenement.php",
				success: function(data, textStatus, jqXHR) {
					var result=JSON.parse(data);
					if (result.status == 'success') {
							if(result.evenements){
								for (var id=0; id < result.evenements.length; id++) {

										$('#je'+result.evenements[id].dateDeb.substr(0,2)).append("•");

										if($('#j'+result.evenements[id].dateDeb.substr(0,2)).attr('nbEvent')==undefined){
											var i=1;
											$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("nbEvent",i);
											$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("nom"+i,result.evenements[id].nom);
											$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("idp"+i,result.evenements[id].idp);
											$('#j'+result.evenements[id].dateDeb.substr(0,2)).append($('#je'+result.evenements[id].dateDeb.substr(0,2)));
									}else{
										var i=i+1
										$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("nbEvent",i);
										$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("nom"+i,result.evenements[id].nom);
										$('#j'+result.evenements[id].dateDeb.substr(0,2)).attr("idp"+i,result.evenements[id].idp);
										$('#j'+result.evenements[id].dateDeb.substr(0,2)).append($('#je'+result.evenements[id].dateDeb.substr(0,2)));
									}
							  }
							}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AJOUTER CALENDRIER-----------------------------------------------------------------
function eventCalendrier(){

	var d = new Date();
  var n = d.getDate();
	$('#j'+n).attr('day','today');
	ajouterCalendrier();
	$('#add').on('click',function() {
				$('#content').load('pages/formulaireEvenement.html',evenementFormulaireEve);
	});

	$('td').on('click',function() {
				$('td').attr('selected',false);
				$(this).attr('selected',true);

				$('#infosEvent').empty();
				$ulevent = $(document.createElement('ul'));
    		for(var i=1;i<=$(this).attr("nbEvent");i++){

							$lievent = $(document.createElement('li'));
							$lievent.html($(this).attr("nom"+i));
							$lievent.attr("idp",$(this).attr("idp"+i));
							$ulevent.append($lievent);
			}

				$('#infosEvent').append($ulevent);

				$('li').on('click',function() {
						var param=$(this).attr('idp');
					  $('#content').load('pages/afficherEvenement.html',function(){afficherEvenement(param)});

				});

	});
}

//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER UN EVENEMENT--------------------------------------------------------------
function afficherEvenement(idEvenement){

	$.ajax({	type: "POST",
				url: "ajax/getEvenement.php",
				data: "idp=" + idEvenement,// On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {

						if (result.evenement) {
							if (result.evenement.idp)$('section').attr('idEvent',result.evenement.idp);
							if (result.evenement.nom){$("#nomEvent").prepend(result.evenement.nom);}
							if (result.evenement.dateDeb) $("#dateDeb").append(result.evenement.dateDeb);
							if (result.evenement.dateFin) $("#dateFin").append(result.evenement.dateFin);
							if (result.evenement.heureDeb) $("#heureDeb").append(result.evenement.heureDeb);
							if (result.evenement.heureFin) $("#heureFin").append(result.evenement.heureFin);
							if (result.evenement.ville) $("#ville").append(result.evenement.ville);
							if (result.evenement.libelle) $("#descri").append(result.evenement.libelle);

							if (result.evenement.plages){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.evenement.plages.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.evenement.plages[i]["nom"]);
									$lievent.attr("idGroupe",result.evenement.plages[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoGroupes').append($ulevent);
							}

							if (result.evenement.organisateurs){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.evenement.organisateurs.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.evenement.organisateurs[i]["nom"]);
									$lievent.attr("idOrga",result.evenement.organisateurs[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoOrganisateurs').append($ulevent);
							}

						}
					}eventEvenement();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER UN ORGANISATEUR--------------------------------------------------------------

function afficherOrganisateur(idOrganisateur){

	$.ajax({	type: "POST",
				url: "ajax/getOrganisateur.php",
				data: "idp=" + idOrganisateur,// On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.organisateur) {

							if (result.organisateur.prenom){ $('.nomPrenom').prepend(result.organisateur.prenom);$('.nomPrenom').prepend(" ");}
							if (result.organisateur.idp)$('section').attr('id',result.organisateur.idp);
							if (result.organisateur.nom) $('.nomPrenom').prepend(result.organisateur.nom);
							if (result.organisateur.mail) $('#mail').append('<a href="mailto:'+result.organisateur.mail+'">'+result.organisateur.mail+'</a>');
							if (result.organisateur.tel) $('#tel').append('<a href="tel:'+result.organisateur.tel+'">'+result.organisateur.tel+'</a>');
							if (result.organisateur.tel) $('#siteWeb').append('<a href="'+result.organisateur.siteWeb+'">'+result.organisateur.siteWeb+'</a>');

							if (result.organisateur.prenom) $('#prenom').append(result.organisateur.prenom);
							if (result.organisateur.nom) $('#nom').append(result.organisateur.nom);
							if (result.organisateur.adresse) $('#adresse').append(result.organisateur.adresse);
							if (result.organisateur.ville) $('#ville').append(result.organisateur.ville);
							if (result.organisateur.nombrePlaces) $('#nbPlaces').append(result.organisateur.nombrePlaces);

							if (result.organisateur.evenements){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.organisateur.evenements.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.organisateur.evenements[i]["nom"]);
									$lievent.attr("idEvent",result.organisateur.evenements[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoEvents').append($ulevent);
							}

						}
					}evenementOrganisateur();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER UN CONTACT--------------------------------------------------------------

function afficherContact(idContact){

	$.ajax({	type: "POST",
				url: "ajax/getContact.php",
				data: "idp=" + idContact,// On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.contact) {
							if (result.contact.prenom){ $('.nomPrenom').prepend(result.contact.prenom);$('.nomPrenom').prepend(" ");}
							if (result.contact.idp)$('section').attr('id',result.contact.idp);
							if (result.contact.nom) $('.nomPrenom').prepend(result.contact.nom);
							if (result.contact.mail) $('#mail').append('<a href="mailto:'+result.contact.mail+'">'+result.contact.mail+'</a>');
							if (result.contact.tel) $('#tel').append('<a href="tel:'+result.contact.tel+'">'+result.contact.tel+'</a>');

							if (result.contact.prenom) $('#prenom').append(result.contact.prenom);
							if (result.contact.nom) $('#nom').append(result.contact.nom);
							if (result.contact.adresse) $('#adresse').append(result.contact.adresse);
							if (result.contact.ville) $('#ville').append(result.contact.ville);
							if (result.contact.types){
								for(var i=0;i<result.contact.types.length;i++){
									$('#type').append(result.contact.types[i]);
									if(i!=(result.contact.types.length)-1){
										$('#type').append("/");
									}
								}
							}
							if (result.contact.groupes){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.contact.groupes.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.contact.groupes[i]["nom"]);
									$lievent.attr("idEvent",result.contact.groupes[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoGroupes').append($ulevent);
							}

						}
					}evenementContact();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}

//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER UN ARTISTE--------------------------------------------------------------

function afficherArtiste(idArtiste){

	$.ajax({	type: "POST",
				url: "ajax/getArtiste.php",
				data: "idp=" + idArtiste,// On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.artiste) {
							if (result.artiste.prenom){ $('.nomPrenom').prepend(result.artiste.prenom);$('.nomPrenom').prepend(" ");}
							if (result.artiste.idp)$('section').attr('id',result.artiste.idp);
							if (result.artiste.nom) $('.nomPrenom').prepend(result.artiste.nom);
							if (result.artiste.mail) $('#mail').append('<a href="mailto:'+result.artiste.mail+'">'+result.artiste.mail+'</a>');
							if (result.artiste.tel) $('#tel').append('<a href="tel:'+result.artiste.tel+'">'+result.artiste.tel+'</a>');

							if (result.artiste.prenom) $('#prenom').append(result.artiste.prenom);
							if (result.artiste.nom) $('#nom').append(result.artiste.nom);
							if (result.artiste.adresse) $('#adresse').append(result.artiste.adresse);
							if (result.artiste.ville) $('#ville').append(result.artiste.ville);
							if (result.artiste.roles){
								for(var i=0;i<=result.artiste.roles.length;i++){
										$('#role').append(result.artiste.roles[i]);
										if(i!=(result.artiste.roles.length)-1)$('#role').append("/");

								}
							}
							if (result.artiste.groupes){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.artiste.groupes.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.artiste.groupes[i]["nom"]);
									$lievent.attr("idGroupe",result.artiste.groupes[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoGroupes').append($ulevent);
							}


								evenementArtiste();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER UN GROUPE--------------------------------------------------------------

function afficherGroupe(idGroupe){

	$.ajax({	type: "POST",
				url: "ajax/getGroupe.php",
				data: "idp=" + idGroupe,// On passe l'id de la personne que l'on veut voir
			  success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.groupe) {

							if (result.groupe.prenom){ $('.nomPrenom').prepend(result.groupe.prenom);$('.nomPrenom').prepend(" ");}
							if (result.groupe.idp)$('section').attr('idp',result.groupe.idp);
							if (result.groupe.nom) $('.nomPrenom').prepend(result.groupe.nom);
							if (result.groupe.mail) $('#mail').append('<a href="mailto:'+result.groupe.mail+'">'+result.groupe.mail+'</a>');
							if (result.groupe.tel) $('#tel').append('<a href="tel:'+result.groupe.tel+'">'+result.groupe.tel+'</a>');

							if (result.groupe.prenom) $('#prenom').append(result.groupe.prenom);
							if (result.groupe.nom) $('#nom').append(result.groupe.nom);
							if (result.groupe.adresse) $('#adresse').append(result.groupe.adresse);
							if (result.groupe.ville) $('#ville').append(result.groupe.ville);

							if (result.groupe.evenements){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.groupe.evenements.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.groupe.evenements[i]["nom"]);
									$lievent.attr("idEvent",result.groupe.evenements[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoEvents').append($ulevent);
							}

							if (result.groupe.artistes){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.groupe.artistes.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.groupe.artistes[i]["nom"]);
									$lievent.attr("idArtiste",result.groupe.artistes[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoArtistes').append($ulevent);
							}

							if (result.groupe.autresContact){
								$ulevent = $(document.createElement('ul'));
								for(var i=0;i<result.groupe.autresContact.length;i++){

									$lievent = $(document.createElement('li'));
									$lievent .append(result.groupe.autresContact[i]["nom"]);
									$lievent.attr("idContacts",result.groupe.autresContact[i]["id"]);
									$ulevent.append($lievent);

								}
								$('#infoContacts').append($ulevent);
							}

						}
					}evenementGroupe();
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}

//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT REPERTOIRE--------------------------------------------------------
function evenementRep(personne){

// Evenement sur le répertoire des artistes
	if(personne=="Artistes"){
		$('p').on('click',function() {
			var param=$(this).attr('id');
			$('#content').load('pages/afficherArtiste.html',function(){afficherArtiste(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireArtiste.html',evenementFormulaireArt);
		});
	}
// Evenement sur le répertoire des groupes
	else if(personne=="Groupes"){
		$('p').on('click',function() {
			var param=$(this).attr('id');
			$('#content').load('pages/afficherGroupe.html',function(){afficherGroupe(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireGroupe.html',evenementFormulaireGroupe);
		});
	}
// Evenement sur le répertoire des organisateurs
	else if(personne=="Organisateurs"){
		$('p').on('click',function() {
			var param=$(this).attr('id');
			$('#content').load('pages/afficherOrganisateur.html',function(){afficherOrganisateur(param)});
		});

		$('#add').on('click',function() {
			$('#content').load('pages/formulaireOrganisateur.html',eventFormulaireOrganisateur);
		});
	}
// Evenement sur le répertoire des contacts
	else if(personne=="AutresContact"){
		$('p').on('click',function() {
			var param=$(this).attr('id');
			$('#content').load('pages/afficherContact.html',function(){afficherContact(param)});
		});

		$('#add').on('click',function() {
		$('#content').load('pages/formulaireContact.html',evenementFormulaireContact);
		});
	}
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------RECHERCHER UNE PERSONNE-------------------------------------------------------
function rechercherPersonnes(nomPersonne){

	$.ajax({	type: "POST",
			url: "ajax/rechercherPersonne.php",
			data:'nomPersonne='+nomPersonne,
			success: function(data, textStatus, jqXHR) {
			var result = JSON.parse(data) ;
			  if (result.status == 'success') {

					if(result.personnes){
						$article = $(document.createElement('article'));
						$titre = $(document.createElement('h2'));
						$titre.html('Résultat personnes trouvée: '+result.personnes.length);
						$article.append($titre);
						$ul = $(document.createElement('ul'));
						for (var id=0; id < result.personnes.length; id++) {
							$liContact = $(document.createElement('li')); // On cr�e un li
							$liContact.append('<p id="'+result.personnes[id].idp+'">'+result.personnes[id].nom+'</p>');
							$liContact.append('<img id=\'email\' src = "images/emailBtn.svg" />');
							$liContact.append('<img id=\'sms\' src = "images/smsBtn.svg" />');
							$liContact.append('<a href="tel:+337388388"><img id=\'call\' src = "images/callBtn.svg" /></a>');
							$ul.append($liContact);
					  }
						$article.append($ul);
						$('#repertoire').append($article);

				 }
			 }
		},
		error: function() {
			alert('Erreur dans la requ�te au serveur.');
		}
 });
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT MENU REPERTOIRE--------------------------------------------------------
function eventMenuRep(){

	$("#search").hide();
	$('#searchBtn').on('click',function() {
		$("#search").toggle();
	});

	$('#search').keyup(function(e) {
   if(e.keyCode == 13) { // KeyCode de la touche entrée
		 	$('#repertoire').empty();
			var param=$("#search").val();
			rechercherPersonnes(param);
   }
  });

	$('#menuRepArtistes').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("Artistes");
	});

	$('#menuRepGroupe').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("Groupes");
	});

	$('#menuRepOrganisateur').on('click',function() {
	activerOptionMenu($(this));
	$("#repertoire").empty();
	afficherRep("Organisateurs");
	});

	$('#menuRepContact').on('click',function() {
	activerOptionMenu($(this));
	$('#repertoire').empty();
	afficherRep("AutresContact");
	});

	$('#menuRepArtistes').click();
}
function evenementAccueil() {
	$('article').on('click',function() {
		var param=$(this).attr('idEvent');
		$('#content').load('pages/afficherEvenement.html',function(){afficherEvenement(param)});
	});
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT OPTION-----------------------------------------------------------------
function eventOption(){

	$('#logOut').on('click',function() {
			deconnexion();
	});
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------DECONNEXION ---------------------------------------------------------------------
function deconnexion(){

	$.ajax({	type: "POST",
			url: "ajax/deconnexion.php",
			data:'personne=organisateurs',
			success: function(data, textStatus, jqXHR) {
			var result = JSON.parse(data) ;
			if (result.status == 'success') {
					if(result.reponse==true){
						alert("Merci de votre passage. Vous allez être déconnecté");
						verifeConnecter();
					}else{
						alert("Erreur dans la deconnexion");
					}
		  }
		},
		error: function() {
			alert('Erreur dans la requ�te au serveur.');
		}
 });
}
//--------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT FORMULAIRE EVENEMENT---------------------------------------------------
function evenementFormulaireEve() {

	$('#info2').hide();
	$('#info3').hide();
	//$('#info4').hide();

	$('.btnAjouterContact').on('click',function() {
			enregistrerEvenement();
	});

	var i=1;
	$('#dateFin').bind('change', function() {
				$('#info2').show();
				$('#info3').show();
				//$('#info4').show();
				getListeGroupesDate(i);
				 i=i+1;
				 getListeOrganisateurs();
				// getListeContacts();
			});

	$('.btnAjouterGroupes').on('click',function() {
		 getListeGroupesDate(i);
		 i=i+1;
	});
}
//---------------------------------------------------------------------------------------------------------------------
//-----------------------------------GET LISTE ORGANISATEUR-----------------------------------------------------------------
function getListeOrganisateurs(){
				$.ajax({	type: "POST",
						url: "ajax/getRepertoire.php",
						data:'personne=organisateurs',
						success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
					// Boucle pour remplir la liste des Artistes
					  if(result.personnes){
							 for (var id=0; id < result.personnes.length; id++) {
							 				$OptionGroupe = $(document.createElement('option'));
							 				$OptionGroupe.attr('idp',result.personnes[id].idp);
							 				$OptionGroupe.html(result.personnes[id].nom);
							 				$('#selectOrganisateur').append($OptionGroupe);
							 }
					}
					 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}
			 });

}
//---------------------------------------------------------------------------------------------------------------------
//-----------------------------------GET LISTE GROUPES-----------------------------------------------------------------
function getListeGroupesDate(i) {

		// On transforme la date de Début et la date de fin en entier
		if(veriferDates()==false){
					var data='dateDeb=' + $('#dateDeb').val() +
								   '&dateFin=' + $('#dateFin').val();
//alert(data);
					$.ajax({	type: "POST",
								url: "ajax/getGroupeDispoAtDate.php",
								data:data,
								success: function(data, textStatus, jqXHR) {
								var result = JSON.parse(data) ;
								if (result.status == 'success') {

									$titreGroupe = $(document.createElement('h2'));
									$titreGroupe.attr('id', 'nomG'+i) ;
									$titreGroupe.attr('numGroupe', i) ;
									$titreGroupe.html('Groupe '+i);
									$titreGroupe.on('click',function() {$("#G"+$(this).attr('numGroupe')).toggle();});
									$('#lesGroupes').append($titreGroupe);
									nbGroupeEvenement++;

									$divGroupe = $(document.createElement('div'));
									$($divGroupe).attr('id','G'+i);
									$divGroupe.append('<select id="selectGroupe'+i+'">');
									$('#selectGroupe'+i).append('<option>Aucun</option>')
									$('#lesGroupes').append($divGroupe);

									if(result.groupesDispo){
											for (var id=0; id < result.groupesDispo.length; id++) {

															$OptionGroupe = $(document.createElement('option'));
															$OptionGroupe.attr('idp',result.groupesDispo[id].id);
															$OptionGroupe.html(result.groupesDispo[id].nom);
															$('#selectGroupe'+i).append($OptionGroupe);
											}
									}
									 $divGroupe.append('</select></label><input type="time" id="heureG'+i+'" placeholder="Heure de passage">');
									 $('#lesGroupes').append($divGroupe);
							 }else{
								 alert(result.errMessage);
							 }
							},
							error: function() {
								alert('Erreur dans la requ�te au serveur.');
							}

						});
			 }
}

//---------------------------------------------------------------------------------------------------------------------
//----------------------------------- FONCTION VERIFIER DATES----------------------------------------------------------

function veriferDates(){

	if($('#dateDeb').val()==""){
			afficherChampObligatoire('#dateDeb',erreurs.erreurEvent);erreurs.erreurEvent++;}
	if($('#dateFin').val()==""){
		afficherChampObligatoire('#dateFin',erreurs.erreurEvent);erreurs.erreurEvent++;
	}
	if($('#dateFin').val()!="" && $('#dateDeb').val()!="") {

			var dateDeb=$('#dateDeb').val().substr(0,4)+$('#dateDeb').val().substr(5,2)+$('#dateDeb').val().substr(8,2);
			var dateFin=$('#dateFin').val().substr(0,4)+$('#dateFin').val().substr(5,2)+$('#dateFin').val().substr(8,2);
			dateDebInt=parseInt(dateDeb,10);
			dateFinInt=parseInt(dateFin,10);

			if(dateDebInt>dateFinInt){
					alert("Erreur la date de début est supérieur à la date de Fin");
					return true;
			}
			else if (dateDebInt==dateFinInt){
					//alert("les dates sont les même"+dateDebInt+" "+dateFinInt);
					return true;
		  }
	}
	else{return true;}
// SI IL Y'A PAS D'ERREUR ALORS ON RETOURNE FALSE
	return false;
}


//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT SUR EVENEMENT----------------------------------------------------------

function eventEvenement(){
	$('.option').hide();

	$('#edit').on('click',function() {
		// console.log('click sur edit');
		$('.option').toggle();
		setTimeout(function(){ $(':NOT(.option)').bind('click', clickHandler); }, 200);
	});

	$('#modifier').click(function(){
		var param=$('section').attr('idevent');
		$('#content').load('pages/formulaireEvenement.html',function(){modifierEvenement(param)})
	});
}

//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT SUR CONTACT----------------------------------------------------------

function 	evenementContact(){
	$('.option').hide();

	$('#edit').on('click',function() {
		// console.log('click sur edit');
		$('.option').toggle();
		setTimeout(function(){ $(':NOT(.option)').bind('click', clickHandler); }, 200);
	});

	$('#modifier').click(function(){
		var param=$('section').attr('idArtiste');
		$('#content').load('pages/formulaireContact.html',function(){modifierContact(param)})
	});
}
//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT SUR CONTACT----------------------------------------------------------

function 	evenementGroupe(){
	$('.option').hide();

	$('#edit').on('click',function() {
		// console.log('click sur edit');
		$('.option').toggle();
		setTimeout(function(){ $(':NOT(.option)').bind('click', clickHandler); }, 200);
	});

	$('#modifier').click(function(){
		var param=$('section').attr('idp');
		$('#content').load('pages/formulaireGroupe.html',function(){modifierGroupe(param)})
	});
}
//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT SUR ORGANISATEUR----------------------------------------------------------

function 	evenementOrganisateur(){
	$('.option').hide();

	$('#edit').on('click',function() {
		// console.log('click sur edit');
		$('.option').toggle();
		setTimeout(function(){ $(':NOT(.option)').bind('click', clickHandler); }, 200);
	});

	$('#modifier').click(function(){
		var param=$('section').attr('id');
		$('#content').load('pages/formulaireOrganisateur.html',function(){modifierOrganisateur(param)})
	});

	$('#supprimer').click(function(){
		var param=$('section').attr('id');
    supprimerOrganisateur(param);
	});


}
//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT SUR ARTISTE----------------------------------------------------------

var clickHandler = function() {
		console.log('click ailleurs');
		$('.option').hide();
		$(':NOT(.option)').unbind('click', clickHandler);
}

function evenementArtiste(){
	$('.option').hide();

	$('#edit').on('click',function() {
		// console.log('click sur edit');
		$('.option').toggle();
		setTimeout(function(){ $(':NOT(.option)').bind('click', clickHandler); }, 200);
	});

	$('#modifier').click(function(){
		var param=$('section').attr('id');
		$('#content').load('pages/formulaireArtiste.html',function(){modifierArtiste(param)})
	});
}
//------------------------------------------------------------------------------------------------------------------
//-----------------------------------AJOUTER UN AUTRE CHAMP---------------------------------------------------------
function ajouterAutreChamp(place,placeAttr,nbAutre){
	$nouveauChamp = $(document.createElement('input'));
	$($nouveauChamp).attr('type','text');
	$($nouveauChamp).attr('id','autre'+placeAttr+nbAutre);
	$($nouveauChamp).attr('placeholder','Nouveau '+placeAttr);
	$(place).after($nouveauChamp);
}

//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT FORMULAIRE CONTACT---------------------------------------------------


function evenementFormulaireContact() {
  getTypes();

	$('#btnAjouterType').on('click',function() {
			   ajouterAutreChamp($(this),$(this).attr('new'),autreChamp.nbType);
			   autreChamp.nbType++;
	});

	$('.btnAjouterContact').on('click',function() {
		enregistrerContact()
		});
}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------CREER LISTE METIER------------------------------------------------------------
function getTypes(){
				$.ajax({	type: "POST",
						url: "ajax/getListeType.php",
						success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
					// Boucle pour remplir la liste des métiers
							 for (var id=0; id < result.types.length; id++) {
								 $('#types').append('<option>'+result.types[id]+'</option>');
							 }
					 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}
			 });

}
//------------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT FORMULAIRE ARTISTE---------------------------------------------------
function evenementFormulaireArt() {

// Initialisation du nombre d'autre champ
	autreChamp.nbRole=1;
  autreChamp.nbGenre=1;
// Initialisation de la liste des roles
	getRoles();
// Initialisation de la liste des genres
  //getGenres();
// Action ajouter un autre champ Role
	$('#btnAjouterRole').on('click',function() {
			   ajouterAutreChamp($(this),$(this).attr('new'),autreChamp.nbRole);
			   autreChamp.nbRole++;
		});
// Action ajouter un autre champ genre
	$('#btnAjouterGenre').on('click',function() {
				   ajouterAutreChamp($(this),$(this).attr('new'),autreChamp.nbGenre);
				autreChamp.nbGenre++;
			});
// Action enregistrer un nouveau artiste
	$('.btnAjouterContact').on('click',function() {
		enregistrerArtiste();
		});
}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------CREER LISTE GENRES------------------------------------------------------------
function getRoles(){
				$.ajax({	type: "POST",
						url: "ajax/getListeRole.php",
						success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
					// Boucle pour remplir la liste des roles
							 for (var id=0; id < result.roles.length; id++) {
								 $('#roles').append('<option>'+result.roles[id]+'</option>');
							 }
					 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}
			 });

}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------CREER LISTE GENRES---------------------------------------------------
function getGenres(){
				$.ajax({	type: "POST",
						url: "ajax/getListeStyle.php",
						success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
				 	// Boucle pour remplir la liste des genres
							 for (var id=0; id < result.styles.length; id++) {
								 $('#genres').append('<option>'+result.styles[id]+'</option>');
							 }
					 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}
			 });

}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT FORMULAIRE ORGANISATEUR---------------------------------------------

function eventFormulaireOrganisateur() {
					$('.btnAjouterContact').on('click',function() {
							enregistrerOrganisateur();
 					});
}

//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------EVENEMENT FORMULAIRE GROUPE---------------------------------------------------

function evenementFormulaireGroupe() {
// Initialisation du nombre d'autre champ
  		autreChamp.nbGenre=1;
// Initialisation de la liste des genres
			  getGenres();
// Initialisation de la liste des artistes
			getListeArtistes();
// Initialisation de la liste des contacts
			getListeContacts();

			$('#btnAjouterGenre').on('click',function() {
						ajouterAutreChamp($(this),$(this).attr('new'),autreChamp.nbGenre);
					  autreChamp.nbGenre++;
			});

			$('.btnAjouterContact').on('click',function() {
						enregistrerGroupe();
			});
}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------CREER LISTE ARTISTES----------------------------------------------------------
function getListeArtistes(){
$.ajax({	type: "POST",
					url: "ajax/getRepertoire.php",
					data:'personne=artistes',
					success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
							if(result.personnes){
					// Boucle pour remplir la liste des Artistes
							 for (var id=0; id < result.personnes.length; id++) {

								 $OptionGroupe = $(document.createElement('option'));
								 $OptionGroupe.attr('idp',result.personnes[id].idp);
								 $OptionGroupe.html(result.personnes[id].nom);
								 $('#listeArtiste').append($OptionGroupe);
						 }
					 }
				 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}

});
}
//-----------------------------------------------------------------------------------------------------------------
//-----------------------------------CREER LISTE CONTACT----------------------------------------------------------
function getListeContacts(){
$.ajax({	type: "POST",
					url: "ajax/getRepertoire.php",
					data:'personne=AutresContact',
					success: function(data, textStatus, jqXHR) {
						var result = JSON.parse(data) ;
						if (result.status == 'success') {
					       if(result.personnes){
			// Boucle pour remplir la liste des Artistes
					 						for (var id=0; id < result.personnes.length; id++) {

						 									$OptionGroupe = $(document.createElement('option'));
						 									$OptionGroupe.attr('idp',result.personnes[id].idp);
						 									$OptionGroupe.html(result.personnes[id].nom);
						 									$('#listeContact').append($OptionGroupe);
				   						}
			   				}

					 }
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}

});
}

//-----------------------------------------------------------------------------------------------------------------------
//-----------------------------------AFFICHER CHAMP OBLIGATOIRE----------------------------------------------------------
function afficherChampObligatoire(champ,nb){
			$(champ).css('border-color','red');
			var finElement = $('<div id="error"><img src="./images/error.svg"><p>Attention certains champs sont obligatoires</p></div>');
			if(nb <1){
			$('.button-section').before(finElement);
		}

}
//------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------VERIFIER CHAMP OBLIGATOIRE PERSONNE---------------------------------------------------
function verifierChampObligatoirePersonne() {

var erreur=false;

	if($('#nom').val()==""){
		afficherChampObligatoire('#nom',erreurs.erreurArtiste);erreurs.erreurArtiste++;erreur=true;}
	if($('#tel').val()==""){
			afficherChampObligatoire('#tel',erreurs.erreurArtiste);erreurs.erreurArtiste++;erreur=true;}
	if($('#mail').val()==""){
			afficherChampObligatoire('#mail',erreurs.erreurArtiste);erreurs.erreurArtiste++;erreur=true;}

return erreur;
}
//------------------------------------------------------------------------------------------------------------------------
//-------------------------------------------VERIFIER CHAMP OBLIGATOIRE---------------------------------------------------
function verifierChampObligatoire() {
var erreur=verifierChampObligatoirePersonne();

	if($('#prenom').val()==""){
		afficherChampObligatoire('#prenom',erreurs.erreurArtiste);erreurs.erreurArtiste++;erreur=true;}

return erreur;
}
//----------------------------------------------------------------------------------------------------------------------
//-------------------------------------------INITIALISER LA VARIABLE DATA---------------------------------------------------
function InitialiserData() {

	var data =	'nom=' + $('#nom').val() +
							'&prenom=' + $('#prenom').val() +
							'&tel=' + $('#tel').val() +
							'&mail=' + $('#mail').val();
//alert($('.formulaire').attr('idp'));
	if($('.formulaire').attr('idp')!=null) data=data+'&idp=' +$('.formulaire').attr('idp');
	if($('#adresse').val()!=""){ data=data+'&adresse=' + $('#adresse').val();}/*else{data=data+'&adresse='+null;}*/
	if($('#ville').val()!="")  data=data+'&ville=' + $('#ville').val();/*else{data=data+'&ville='+null;}*/
	if($('#siteWeb').val()!="") data=data+'&siteWeb=' + $('#siteWeb').val();/*else{data=data+'&siteWeb=='+null;}*/

	return data;
}
//----------------------------------------------------------------------------------------------------------------------
//-------------------------------------------ENREGISTRER UN EVENEMENT---------------------------------------------------

function enregistrerEvenement() {

				if($('#nom').val()==""){afficherChampObligatoire('#nom',erreurs.erreurEvent);erreurs.erreurEvent++;}
				if(veriferDates()==false && $('#nom').val()!=""){
					var data =	'nom=' + $('#nom').val()+
											'&dateDebut=' + $('#dateDeb').val() +
											'&dateFin=' + $('#dateFin').val();

					if($('#adresse').val()!="") data=data+'&adresse=' + $('#adresse').val();
					if($('#ville').val()!="") data=data+'&ville=' + $('#ville').val();
					if($('#heureDebut').val()!="") data=data+'&heureDebut=' + $('#heureDeb').val();
					if($('#heureFin').val()!="") data=data+'&heureFin=' + $('#heureFin').val();


					// TABLEAU LISTE ORGANISATEURS SELECTIONNER
							if($('#selectOrganisateur').val()!=null){
								var organisateurs="";
								$('#selectOrganisateur option').each(function() {
									 if ($(this).is(':selected')) {
											if(organisateurs ==""){organisateurs=$(this).attr("idp");}
											 else{organisateurs= organisateurs+","+$(this).attr("idp");}
									}
							 });
						 data=data+'&organisateurs=' + '["'+organisateurs+'"]';
							}

					// TABLEAU LISTE CONTACTS SELECTIONNER
			/*						if($('#listeContact').val()!=null){
										var contacts="";
										$('#listeContact option').each(function() {
											 if ($(this).is(':selected')) {
													if(contacts ==""){contacts=$(this).attr("idp");}
													 else{contacts= contacts+","+$(this).attr("idp");}
											}
									 });
								 data=data+'&autresContact=' + '["'+contacts+'"]';
							 }*/
	// TABLEAU LISTE GROUPES SELECTIONNER

							if(nbGroupeEvenement!=0){
								var groupes="";
								for(var i=1;i<=nbGroupeEvenement;i++){
									if($('#selectGroupe'+i).val()!=null){
												if ($('#selectGroupe'+i+' option').is(':selected')) {
													 if(groupes ==""){groupes='"'+$('#selectGroupe'+i+' option').attr('idp')+'":"'+$('#heureG'+i).val()+'"';}
														else{groupes= groupes+',"'+$('#selectGroupe'+i+' option').attr('idp')+'":"'+$('#heureG'+i).val()+'"';}
											 }
									}
								 }
								 data=data+'&groupes=' + '{'+groupes+'}';
								}

		//		alert(data);
				$.ajax({	type: "POST",
					url: "ajax/saveEvenement.php",
					data: data, // On passe les informations saisies � l'�cran
					success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
						if (result.status == 'success') {
								alert('erreur lors de l\'enregistrement');
						}
					},
					error: function() {
						alert('Erreur dans la requ�te au serveur.');
					}
			 });}
}

//--------------------------------------------------------------------------------------------------------------------
//-------------------------------------------ENREGISTRER UN ARTISTE---------------------------------------------------

function enregistrerArtiste() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
				if(verifierChampObligatoire()==false){
						var data=InitialiserData();

						if($('#roles').val()!=null){
						   var roles="";
						   $('#roles option').each(function() {
							   	if ($(this).is(':selected')) {
										 if(roles ==""){roles=$(this).val();}
									  	else{roles= roles+","+$(this).val();}
								  }
					  	});
						data=data+'&roles=' + '["'+roles+'"]';
					  }

						if(autreChamp.nbRole!=1){

							var newRoles="";
							for(var i=1;i<autreChamp.nbRole;i++){
								if(newRoles ==""){newRoles=$('#autreRole'+i).val();}
								else{newRoles= newRoles+","+$('#autreRole'+i).val();}
							}

							data=data+'&newRoles=' + '["'+newRoles+'"]';
						}

				//		alert(data);

				$.ajax({	type: "POST",
						url: "ajax/saveArtiste.php",
						data: data, // On passe les informations saisies � l'�cran
						success: function(data, textStatus, jqXHR) {
							var result = JSON.parse(data) ;
							if (result.status == 'success') {
						  		alert('L\'enregistrement de l\'artiste a été effectué');
									$('#content').load('pages/afficherArtiste.html',function(){afficherArtiste(result.idp)});
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
//--------------------------------------------------------------------------------------------------------------------
//-------------------------------------------ENREGISTRER UN CONTACT---------------------------------------------------
function enregistrerContact() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
		if(verifierChampObligatoire()==false){
				var data=InitialiserData();

					if($('#types').val()!=null){
						 var types="";
					   $('#types option').each(function() {
    						if ($(this).is(':selected')) {
										if(types ==""){types=$(this).val();}
										else{types= types+","+$(this).val();}
    						}
					  });
						data=data+'&types=' + '["'+types+'"]';
					}


			if(autreChamp.nbType!=1){

				var newTypes="";
				for(var i=1;i<autreChamp.nbType;i++){
					if(newTypes ==""){newTypes=$('#autreType'+i).val();}
					else{newTypes= newTypes+","+$('#autreType'+i).val();}
				}

				data=data+'&newTypes=' + '["'+newTypes+'"]';
			}
			alert(data);
				$.ajax({	type: "POST",
						url: "ajax/saveAutresContact.php",
						data: data, // On passe les informations saisies � l'�cran
						success: function(data, textStatus, jqXHR) {
							var result = JSON.parse(data) ;
							if (result.status == 'success') {
								alert("sucess");
						  		alert('L\'enregistrement du contact a été effectué');
									alert("le result"+result.types);
									$('#content').load('pages/afficherRep.html',eventMenuRep);
							}
							else {
								alert('erreur lors de l\'enregistrement');
							}
						},
					error: function() {
							alert('Erreur dans la requ�te au serveur.');
					}
			});
	}
}
//-------------------------------------------------------------------------------------------------------------------
//-------------------------------------------ENREGISTRER UN GROUPE---------------------------------------------------
function enregistrerGroupe() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....

	if(verifierChampObligatoirePersonne()==false){
		var data =	'nom=' + $('#nom').val() +
								'&tel=' + $('#tel').val() +
								'&mail=' + $('#mail').val();

    if($('.formulaire').val()!=null) data=data+'&idp=' + $('.formulaire').val();
		if($('#adresse').val()!="") data=data+'&addresse=' + $('#adresse').val();
		if($('#ville').val()!="")   data=data+'&ville=' + $('#ville').val();
		if($('#siteWeb').val()!="") data=data+'&siteWeb=' + $('#siteWeb').val();

// TABLEAU LISTE GENRES SELECTIONNER
  	if($('#genres').val()!=null){
		   var genres="";
		   $('#genres option').each(function() {
			   	if ($(this).is(':selected')) {
						 if(genres ==""){genres=$(this).val();}
					  	else{genres= genres+","+$(this).val();}
				 }
	  	});
		data=data+'&genres=' + '["'+genres+'"]';
	  }
// CREATION D'UN TABLEAU SI D'AUTRE GENRE SON AJOUTER
		if(autreChamp.nbGenre!=1){

			var newGenres="";
			for(var i=1;i<autreChamp.nbGenre;i++){
				if(newGenres ==""){newGenres=$('#autreGenre'+i).val();}
				else{newGenres= newGenres+","+$('#autreGenre'+i).val();}
			}

			data=data+'&newGenres=' + '["'+newGenres+'"]';
		}

		// TABLEAU LISTE CONTACTS SELECTIONNER
				if($('#listeArtiste').val()!=null){
					var artistes="";
					$('#listeArtiste option').each(function() {
						 if ($(this).is(':selected')) {
								if(artistes ==""){artistes=$(this).attr("idp");}
								 else{artistes= artistes+","+$(this).attr("idp");}
						}
				 });
			 data=data+'&artistes=' + '["'+artistes+'"]';
				}

// TABLEAU LISTE CONTACTS SELECTIONNER
		if($('#listeContact').val()!=null){
			var Contacts="";
			$('#listeContact option').each(function() {
				 if ($(this).is(':selected')) {
						if(Contacts ==""){Contacts=$(this).attr("idp");}
						 else{Contacts= Contacts+","+$(this).attr("idp");}
				}
		 });
	 data=data+'&autresContact=' + '["'+Contacts+'"]';
		}

	//	alert(data);
		$.ajax({	type: "POST",
				url: "ajax/saveGroupe.php",
				data: data, // On passe les informations saisies � l'�cran
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						  alert("Le groupe a été ajouté");
							alert("resut"+result.artistes);
					} else {
						alert('erreur lors de l\'enregistrement');
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
		});
	}
}

//-----------------------------------------------------------------------------------------------------------
//-----------------------------------ENREGISTRER UN ORGANISATEUR---------------------------------------------

function enregistrerOrganisateur() {
	// Ici normalement, les contr�les sur les champs requis, les formats, ....
	if(verifierChampObligatoire()==false){
		var data=InitialiserData();
		if($('#nbPlace').val()!="") data=data+'&nbPlaces=' + $('#nbPlace').val();

		$.ajax({	type: "POST",
				url: "ajax/saveOrganisateur.php",
				data: data, // On passe les informations saisies � l'�cran
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						alert("L'organisateur a été ajouté");
						$('#content').load('pages/afficherOrganisateur.html',function(){afficherOrganisateur(result.idp)});
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
//-----------------------------------MODIFIER UN GROUPE-------------------------------------------------
function modifierGroupe(idGroupe){
getListeArtistes();
	$.ajax({	type: "POST",
				url: "ajax/getGroupe.php",
				data: "idp=" + idGroupe, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.groupe) {
							if (result.groupe.nom) $('#nom').val(result.groupe.nom) ;
							if (result.groupe.ville) $('#ville').val(result.groupe.ville) ;
							if (result.groupe.adresse) $('#adresse').val(result.groupe.adresse) ;
							if (result.groupe.tel) $('#tel').val(result.groupe.tel) ;
							if (result.groupe.siteWeb) $('#siteWeb').val(result.groupe.siteWeb) ;
							if (result.groupe.mail) $('#mail').val(result.groupe.mail) ;
							if (result.groupe.idp) $('.formulaire').attr('idp',result.groupe.idp);

							for (var id=0; id < result.groupe.artistes.length; id++) {
								alert(result.groupe.artistes[id].nom);
								$('#listeArtiste option[value='+result.groupe.artistes[id].nom+']').prop(':selected',true);
						}

						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

}
//------------------------------------------------------------------------------------------------------
//-----------------------------------MODIFIER UN ARTISTE------------------------------------------------
function modifierArtiste(idArtiste){
getRoles();
	$.ajax({	type: "POST",
				url: "ajax/getArtiste.php",
				data: "idp=" + idArtiste, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.artiste) {
							if (result.artiste.nom) $('#nom').val(result.artiste.nom) ;
							if (result.artiste.prenom) $('#prenom').val(result.artiste.prenom) ;
							if (result.artiste.mail) $('#mail').val(result.artiste.mail);
							if (result.artiste.tel) $('#tel').val(result.artiste.tel);
							if (result.artiste.adresse) $('#adresse').val(result.artiste.adresse);
							if (result.artiste.ville) $('#ville').val(result.artiste.ville);
							if (result.artiste.siteWeb) $('#siteWeb').val(result.artiste.siteWeb);
							if (result.artiste.idp) $('.formulaire').attr('idp',result.artiste.idp);

							for (var id=0; id < result.artiste.roles.length; id++) {
							$("#roles").val([result.artiste.roles[id]]).prop("selected", true);
						  }
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
//-----------------------------------MODIFIER UN CONTACT------------------------------------------------
function modifierContact(idContact){

	$.ajax({	type: "POST",
				url: "ajax/getContact.php",
				data: "idp=" + idContact, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.contact) {
							if (result.contact.nom) $('#nom').val(result.contact.nom) ;
							if (result.contact.prenom) $('#prenom').val(result.contact.prenom) ;
							if (result.contact.mail) $('#mail').val(result.contact.mail);
							if (result.contact.tel) $('#tel').val(result.contact.tel);
							if (result.contact.adresse) $('#adresse').val(result.contact.adresse);
							if (result.contact.ville) $('#ville').val(result.contact.ville);
							if (result.contact.ville) $('#siteWeb').val(result.contact.siteWeb);
							if (result.contact.idp) $('.formulaire').attr('idp',result.contact.idp);
							evenementFormulaireContact();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

}
//------------------------------------------------------------------------------------------------------
//-----------------------------------MODIFIER UN ORGANISATEUR------------------------------------------------
function modifierOrganisateur(idOrganisateur){

	$.ajax({	type: "POST",
				url: "ajax/getOrganisateur.php",
				data: "idp=" + idOrganisateur, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.organisateur) {
							if (result.organisateur.nom) $('#nom').val(result.organisateur.nom) ;
							if (result.organisateur.prenom) $('#prenom').val(result.organisateur.prenom) ;
							if (result.organisateur.mail) $('#mail').val(result.organisateur.mail);
							if (result.organisateur.tel) $('#tel').val(result.organisateur.tel);
							if (result.organisateur.adresse) $('#adresse').val(result.organisateur.adresse);
							if (result.organisateur.ville) $('#ville').val(result.organisateur.ville);
							if (result.organisateur.siteWeb) $('#siteWeb').val(result.organisateur.siteWeb);
							if (result.organisateur.idp) $('.formulaire').attr('idp',result.organisateur.idp);
							eventFormulaireOrganisateur();
						}
					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});

}

//------------------------------------------------------------------------------------------------------
//-----------------------------------MODIFIER UN EVENEMENT------------------------------------------------
function modifierEvenement(idEvent){

	$.ajax({	type: "POST",
				url: "ajax/getEvenement.php",
				data: "idEvenement=" + idEvent, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
						if (result.evenement) {
							if (result.evenement.nom) $('#nom').val(result.evenement.nom) ;
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

//------------------------------------------------------------------------------------------------------------
//-----------------------------------SUPPRIMER UN ORGANISATEUR------------------------------------------------
function supprimerOrganisateur(idOrganisateur){

	$.ajax({	type: "POST",
				url: "ajax/supprimerOrganisateur.php",
				data: "idp=" + idOrganisateur, // On passe l'id de la personne que l'on veut voir
				success: function(data, textStatus, jqXHR) {
					var result = JSON.parse(data) ;
					if (result.status == 'success') {
							alert("L'organisateur a été supprimé");
							$('#content').load('pages/afficherRep.html',eventMenuRep);

					}
				},
				error: function() {
					alert('Erreur dans la requ�te au serveur.');
				}
	});
}
