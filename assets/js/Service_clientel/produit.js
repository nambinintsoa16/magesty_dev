$(document).ready(function () {

	$('#all').on('click', function (e) {
		e.preventDefault();
		let status = $(this).attr('id');
		$('#toggle-title').text("Listes des produits commandées!");
		$('#toggle-title').parent().removeClass();
		$('#toggle-title').parent().addClass("modal-header bg-info");
		$.post(base_url+"/Produit/tabVue", {status:status}, function(data) {
			$('#testAppend').empty().append(data);
			var Table = $('.listing').DataTable({
				searching: true,
        		ordering: true,
        		paging: true,
			 	ajax: base_url+"Produit/productListViaSc?status="+status,
			 	language: {
	           		url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
	       		},
			});
		});
	});

	$('#livre').on('click', function (e) {
		e.preventDefault();
		let status = $(this).attr('id');
		$('#toggle-title').text("Listes des produits livrées!");
		$('#toggle-title').parent().removeClass();
		$('#toggle-title').parent().addClass("modal-header bg-success");
		postPage(status);
	});

	$('#annule').on('click', function (e) {
		e.preventDefault();
		let status = $(this).attr('id');
		$('#toggle-title').text("Listes des produits non livrées!");
		$('#toggle-title').parent().removeClass();
		$('#toggle-title').parent().addClass("modal-header bg-danger");
		postPage(status);
	});

	$('#confirmer').on('click', function (e) {
		e.preventDefault();
		let status = $(this).attr('id');
		$('#toggle-title').text("Listes des produits confirmées!");
		$('#toggle-title').parent().removeClass();
		$('#toggle-title').parent().addClass("modal-header bg-primary");
		postPage(status);
	});

	$('#en_attente').on('click', function (e) {
		e.preventDefault();
		let status = $(this).attr('id');
		$('#toggle-title').text("Listes des produits en attente de confirmation!");
		$('#toggle-title').parent().removeClass();
		$('#toggle-title').parent().addClass("modal-header bg-warning");
		postPage(status);
	});


	/*$('#hygienCor').on('click', function (e) {
		alert();
		e.preventDefault();
		let categorie = $(this).attr('id');
		$('#titleToggle').text("!!!!!!" + categorie);
		let cat;
		if(categorie == "hygienCor"){
			cat = "HYGIENE CORPORELLE";
		}
		postPage('', cat);
	});*/

	productListDetail('#hygienCor', "HYGIENE CORPORELLE");
	productListDetail('#deoparfum', "DEO & PARFUM");
	productListDetail('#soinCap', "SOINS CAPILLAIRE");
	productListDetail('#hygienBuco', "HYGIENE BUCO-DENTAIRE");
	productListDetail('#beaute', "BEAUTE");
	productListDetail('#lessive', "LESSIVE");
	productListDetail('#soinsVis', "SOINS VISAGE");
	productListDetail('#boisson', "BOISSON");
	
	function productListDetail(id, categorie) {
		$(id).on('click', function (e) {
		e.preventDefault();
		$('#titleToggle').text("Listes des produits de la famille " + categorie);
		postPage('', categorie);
	});
	}

	function postPage(status, categorie = null) {
		if(categorie != null){
			$.post(base_url+"/Produit/tabVue2", {categorie:categorie}, function(data) {
				$('#testAppend2').empty().append(data);
				var Table = $('.listing2').DataTable({
					searching: true,
	        		ordering: true,
	        		paging: true,
				 	ajax: base_url+"Produit/productListViaScWithStatus?categorie="+categorie,
				 	language: {
	            		url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
	        		},
				});
			});
		} else {
			$.post(base_url+"/Produit/tabVue", {status:status}, function(data) {
				$('#testAppend').empty().append(data);
				var Table = $('.listing').DataTable({
					searching: true,
	        		ordering: true,
	        		paging: true,
				 	ajax: base_url+"Produit/productListViaSc?status="+status,
				 	language: {
	            		url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
	        		},
				});
			});
		}
	}

});
