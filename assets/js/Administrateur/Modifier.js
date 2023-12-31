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

        $('.update-page').on('click',function(event){
            event.preventDefault();
            let facture = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouvelle page.</p>',
                content: '<input type="text" class="form-control page_facebook">',
                    onContentReady: function() {
                    $(".page_facebook").autocomplete({
                        source: base_url+"Administrateur/autoCompletePageFacebook",
                        appendTo: ".jconfirm-open",
                    });
                },
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let pageTemp = this.$content.find('.page_facebook').val().split('|');
                            let page = pageTemp[0].trim();
                            $.post(base_url + 'Administrateur/updatePageFacture', { facture,page }, function (data, textStatus, xhr) {
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


       $('.update-observation').on('click',function(event){
            event.preventDefault();
            $('#modaleObservation').modal('show');

       });
       $('.enregistre_observation').on('click',function(event){
            event.preventDefault();
            let remarque = $('.text_remarque').val();
            let facture = $(this).attr('id');
            $.post(base_url + 'Administrateur/updateRemarqueFacture', { facture,remarque }, function (data, textStatus, xhr) {
                $('#modaleObservation').modal('hide');
                loaddata();
            });

       });


        $('.update-operatrice').on('click',function(event){
            event.preventDefault();
            let facture = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouvelle opératrice.</p>',
                content: '<input type="text" class="form-control Oplname">',
                    onContentReady: function() {
                    $(".Oplname").autocomplete({
                        source: base_url+"Administrateur/autocomplete_operatrice",
                        appendTo: ".jconfirm-open",
                    });
                },
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let opelTemp = this.$content.find('.Oplname').val().split('|');
                            let opl = opelTemp[0].trim();
                            $.post(base_url + 'Administrateur/updateOplFacture', { facture,opl }, function (data, textStatus, xhr) {
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

        $('.change_client').on('click',function(event){
            event.preventDefault();
            let facture = $(this).attr('id');
            $.confirm({
                title: '<p class="text-center">Entre nouveau client</p>',
                content: '<input type="text" class="form-control clientname">',
                    onContentReady: function() {
                    $(".clientname").autocomplete({
                        source: base_url+"Administrateur/autocomplete_client",
                        appendTo: ".jconfirm-open",
                    });
                },
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let codeClientTemp = this.$content.find('.clientname').val().split('|');
                            let codeClient = codeClientTemp[0].trim();
                            $.post(base_url + 'Administrateur/updateClientFacture', { facture,codeClient }, function (data, textStatus, xhr) {
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

        $('.update-contact').on('click',function(event){
            event.preventDefault();
            var facture = $('.Id_facture').val();
            $.confirm({
                title: '<p class="text-center">Entre nouvelle contact</p>',
                content: '<input type="text" class="form-control contact">',
                buttons: {
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-success',
                        action: function () {
                            let contact = this.$content.find('.contact').val();
                            $.post(base_url + 'Administrateur/update_contact', { contact, facture }, function (data, textStatus, xhr) {
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
        $('.btn-statut-add-prod').on('click',function(event){
            event.preventDefault();
            add();

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
            $('#modateQuartier').modal("show");
            
        });

        editquartier();


        $('.modifiDetail').on('click', function (event) {
            event.preventDefault();
            var con = $(this);
            var idVente = con.parent().parent().find('.Id').text();
            $.confirm({
                title: '<p class="text-center">Que voulez vous modifier?</p>',
                content: '<select class="form-control action">'+
                '<option>Ajouter</option><option>Produit</option>'+
                '<option>Quantite</option><option>Supprimer</option></select>',
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
            content: '<p><input type="text" class="form-control prodact form-control-sm"></p>'+
            '<p><select class="form-control custum-select form-control-sm" id="localite">'+
                '<option value="1">MISSION</option>'+
                '<option value="2">MISSION SAVA</option>'+
                '<option value="3">MISSION NOSY BE</option>'+
                '<option value="4">FACEBOOK</option>'+
                '<option value="5">LOCAL</option>'+
                '</select></p>',
           onContentReady: function() {
                $(".prodact").autocomplete({
                    source: base_url+"Administrateur/autocomplete_prodact",
                    appendTo: ".jconfirm-open",
                });
            },
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let produit = this.$content.find('.prodact').val().split('|');
                        let localite = this.$content.find('#localite').val();
                        $.post(base_url + 'Administrateur/modifVenteProduit',{ localite:localite,produit: produit[0], idVente: idVente }, function (data, textStatus, xhr) {
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
        var idfacture = $('.idfactureId').text().trim();
        $.confirm({
            title: '<p class="text-center">Entre nouveau code produit</p>',
            content: '<p><input type="text" class="form-control prodact" ></p>' +
                '<p><input type="number" class="form-control quantite" ></p>' +
                '<p><select class="form-control custum-select" id="localite">'+
                '<option value="1">MISSION</option>'+
                '<option value="2">MISSION SAVA</option>'+
                '<option value="3">MISSION NOSY BE</option>'+
                '<option value="4">FACEBOOK</option>'+
                '<option value="5">LOCAL</option>'+
                '</select></p>',
            onContentReady: function() {
                $(".prodact").autocomplete({
                    source: base_url+"Administrateur/autocomplete_prodact",
                    appendTo: ".jconfirm-open",
                });
            },
            buttons: {
                formSubmit: {
                    text: 'confirmer',
                    btnClass: 'btn-success',
                    action: function () {
                        let produit = this.$content.find('.prodact').val().split('|');
                        let quantite = this.$content.find('.quantite').val();
                        let localite = this.$content.find('#localite').val();
                        $.post(base_url + 'Administrateur/modifVentePadd', { localite:localite,quantite: quantite, produit: produit[0], idfacture: idfacture }, function (data, textStatus, xhr) {
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


function editquartier(){
    $('#quartier').autocomplete({
        source: base_url + "operatrice/autocomplete_quartier",
        appendTo: '#modateQuartier',
        select: function (e, ui) {
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
}

function discrict_chose(quartier, ville) {
        $.post(base_url + 'operatrice/autocomplete_discrict', { quartier: quartier, ville: ville }, function (data) {
            $.confirm({
                title: 'Choisir discrict',
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
                            $('#District').val(name);
                            $('.form_vente ').modal('show');
                            $('.RDV').modal('hide');

                        }
                    },
                    cancel: {
                        text: 'Fermer',
                        btnClass: 'btn-danger',
                        action: function () { }
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


        $('.enregistre_quartier').on('click',function(event){
      event.preventDefault();
      let quartier  = $('#quartier').val();
      let ville  = $('#ville').val();
      let District  = $('#District').val();
      let id = $('.idfactureId').text().trim();
      $.post(base_url+'Administrateur/modifQuartier',{quartier,ville,District,id},function(){
         $('#quartier').val("");
         $('#ville').val("");
         $('#District').val("");
         $('#modateQuartier').modal("hide");
            loaddata();
      });

   });

    }

   


});