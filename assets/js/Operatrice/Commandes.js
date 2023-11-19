$(document).ready(function () {
	Init_produit();

	$(".new_client").on("click", function (event) {
		event.preventDefault();
		$(".fade").modal("show");
	});
	function testFacture() {
		var client = localStorage.getItem("codeclient");
		var datas;
		$.ajax({
			url: base_url + "operatrice/testeCommandeUser",
			type: "POST",
			dataType: "JSON",
			success: function (data, statut) {
				datas = "test";
			},

			error: function (resultat, statut, erreur) {
				return data;
			},
		});
		return datas;
	}
	function loding() {
		let data =
			'<div class="d-flex justify-content-center" style="height:50px;width: 50px;margin: auto;"><img src="' +
			base_url +
			'/images/loading.gif"></div>';
		$.confirm({
			title: "",
			content: data,
			cancelButton: false,
			confirmButton: false,
			buttons: { ok: { isHidden: true } },
		});
	}
	function stopload() {
		$(".jconfirm ").remove();
	}

	$(".enregistre_commande").on("click", function (event) {
        console.log('click');
		event.preventDefault();
		loding();

		var clientemps = $(".client").val().split("|");
		var start = new Date();
		var produit = new Array();
		var client = clientemps[0];
		var date = $(".datelivre").val();
		var Debut = $(".Debut").val();
		var Fin = $(".Fin").val();
		var ville = $(".ville").val();
		var quartier = $(".quartier").val();
		var lieulivre = $(".lieulivre").val();
		var District = $("#District").val();
		var remarque = $(".comment").val();
		var frailivre = $(".frailivre").val();
		var Id_zone = $(".zone").val();
		var contact = $(".contact").val();
		var Id_discussion = "TEMPS";
		let id_con = $(".users").text();
		let id_zone = $(".zone").val();
		let idRep = $("#reponse_client").val();
		var detailcommande = [];
		$(".tbody tr").each(function () {
			detailcommande.push(
				$(this).find(".idPrix").text() +
					"|" +
					$(this).find(".quant input").val()
			);
		});
		if (typeof $(".prod").text() == undefined) {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez entre au moins une produit</p>'
			);
		} else if (Debut > Fin || Debut == Fin) {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>'
			);
		} else if (Debut == "") {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>'
			);
		} else if (Fin == "") {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>'
			);
		} else if (ville == "") {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous le champs " <u>Ville</u> " avant de valider votre transaction.</p>'
			);
		} else if (quartier == "") {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous les champs " <u>Quartier</u>" avant de valider votre transaction.</p>'
			);
		} else if (lieulivre == "") {
			$.alert(
				'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous les champs " <u>Lieu de livraison</u>"  avant de valider votre transaction.</p>'
			);
		} else {
			$.post(
				base_url + "operatrice/newfacture",
				{ Id_discussion: Id_discussion },
				function (data) {
					var fact = data.codefact;
					$.post(
						base_url + "operatrice/sauvemessage",
						{
							message: fact,
							Id_zone: id_zone,
							id_con: id_con,
							Type: "vente",
							sender: "OPL",
						},
						function () {}
					);
					$.post(
						base_url + "operatrice/enregistre_commande",
						{
							Id_discussion: Id_discussion,
							contact: contact,
							fact: fact,
							Id_zone: Id_zone,
							date: date,
							Debut: Debut,
							Fin: Fin,
							ville: ville,
							quartier: quartier,
							lieu_de_livraison: lieulivre,
							remarque: remarque,
							produits: detailcommande,
							client: client,
							frailivre: frailivre,
							District: District,
						},
						function (datas) {
							if (datas.message === true) {
								stopload();
							} else {
								stopload();
								$.alert(
									'<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i> &nbsp;Oops! Une erreure s"est produite. Veuillez recommencer</p>'
								);
							}
						},
						"json"
					);
				},
				"json"
			);
		}
	});

	$(".datelivre").on("change", function () {
		/* let date=$(this).val();
     let now = new Date();
     let ladate=new Date(date);
      if(ladate.getDay()==0){
        $.alert('<p class="text-center">Oooh! Jour non valide!!! <br/> Pas de livraison le dimanche.</p>');
        $(this).val(" ");
      }else if (new Date(now) > new Date( date)){
        $.alert('<p class="text-center">Oooh! Jour non valide!!<br/> Date sélectionnée inférieure aux dates du jour.</p>');
         $(this).val(" ");
      }*/
	});

	$(".quartier").autocomplete({
		source: base_url + "operatrice/autocomplete_quartier",
		select: function (e, ui) {
			$(".fade ").modal("hide");
			$.post(
				base_url + "operatrice/autocomplete_ville",
				{ quartier: ui.item.value },
				function (data) {
					$.confirm({
						title: "choisir ville",
						content: data,
						buttons: {
							formSubmit: {
								text: "choisir",
								btnClass: "btn-blue",
								action: function () {
									var name;
									this.$content.find(".chose").each(function () {
										if ($(this).prop("checked")) {
											name = $(this).val();
										}
									});
									if (!name) {
										$.alert("provide a valid name" + name);
										return false;
									}
									$("#ville").val(name);
									discrict_chose(name, ui.item.value);
								},
							},
							cancel: function () {
								//close
							},
						},
						onContentReady: function () {
							var jc = this;
							this.$content.find(".chose").on("click", function (e) {
								e.preventDefault();
								jc.$$formSubmit.trigger("click"); // reference the button and click it
							});
						},
					});
				},
				"json"
			);
		},
	});
	function discrict_chose(quartier, ville) {
		$.post(
			base_url + "operatrice/autocomplete_discrict",
			{ quartier: quartier, ville: ville },
			function (data) {
				$.confirm({
					title: "choisir discrict",
					content: data,
					buttons: {
						formSubmit: {
							text: "choisir",
							btnClass: "btn-blue",
							action: function () {
								var name;
								this.$content.find(".chose").each(function () {
									if ($(this).prop("checked")) {
										name = $(this).val();
									}
								});
								if (!name) {
									$.alert("provide a valid name" + name);
									return false;
								}
								$("#District").val(name);
								$(".form_vente ").modal("show");
							},
						},
						cancel: function () {},
					},
					onContentReady: function () {
						var jc = this;
						this.$content.find(".chose").on("click", function (e) {
							e.preventDefault();
							jc.$$formSubmit.trigger("click"); // reference the button and click it
						});
					},
				});
			},
			"json"
		);
	}

	$(".ville").autocomplete({
		source: base_url + "operatrice/autocomplete_ville/",
	});

	$(".zone,.groupe").on("change", function () {
		let groupe = $(".groupe").val();
		let famille = $(".famille").val();
		let zone = $(".zone").val();
		produitname(groupe, famille, zone);
	});

	$(".famille").on("change", function () {
		Init_produit();
	});

	$(".validproduit").on("click", function (event) {
		event.preventDefault();
		let tempPrix = $(".produitname option:selected").val().split("|");
		let tempProduit = $(".produitname option:selected").text().split("|");
		let test = true;
		let table = [];

		if (typeof $(".prod").html() == "undefined") {
			$(".table_commande>tbody:last").append(
				'<tr><th class="prod">' +
					tempProduit[0] +
					'</th><th class="codeProduit">' +
					tempProduit[1] +
					'</th><th class="prix">' +
					tempPrix[1] +
					'</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' +
					tempPrix[1] +
					'</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' +
					$.trim(tempProduit[0]) +
					'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">' +
					$.trim(tempPrix[0]) +
					"</th></tr>"
			);
			$(".total")
				.empty()
				.append(tempPrix[1] + " MGA");
		} else {
			$(".prod").each(function () {
				table.push($(this).text());
			});
			if ($.inArray(tempProduit[0], table) != -1) {
				$.alert(
					'<p class="text-center">Ce produit existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une une nouvelle produit.</p>'
				);
			} else {
				$(".table_commande>tbody:last").append(
					'<tr><th class="prod">' +
						tempProduit[0] +
						'</th><th class="codeProduit">' +
						tempProduit[1] +
						'</th><th class="prix">' +
						tempPrix[1] +
						'</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' +
						tempPrix[1] +
						'</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' +
						$.trim(tempProduit[0]) +
						'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">' +
						$.trim(tempPrix[0]) +
						"</th></tr>"
				);
			}
			var sum = 0;
			if (typeof $(".tot").html() !== "undefined") {
				$(".tot").each(function () {
					sum += parseInt($(this).html());
				});
				$(".total")
					.empty()
					.append(sum + " MGA");
			}
		}

		fonctiondel();
	});

	$(".qt").on("change", function () {
		let quantite = $(this).val();
		let priproduit = $(".contprix .prix").text();
		let total = quantite * priproduit;
		$(".total .conttotal")
			.empty()
			.append(total + " Ar");
		let table = $(this).parent().parent();
	});

	$("#image").on("change", (e) => {
		let that = e.currentTarget;
		if (that.files && that.files[0]) {
			$(that).next(".custom-file-label").html(that.files[0].name);
			let reader = new FileReader();
			reader.onload = (e) => {
				$("#preview").attr("src", e.target.result);
			};
			reader.readAsDataURL(that.files[0]);
		}
	});

	$("#liensurfb").on("change", function () {
		var link = $(this).val();

		if (link != "") {
			$.post(
				base_url + "globale/testLink",
				{ liensurfb: link, type: "link" },
				function (data) {
					if (data.exist == "true") {
						$.alert('<p class="text-center">Ce client existe déjà</p>');
					} else if (data.exist == "potentiel") {
						$("#Nom").val(data.nom);
						$("#identifient").val(data.nom);
						$("#liensurfb").val(data.lien_facebook);
						$("#Provenance").val(data.Code_client);
						$("#typeClient").val("Potentiel");
					} else if (data.exist == "exist") {
						$(".image")
							.empty()
							.append(
								'<a href="?page=ficheclient&client=' +
									data.Code_client +
									'" Target="_blank"><img style="width:100%;height:100%;" src="' +
									data.image +
									'"></a>'
							);
						$(".contact").empty().append(data.contact);
						$(".client").val(data.Code_client + "|" + data.nom);
						$("#Nom").val("");
						$("#identifient").val("");
						$("#liensurfb").val("");
						$("#Provenance").val("");
						$(".fade").modal("hide");
						$.alert('<p class="text-center">Client déjât enregistre</p>');
					}
				},
				"json"
			);
		}
	});

	function Init_produit() {
		let famille = $(".famille").val();
		$.post(
			base_url + "globale/famille",
			{ famille: famille },
			function (data) {
				if (data.message == true) {
					$(".groupe").empty().append(data.content);
					var groupe = $(".groupe").val();
					var zone = $(".zone").val();
					produitname(groupe, famille, zone);
				} else {
					$.alert(
						'<p class="text-center"><i class="fa fa-warning danger"></i>&nbsp;Erreur</p>'
					);
				}
			},
			"json"
		);
	}
	function fonctiondel() {
		$(".suppr").on("click", function () {
			$(this).parent().parent().remove();
			totaltab();
		});

		function totaltab() {
			let sum = 0;
			if (typeof $(".tot").html() !== "undefined") {
				$(".tot").each(function () {
					sum += parseInt($(this).html());
				});
				let aff = $(".total")
					.empty()
					.append(sum + " MGA");
				return aff;
			} else {
				$(".total").empty().append("00 MGA");
			}
		}

		$(".Qua").on("change", function () {
			if ($(this).val() < 1) {
				$.alert(
					'<p  class="text-center">Le nombre de produit ne doit pas être inférieur a 1</p>'
				);
				$(this).val("1");
			}
			let content = $(this).parent();
			let total = content.next();
			let quantite = $(this).val();
			let prix = content.parent().find("th").eq(2).html();
			let Qt = prix.split(",");
			let number = Qt[0].replace(".", "");
			total.empty().append(parseInt(number) * quantite);
			totaltab();
		});
	}
	function success_insert(idclient) {
		$.get(
			"fonction/image.php",
			{ codeclient: idclient },
			function (data) {
				$(".image")
					.empty()
					.append(
						'<a href="?page=ficheclient&client=' +
							data.idclient +
							'" Target="_blank"><img style="width:100%;height:100%;" src="http://komone-beta.in-expedition.com/images/client/' +
							data.idclient +
							'.jpg"></a>'
					);
				$(".contact").empty().append(data.contact);
				$(".client").val(data.idclient + "|" + data.Nom + " " + data.Prenom);
				$("#typeClient").val("Prospet");
				$("#Provenance").val("----");
				$("#identifient").val("");
				$("#Nom").val("");
				$("#Contact").val("");
				$("#idvp").val("");
				$("#coach").val("");

				$(".fade").modal("hide");
				if (data.Statut == "true") {
					$(".danger").removeClass("collapse");
					$(".ok").addClass("collapse");
				} else if (data.Statut == "false") {
					$(".ok").removeClass("collapse");
					$(".danger").addClass("collapse");
				}
				$("#image").val("");
				$("#liensurfb").val("");
				$("#idvp").val("");
				$("#coach").val("");
				$("#Contact").val("");
			},
			"json"
		);
	}

	function produitname(groupe, famille, zone) {
		$.post(
			base_url + "globale/produitname",
			{ groupe: groupe, famille: famille, zone: zone },
			function (data) {
				if (data.message == true) {
					$(".produitname").empty().append(data.content);
				} else {
					$.alert(
						'<p class="text-center"><i class="fa fa-warning danger"></i>&nbsp;Erreur</p>'
					);
				}
			},
			"json"
		);
	}
});
