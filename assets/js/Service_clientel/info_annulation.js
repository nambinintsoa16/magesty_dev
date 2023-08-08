$(document).ready(function() {
	$('.content').on('click', function (e) {
		e.preventDefault();
		
		let state = $(this).attr('id');
		switch(state) {
			case "general":
				$('#toggle-title0').text("Liste des livraisons annulées");
				$('#toggle-title0').parent().removeClass();
				$('#toggle-title0').parent().addClass("modal-header bg-danger");
			break;
			case "livreur":
				$('#toggle-title0').text("STATISTIQUES de livraisons annulées par LIVREUR");
				$('#toggle-title0').parent().removeClass();
				$('#toggle-title0').parent().addClass("modal-header bg-warning");
			break;
			case "annulation":
				$('#toggle-title0').text("STATISTIQUES de livraisons annulées par code d'annulation ");
				$('#toggle-title0').parent().removeClass();
				$('#toggle-title0').parent().addClass("modal-header bg-info");
			break;
			case "relance":
				$('#toggle-title0').text("Liste des livraisons annulées à relancer");
				$('#toggle-title0').parent().removeClass();
				$('#toggle-title0').parent().addClass("modal-header bg-success");
			break;
		}

	});

	let par = $('.listelivreAnnuleJ');

	$('.jour').on('click', (e) => {
		e.preventDefault();
		let msg = $(".jour").attr('id');
		
		$.post(base_url+"service_clientel/get_info_annulation", {msg:msg}, (data) => {
			par.empty().append(data);
		});
	});
	$('.hebdo').on('click', (e) => {
		e.preventDefault();
		let msg = $(".hebdo").attr('id');
		
		$.post(base_url+"service_clientel/liste_hebdomader", {msg:msg}, (data) => {
			par.empty().append(data);
		});
	});
	$('.men').on('click', (e) => {
		e.preventDefault();
		let msg = $(".men").attr('id');
		
		$.post(base_url+"service_clientel/liste_mensuel", {msg:msg}, (data) => {
			par.empty().append(data);
		});
	});
	$('.sem').on('click', (e) => {
		e.preventDefault();
		let msg = $(".sem").attr('id');
		
		$.post(base_url+"service_clientel/liste_semestriel", {msg:msg}, (data) => {
			par.empty().append(data);
		});
	});
	
});
