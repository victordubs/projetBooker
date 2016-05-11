function evenementContact(){
	$('.option').hide();
	$('#edit').on('click',function() {
		$('.option').toggle();
	});

	$('#modifier').click(function(){
		$('#content').load('pages/formulaireArtiste.html',modifierArtiste($('section').attr('idArtiste')))
	});
} 
