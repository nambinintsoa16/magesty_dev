$(document).ready(function () {
    $('.recherche').on('click', function (e) {
        e.preventDefault();

        var Id_facture = $('.Id_facture').val();
        if (Id_facture == "") {
            swal("erreur", "Id facture obligatoire", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn-danger"
                    }
                },
            });
        } else {
            loding();
            $.post(base_url + 'Administrateur/detail_Modifier_Vente', { idfacture: Id_facture }, function (data) {
                $('.data-cont').empty().append(data);
                stopload();
                modif();
            });
        }
    });



    function loaddata() {
        var Id_facture = $('.Id_facture').val();
        if (Id_facture == "") {
            swal("erreur", "Id facture obligatoire", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn-danger"
                    }
                },
            });
        } else {
            loding();
            $.post(base_url + 'Administrateur/detail_Modifier_Vente', { idfacture: Id_facture }, function (data) {
                $('.data-cont').empty().append(data);
                stopload();
                modif();
            });
        }


    }
    function modif() {
        $('.btn-statut-koty').on('click', function (e) {
            e.preventDefault();
            var statut = $('.statut-koty option:selected').val();
            var idfacture = $('.idfactureId').text();
            loding();
            $.post(base_url + 'Administrateur/modifVenteStatutKoty', { statut: statut, idfacture: idfacture }, function (data, textStatus, xhr) {
                loaddata();
                stopload();
            });
        });

        $(".btn-statut").on('click', function (event) {
            event.preventDefault();
            loding();
            var statut = $('.statut option:selected').val();
            var idfacture = $('.idfactureId').text();
            $.post(base_url + 'Administrateur/modifVenteStatut', { statut: statut, idfacture: idfacture }, function (data, textStatus, xhr) {
                loaddata();
                stopload();
            });
        });

        $('.btn-statut-retrait').on('click', function (e) {
            e.preventDefault();
            var idLivraison = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouveau frais de retrait</p>',
                content: '<input type="text" class="form-control retrait">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let frais = this.$content.find('.retrait').val();
                            $.post(base_url + 'Administrateur/modifFraisLivre', { frais: frais, idLivraison: idLivraison }, function (data, textStatus, xhr) {
                                loaddata();
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });
        });



        $(".modifiDelete").on('click', function (event) {
            event.preventDefault();
            var con = $(this);
            var idVente = con.parent().parent().find('.Id').text();
            $.post(base_url + 'Administrateur/modifVenteDelete', { idVente: idVente }, function (data, textStatus, xhr) {
                loaddata();
            });

        });

        $('.modifrais').on('click', function (e) {
            e.preventDefault();
            var idLivraison = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouveau frais</p>',
                content: '<input type="text" class="form-control frais">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let frais = this.$content.find('.frais').val();
                            $.post(base_url + 'Administrateur/modifFrais', { frais: frais, idLivraison: idLivraison }, function (data, textStatus, xhr) {
                                loaddata();
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });


        });


        $('.modifraisretrait').on('click', function (e) {
            e.preventDefault();
            var idLivraison = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouveau frais_de_retrait</p>',
                content: '<input type="text" class="form-control frais_de_retrait">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let frais_de_retrait = this.$content.find('.frais_de_retrait').val();
                            $.post(base_url + 'Administrateur/modifFraisretrait', { frais_de_retrait: frais_de_retrait, idLivraison: idLivraison }, function (data, textStatus, xhr) {
                                loaddata();
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });


        });
          
        $('.edit_date_livraison').on('click',function(event){
            event.preventDefault();
             var idLivraison = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouvelle date</p>',
                content: '<input type="date" class="form-control date_livre">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let date = this.$content.find('.date_livre').val();
                            $.post(base_url + 'Administrateur/modif_date', { date, idLivraison }, function (data, textStatus, xhr) {
                                loaddata();
                            });
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });

        });

        $('.edit_lieu_livraison').on('click',function(event){
            event.preventDefault();

        $('.quartier').autocomplete({
        source: base_url + "operatrice/autocomplete_quartier",
        appendTo: '.form_vente',
        select: function (e, ui) {
            $('.fade ').modal('hide');
            $.post(base_url + 'operatrice/autocomplete_ville', { quartier: ui.item.value }, function (data) {
                $.confirm({
                    title: 'Choisir ville',
                    content: data,
                    buttons: {
                        formSubmit: {
                            text: 'choisir',
                            btnClass: 'btn-blue',
                            action: function () {
                                var name;
                                this.$content.find('.chose').each(function () {

                                    if ($(this).prop('checked')) {
                                        name = $(this).val();
                                    }

                                });
                                if (!name) {
                                    $.alert('provide a valid name' + name);
                                    return false;
                                }
                                $('#ville').val(name);
                                discrict_chose(name, ui.item.value);
                            }
                        },
                        cancel: {
                            btnClass: 'btn-danger',
                            text: 'Fermer',
                            action: function () {
                                //close
                            }
                        },
                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('.chose').on('click', function (e) {
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });


            }, 'json');
        }

    });


        });

        


        $('.modifiDetail').on('click', function (event) {
            event.preventDefault();
            var con = $(this);
            var idVente = con.parent().parent().find('.Id').text();
            $.confirm({
                title: '<p class="text-center">Que voulez vous modifier?</p>',
                content: '<select class="form-control action"><option>Ajouter</option><option>Produit</option><option>Quantite</option><option>Supprimer</option></select>',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let id = this.$content.find('.action option:selected').val();
                            switch (id) {
                                case "Ajouter":
                                    add(idVente);
                                    break;
                                case "Produit":
                                    produit(idVente);
                                    break;
                                case "Quantite":
                                    quantite(idVente);
                                    break;
                                default:
                                    $.confirm({
                                        title: '<p style="color: red">Attention!</p>',
                                        content: '<p>vous devez choisir une page</p>',
                                        buttons: {
                                            ok: function () {

                                            }
                                        }
                                    });
                            }
                        }
                    },
                    Annuler: {
                        text: 'Annuler',
                        btnClass: 'btn-danger',
                        action: function () {

                        }
                    }
                }
            });

        });

    }
    function produit(idVente) {
        $.confirm({
            title: '<p class="text-center">Entre nouveau code produit</p>',
            content: '<input type="text" class="form-control prodact"  ><script>$(document).ready(function(){$(".prodact").autocomplete({source:base_url+"Administrateur/autocomplete_prodact"});});</script>',
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let produit = this.$content.find('.prodact').val().split('|');
                        $.post(base_url + 'Administrateur/modifVenteProduit', { produit: produit[0], idVente: idVente }, function (data, textStatus, xhr) {
                            loaddata();
                        });
                    }
                },
                Annuler: {
                    text: 'Annuler',
                    btnClass: 'btn-danger',
                    action: function () {

                    }
                }
            }
        });
    }
    function add() {
        var idfacture = $('.idfactureId').text();
        $.confirm({
            title: '<p class="text-center">Entre nouveau code produit</p>',
            content: '<p><input type="text" class="form-control prodact" ></p>' +
                '<p><input type="number" class="form-control quantite" ></p>' +
                '<script>$(document).ready(function(){$(".prodact").autocomplete({source:base_url+"Administrateur/autocomplete_prodact"});});</script>',
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let produit = this.$content.find('.prodact').val().split('|');
                        let quantite = this.$content.find('.quantite').val();
                        $.post(base_url + 'Administrateur/modifVentePadd', { quantite: quantite, produit: produit[0], idfacture: idfacture }, function (data, textStatus, xhr) {
                            loaddata();
                        });
                    }
                },
                Annuler: {
                    text: 'Annuler',
                    btnClass: 'btn-danger',
                    action: function () {

                    }
                }
            }
        });

    }
    function quantite(idVente) {

        $.confirm({
            title: '<p class="text-center">Entre nouveau code produit</p>',
            content: '<input type="number" class="form-control quantite">',
            buttons: {
                formSubmit: {
                    text: 'Confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let Quantite = this.$content.find('.quantite').val();
                        $.post(base_url + 'Administrateur/modifVenteQuantite', { Quantite: Quantite, idVente: idVente }, function (data, textStatus, xhr) {
                            loaddata();
                        });
                    }
                },
                Annuler: {
                    text: 'Annuler',
                    btnClass: 'btn-danger',
                    action: function () {

                    }
                }
            }
        });

    }
    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: green;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });
    }
    function stopload() {
        $('.jconfirm ').remove();

    }





});