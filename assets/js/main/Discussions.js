$(document).ready(function () {
    alert('coucou');
    Init_produit();
    choixPages();
    $('.code_client_ban').empty().append(localStorage.getItem('codeclient'));
    initialiseNomByCodeClient();
    //initCOmplte();   
    function mettreBouttonAttente() {
        $(".termier").removeAttr('disabled');
        $(".termier").removeClass("collapse");
        $(".asuivre").removeAttr('disabled');
        $(".asuivre").removeClass("collapse");
        $(".nouveauDiscussion").addClass("collapse");

        $(".type_discussion").removeAttr('disabled');
        $(".clientMessage").removeAttr('disabled');
        $(".typeahead").removeAttr('disabled');

        $(".codeProduit").removeAttr('disabled');
        $(".valide_content").removeAttr('disabled');
    }

    function mettreBouttonTermnier() {
        $(".termier").attr('disabled', 'disabled');
        $(".termier").addClass("collapse");
        $(".asuivre").attr('disabled', 'disabled');
        $(".asuivre").addClass("collapse");
        $(".firstcontaact").addClass("collapse");
        $(".nouveauDiscussion").removeClass("collapse");
        $(".type_discussion").attr('disabled', 'disabled');
        $(".clientMessage").attr('disabled', 'disabled');
        $(".typeahead").attr('disabled', 'disabled');
        $(".codeProduit").attr('disabled', 'disabled');
        $(".valide_content").attr('disabled', 'disabled');
    }

    function mettreBouttonASuivre() {
        $(".termier").removeAttr('disabled');
        $(".termier").removeClass("collapse");
        $(".asuivre").attr('disabled', 'disabled');
        $(".asuivre").addClass("collapse");
        $(".nouveauDiscussion").addClass("collapse");
        $(".type_discussion").removeAttr('disabled');
        $(".clientMessage").removeAttr('disabled');
        $(".typeahead").removeAttr('disabled');
        $(".codeProduit").removeAttr('disabled');
        $(".valide_content").removeAttr('disabled');
    }

    function afficherStatutDiscussion(afficherStatut, datas) {
        //$('.page').find('option:selected').val();
        if (afficherStatut) {
            $.post(base_url + 'operatrice/getStatutDiscussion', { client: localStorage.getItem("codeclient"), idPage: localStorage.getItem('pageUsers') }, function (data) {
                if (data.type == 'termier') {
                    mettreBouttonTermnier();
                } else if (data.type == 'a suivre') {
                    mettreBouttonASuivre();
                } else {
                    $('.conten-message').append('<div class="col-md-12 text-center" style="float: none;"><span style="background:#fff;padding:2px 5px">En&nbsp;Attente&nbsp;</span></div><hr style="border: 1px solid;color: #39C0ED;margin-top: -10px" width:100%>');
                    mettreBouttonAttente();
                }
            }, 'json');
        }
    }

    function toutVerouiller() {
        $('.pageusers').empty();
        $(".termier").attr('disabled', 'disabled');
        $(".termier").addClass('collapse');

        $(".conclure").attr('disabled', 'disabled');
        $(".conclure").addClass('collapse');

        $(".rendezvous").attr('disabled', 'disabled');
        $(".rendezvous").addClass('collapse');

        $(".asuivre").attr('disabled', 'disabled');
        $(".asuivre").addClass('collapse');

        $(".type_discussion").attr('disabled', 'disabled');
        $(".clientMessage").attr('disabled', 'disabled');
        $(".typeahead").attr('disabled', 'disabled');
        $(".codeProduit").attr('disabled', 'disabled');
        $(".valide_content").attr('disabled', 'disabled');

        $('.firstcontaact').attr('disabled', 'disabled');
        $('.firstcontaact').addClass("collapse");
        $(".nouveauDiscussion").addClass("collapse");
    }

    function verouiller() {
        $(".termier").attr('disabled', 'disabled');
        $(".termier").addClass('collapse');

        $(".conclure").attr('disabled', 'disabled');
        $(".conclure").addClass('collapse');

        $(".rendezvous").attr('disabled', 'disabled');
        $(".rendezvous").addClass('collapse');

        $(".asuivre").attr('disabled', 'disabled');
        $(".asuivre").addClass('collapse');

        $(".type_discussion").attr('disabled', 'disabled');
        $(".clientMessage").attr('disabled', 'disabled');
        $(".typeahead").attr('disabled', 'disabled');
        $(".codeProduit").attr('disabled', 'disabled');
        $(".valide_content").attr('disabled', 'disabled');

        $('.firstcontaact').removeAttr('disabled');
        $('.firstcontaact').removeClass('collapse');
        $(".nouveauDiscussion").addClass("collapse");
    }

    function deverouiller() {
        $(".termier").removeAttr('disabled');
        $(".termier").removeClass('collapse');

        $(".conclure").removeAttr('disabled');
        $(".conclure").removeClass('collapse');

        $(".asuivre").removeAttr('disabled');
        $(".asuivre").removeClass('collapse');


        $(".type_discussion").removeAttr('disabled');
        $(".clientMessage").removeAttr('disabled');
        $(".typeahead").removeAttr('disabled');
        $(".codeProduit").removeAttr('disabled');
        $(".valide_content").removeAttr('disabled');


        $('.firstcontaact').attr('disabled', 'disabled');
        $('.firstcontaact').addClass('collapse');
    }

    function initialiseNomByCodeClient() {
        $.post(base_url + 'operatrice/detail_clients', { codeclient: localStorage.getItem("codeclient") }, function (data) {
            if (data.message === true) {
                $('.nom_client_ban').empty().append(data.content.toUpperCase());
                $('.Client').css('border-top', '7px ridge' + data.color);
            } else { }
        }, 'json');
    }

    function insertNouveauDiscussion(idp) {
        if (idp != "vide") {
            $.post(base_url + 'operatrice/insertNouveauDiscussion', { codeclient: localStorage.getItem("codeclient"), idPage: idp }, function (data) {
                localStorage.removeItem('isNouveau');
                if (data.message == 'insertion content reussit') {
                    localStorage.setItem('DISC', data.idDiscussion);
                    var codeclient = localStorage.getItem('codeclient');
                    //var page = $('.page').find('option:selected').val();
                    let page = localStorage.getItem('pageUsers');
                    reloadContentMessage(codeclient, page);
                }
            }, 'json');
        } else {
            alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');

        }
    }

    function terminer() {
        let page = localStorage.getItem('pageUsers');
        //let page = $('.page').find('option:selected').val();
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let idRep = $('#reponse_client').val();
        let message = 'terminer';

        if (page != "vide") {
            loding();
            $.post(base_url + 'operatrice/sauvemessage', { message: message, Id_zone: Id_zone, id_con: id_con, Type: 'termier', sender: 'OPL', page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function (data) {
                if (data.message == true) {
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    $('#message').val("");
                }
                stopload();
            }, 'json');

        } else {
            alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');
        }
    }

    function asuivre() {
        let page = localStorage.getItem('pageUsers');
        // let page = $('.page').find('option:selected').val();
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let idRep = $('#reponse_client').val();
        let message = 'a suivre';
        let type = 'a suivre';
        if (page != "vide") {
            $.post(base_url + 'operatrice/sauvemessage', { message: message, Id_zone: Id_zone, id_con: id_con, Type: type, sender: 'OPL', page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function (data) {
                if (data.message == true) {
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    $('#message').val("");
                }
            }, 'json');
        } else {
            alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');
        }
    }

    function passerAuneNouvelleDiscussion() {
        let page = localStorage.getItem('pageUsers');
        // let page = $('.page').find('option:selected').val();
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let idRep = $('#reponse_client').val();
        let message = 'NouvelleDiscussion';
        let type = 'NouvelleDiscussion';
        if (page != "vide") {
            loding();
            $.post(base_url + 'operatrice/sauvemessage', { message: message, Id_zone: Id_zone, id_con: id_con, Type: type, sender: 'OPL', page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function (data) {
                if (data.message == true) {
                    //localstorage.setItem('DISC',data.idDisc);
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    $('#message').val("");
                }
                stopload();
            }, 'json');
        } else {
            alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');
        }
    }
    $('.nouveauDiscussion').on('click', function (event) {
        event.preventDefault();
        passerAuneNouvelleDiscussion();
    });

    function reloadContentMessage(idclient, page) {
        if (page != "vide") {
            loding();
            $.post(base_url + 'operatrice/testDiscution', { idclient: idclient, page: page }, function (data) {
                if (data.message === true) {
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    edit_facture();
                    deverouiller();
                } else {
                    $('.conten-message').empty();
                    verouiller();
                    selectPage(page);

                }
                stopload();
            }, 'json').fail(function () {

                alertMessage('Erreur', "Une erreur s'est produite contacter le service informatique.", 'error', 'btn btn-danger');
                stopload();
            });
        } else {
            $('.conten-message').empty();
            toutVerouiller();
            //stopload();
        }
    }


    function messageDeBienvenue(id) {
        if (id != "vide") {
            $.post(base_url + 'operatrice/get_message_bienvenu', { idPage: id }, function (data) {
                $.confirm({
                    title: '<p style="color: #2a5591">Bienvenue<p>',
                    content: '<p>Faly miarahaba anao tongasoa eto amin page</p><p>' + data.Nom_page + '</p>',
                    buttons: {
                        button: {
                            action: function () {

                            },
                            text: 'Fermer',
                            btnClass: 'btn-red'
                        },
                    }
                });
            }, 'json');
        }
    }

    function changerpageclient(image, client) {
        $.post(base_url + 'operatrice/get_liste_page', {}, function (data) {
            var listePage = '<form action="" class="formName"><div class="form-group"><select class="selectPage form-control">';
            listePage += '<option value="null"></option>';
            data.forEach(element => {
                listePage += '<option value="' + element.id + '">' + element.Nom_page + '</option>';
            });
            listePage += '</select></div></form> ';
            $.confirm({
                title: '<p style="color: #2a5591">Bienvenue<p>',
                content: 'Quelle page voulez vous activer?' + listePage,
                buttons: {
                    button: {
                        action: function () {

                        },
                        text: 'Fermer',
                        btnClass: 'btn-red',
                    },
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-blue',
                        action: function () {
                            let id = this.$content.find('.selectPage').val();
                            if (id != "null") {
                                localStorage.setItem('codeclient', client);
                                var codeclient = localStorage.getItem('codeclient');
                                $('.code_client_ban').empty().append(codeclient);
                                initialiseNomByCodeClient();
                                $('.Client').attr("src", image);
                                let bttest = $('.btn-disabled').attr('class');
                                if (bttest == "form-group col-md-12 text-left btn-disabled") {
                                    $('.btn-disabled').addClass('collapse');
                                    $('.btn-init').removeClass('collapse');
                                }

                                //var codeclient=localStorage.getItem('codeclient');
                                reloadContentMessage(codeclient, id);
                                $('.page').val(id);
                                $('.page').removeAttr('disabled');
                                var page_text = $('.page').find('option:selected').text();
                                $('.pageusers').empty().append(page_text);
                            } else {
                                //$.alert(" veuillez choisir une page! ");
                                $.confirm({
                                    title: '<p style="color: red">Attention!</p>',
                                    content: '<p>vous devez choisir une page</p>',
                                    buttons: {
                                        ok: function () {
                                            changerpageclient(image, client);
                                        }
                                    }
                                });

                            }
                        }
                    },

                }
            });
        }, 'json');
    }

    function changerpage() {
        $.post(base_url + 'operatrice/get_liste_page', {}, function (data) {
            var listePage = '<form action="" class="formName"><div class="form-group"><select class="selectPage form-control">';
            listePage += '<option value="null"></option>';
            data.forEach(element => {
                listePage += '<option value="' + element.id + '">' + element.Nom_page + '</option>';
            });
            listePage += '</select></div></form> ';
            stopload();
            $.confirm({
                title: '<p style="color: #2a5591">Bienvenue<p>',
                content: 'Quelle page voulez vous activer?' + listePage,
                buttons: {
                    button: {
                        action: function () {
                            let id = this.$content.find('.selectPage').val();
                            if (id != "null") {
                                codeclient = localStorage.getItem('codeclient');
                                reloadContentMessage(codeclient, id);
                                $('.page').val(id);
                                $('.page').removeAttr('disabled');
                                var page_text = localStorage.getItem('pagetext');
                                //var page_text = $('.page').find('option:selected').text();
                                $('.pageusers').empty().append(page_text);
                            } else {
                                id = '1';
                                codeclient = localStorage.getItem('codeclient');
                                reloadContentMessage(codeclient, id);
                                $('.page').val(id);
                                $('.page').removeAttr('disabled');
                                var page_text = localStorage.getItem('pagetext');
                                //var page_text = $('.page').find('option:selected').text();
                                $('.pageusers').empty().append(page_text);
                            }

                        },
                        text: 'Fermer',
                        btnClass: 'btn-red',
                    },
                    formSubmit: {
                        text: 'confirmer',
                        btnClass: 'btn-blue',
                        action: function () {
                            let id = this.$content.find('.selectPage').val();
                            if (id != "null") {
                                codeclient = localStorage.getItem('codeclient');
                                reloadContentMessage(codeclient, id);
                                $('.page').val(id);
                                $('.page').removeAttr('disabled');
                                var page_text = localStorage.getItem('pagetext');
                                //var page_text = $('.page').find('option:selected').text();
                                $('.pageusers').empty().append(page_text);
                            } else {
                                //$.alert(" veuillez choisir une page! ");
                                $.confirm({
                                    title: '<p style="color: red">Attention!</p>',
                                    content: '<p>vous devez choisir une page</p>',
                                    buttons: {
                                        ok: function () {
                                            changerpage();
                                        }
                                    }
                                });

                            }
                        }
                    },

                }
            });
        }, 'json');
    }

    function selectPage(page) {
        page = localStorage.getItem('pageUsers');
        if (page != "vide") {
            //nomPage = $('.page').find('option:selected').text();
            nomPage = localStorage.getItem('pagetext');
            $.confirm({
                title: '<p style="color: #2a5591">Bonjour<p>',
                content: 'Voulez vous lancer la discussion avec ce client dans la page ' + nomPage,
                buttons: {
                    formSubmit: {
                        text: '<span style="font-size:12px" >lancer la discussion</span>',
                        btnClass: 'btn-blue',
                        action: function () {
                            $.post(base_url + 'operatrice/insertDetailPage', { idPage: page, codeClient: localStorage.getItem('codeclient') }, function (datas) {
                                messageDeBienvenue(datas.idPage)
                                insertNouveauDiscussion(datas.idPage);
                                //var page_text = $('.page').find('option:selected').text();
                                var page_text = localStorage.getItem('pagetext');
                                $('.pageusers').empty().append(page_text);
                                //var codeclient=localStorage.getItem('codeclient');
                                //var page= $('.page').find('option:selected').val();
                                //reloadContentMessage(codeclient,page);
                            }, 'json');
                        }
                    },
                    annuler: {
                        text: '<span style="font-size:12px" >annuler</span>',
                        action: function () {
                            $('.firstcontaact').removeAttr('disabled');
                            $('.firstcontaact').removeClass('collapse');
                        }

                    }
                }
            });
        }
    }

    function choixPages() {
        if ((localStorage.hasOwnProperty('isNouveau')) && (localStorage.getItem('isNouveau'))) {
            $.post(base_url + 'operatrice/insertDetailPage', { idPage: localStorage.getItem('pageUsers'), codeClient: localStorage.getItem('codeclient') }, function (datas) {
                messageDeBienvenue(localStorage.getItem('pageUsers'));
                insertNouveauDiscussion(localStorage.getItem('pageUsers'));
                var page_text = localStorage.getItem('pagetext');
            }, 'json');
        }
    }

    function choixPage() {
        if ((localStorage.hasOwnProperty('isNouveau')) && (localStorage.getItem('isNouveau'))) {
            verouiller();
            $.post(base_url + 'operatrice/get_liste_page', {}, function (data) {

                var listePage = '<form action="" class="formName"><div class="form-group"><select class="selectPage form-control">';
                listePage += '<option value="null"></option>';
                data.forEach(element => {
                    listePage += '<option value="' + element.id + '">' + element.Nom_page + '</option>';
                });
                listePage += '</select></div></form>';
                $.confirm({
                    title: '<p style="color: #2a5591">Bienvenue<p>',
                    content: 'Quelle page voulez vous accctiver?' + listePage,
                    buttons: {
                        formSubmit: {
                            text: 'confirmer',
                            btnClass: 'btn-blue',
                            action: function () {
                                let pageChoisit = this.$content.find('.selectPage').find('option:selected').text();
                                let id = this.$content.find('.selectPage').val();
                                if (id != "null") {
                                    $.post(base_url + 'operatrice/insertDetailPage', { idPage: localStorage.getItem('pageUsers'), codeClient: localStorage.getItem('codeclient') }, function (datas) {
                                        messageDeBienvenue(id);
                                        insertNouveauDiscussion(id);
                                        //codeclient=localStorage.getItem('codeclient');
                                        //reloadContentMessage(codeclient,id);
                                        $('.page').val(id);
                                        $('.page').removeAttr('disabled');
                                        var page_text = localStorage.getItem('pagetext');
                                        //var page_text = $('.page').find('option:selected').text();
                                        $('.pageusers').empty().append(page_text);
                                        choixPage();
                                    }, 'json');
                                } else {
                                    $.confirm({
                                        title: '<p style="color: red">Attention!</p>',
                                        content: '<p>vous devez choisir une page</p>',
                                        buttons: {
                                            ok: function () {
                                                choixPage();
                                            }
                                        }
                                    });
                                }
                            }
                        },
                        Annuler: function () {
                            stopload();
                        }
                    }
                });
            }, 'json');
        } else {
            stopload();
            verouiller();
            // changerpage();
        }
    }

    // choixPage();


    //loadDeb();

    var tabs = function loadDeb() {
        loding();
        //var page_text = $('.page').find('option:selected').text();
        var page_text = localStorage.getItem('pagetext');
        var page = localStorage.getItem('pageUsers');
        var DISC = localStorage.getItem('DISC');
        var codeclient = localStorage.getItem('codeclient');

        $.post(base_url + 'operatrice/test_statut_client', { page: page, DISC: DISC, codeclient: codeclient }, function (data) {
            if (data.message == false) {
                $('.pageusers').empty().append(page_text);
                $('.entetebadge').css('background-color', data.color);

            } else {
                $('.pageusers').empty().append(page_text);
                $('.entetebadge').css('background-color', data.color);
            }
        }, 'json');


        $.post(base_url + 'operatrice/testDiscution', { idclient: codeclient, page: page }, function (data) {

            if (data.message === true) {
                $('.conten-message').empty().append(data.content);
                $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                afficherStatut = true;
                afficherStatutDiscussion(afficherStatut, data);
                edit_facture();
                deverouiller();
            } else {
                $('.conten-message').empty();
                verouiller();
                selectPage(page);
            }
            stopload();
        }, 'json');

    }



    $('.page').on('change', function () {
        var page = $('.page').find('option:selected').val();
        if (page == "vide") {
            $('.conten-message').empty();
            toutVerouiller();
            $('.pageusers').empty();
        } else {
            loding();
            var page_text = localStorage.getItem('pagetext');
            //var page_text = $('.page').find('option:selected').text();
            var DISC = localStorage.getItem('DISC');
            var codeclient = localStorage.getItem('codeclient');

            $.post(base_url + 'operatrice/test_statut_client', { page: page, DISC: DISC, codeclient: codeclient }, function (data) {
                if (data.message == false) {
                    $('.pageusers').empty().append(page_text);
                    $('.entetebadge').css('background-color', data.color);

                } else {
                    $('.pageusers').empty().append(page_text);
                    $('.entetebadge').css('background-color', data.color);
                }
            }, 'json');


            $.post(base_url + 'operatrice/testDiscution', { idclient: codeclient, page: page }, function (data) {

                if (data.message === true) {
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    edit_facture();
                    deverouiller();
                } else {
                    $('.conten-message').empty();
                    verouiller();
                    selectPage(page);
                }
                stopload();
            }, 'json');

        }
        /*}else{
            stopload();
            $('.conten-message').empty();
            toutVerouiller();          
        }*/

    });


    $('.pageusers').empty().append($('.page').find('option:selected').text());

    $('.chercher').on('keyup', function () {
        let chain = $(this).val();

        $.post(base_url + 'operatrice/listeclientss', { client: chain }, function (data) {
            $('.listeclients').empty().append(data.content);
            chargedisc();
        }, 'json');
    });

    $('.firstcontaact').on('click', function (event) {
        event.preventDefault();
        //var page = $('.page').find('option:selected').val();
        var page = localStorage.getItem('pageUsers');
        selectPage(page);

    });

    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 20);
    $('.user').on('click', function () {
        $('.PJ').attr('id', 'OPL');
        if ($('.clientMessage').attr("class") == "form-control clientMessage") {
            $('.clientMessage').addClass('collapse');
            $('#reponse_client').removeClass('collapse');
            $('.right_bull').removeClass('collapse');
            $('.left_bull').addClass('collapse');
            //$('.PJ').attr('id','OPL');   
        }

        $('.clientzoom').css("width", '50px');
        $('.clientzoom').css("height", '50px');
        $('.clientzoom').css("object-fit", 'cover');
        $('.clientzoom').css("border", 'solid 2px #ff4444');
        $('.userzoom').css("width", '100px');
        $('.userzoom').css("height", '85px');
        $('.userzoom').css("object-fit", 'cover');
        $('.userzoom').css("border", 'solid 5px #00C851');
        var tachs = localStorage.getItem('tache');
        /*$('.entetebadge').css("background",  '#e6ee9c');  
         $('.entetebadge').css("color",  '#000');  */
        $.post(base_url + 'operatrice/completeTache', { code: tachs }, function (data) {
            $.confirm({
                title: '<p class="text-center" style="font-size:14px;"><b>MESSAGE DU CLIENT</b></p>',
                content: '<form><select  class="form-control action">' + data + '</select></form>',
                buttons: {
                    button: {
                        action: function () {

                        },
                        text: 'Fermer',
                        btnClass: 'btn-red',
                    },
                    formSubmit: {
                        text: 'valider',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name;
                            name = this.$content.find('.action option:selected').val();
                            var tache = this.$content.find('.action option:selected').text();
                            if (!name) {
                                $.alert('provide a valid name' + name);
                                return false;
                            }
                            $.post(base_url + "operatrice/typeTache", { tache: tache.trim() }, function (data) {
                                if (data.message == "joint") {
                                    $('.PJ').click();
                                }
                            }, 'json');
                            localStorage.setItem("TypeMessage", name);
                            localStorage.setItem("taches", tache);


                        }
                    },

                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });

    });
    $('.Client').on('click', function () {
        $('.PJ').attr('id', 'CLT');
        if ($('#reponse_client').attr("class") == "form-control typeahead ui-autocomplete-input") {
            $('.clientMessage').removeClass('collapse');
            $('#reponse_client').addClass('collapse');
            $('.left_bull').removeClass('collapse');
            $('.right_bull').addClass('collapse');
            //$('.PJ').attr('id','CLT');
        }

        $('.userzoom').css("width", '50px');
        $('.userzoom').css("height", '50px');
        $('.userzoom').css("object-fit", 'cover');
        $('.userzoom').css("border", 'solid 2px #ff4444');
        $('.clientzoom').css("width", '100px');
        $('.clientzoom').css("height", '85px');
        $('.clientzoom').css("border", 'solid 5px #00C851');
        $('.clientzoom').css("object-fit", 'cover');
        /*$('.entetebadge').css("background",  '#33b5e5');
         $('.entetebadge').css("color",  '#000'); */
    });

    function sendMessage(content, date = null, heure = null) {
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let page = localStorage.getItem('pageUsers');
        //var page = $('.page').find('option:selected').val();
        var page_text = localStorage.getItem('pagetext');
        //var page_text = $('.page').find('option:selected').text();
        var codeclient = localStorage.getItem('codeclient');
        var DISC = localStorage.getItem('DISC');
        $.confirm({
            title: '<p class="text-center" style="font-size:14px;"><b>MESSAGE DU CLIENT</b></p>',
            content: '<form><textarea id="input" class="form-control message_contes" rows="10">' + content + '</textarea></form>',
            columnClass: 'col-md-8 col-md-4 col-md-offset-2',
            buttons: {
                button: {
                    action: function () {

                    },
                    text: 'Fermer',
                    btnClass: 'btn-red',
                },
                formSubmit: {
                    text: 'Envoyer',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name;
                        loding();
                        name = this.$content.find('.message_contes').val();
                        if (!name) {
                            $.alert('provide a valid name' + name);
                            return false;
                        }

                        // let type = $('.type_discussion').val();
                        let type = 'message';
                        let tache = localStorage.getItem('taches');
                        let idRep = $('#reponse_client').val();
                        $.post(base_url + 'operatrice/sauvemessage', { tache: tache, message: name, date: date, heure: heure, Id_zone: Id_zone, id_con: id_con, Type: type, sender: $('.PJ').attr('id'), page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function (data) {
                            if (data.message == true) {
                                $('.conten-message').empty().append(data.content);
                                $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);

                                afficherStatut = true;
                                afficherStatutDiscussion(afficherStatut, data);

                                $('#message').val("");
                                $.post(base_url + 'operatrice/test_statut_client', { page: page, DISC: DISC, codeclient: codeclient }, function (data) {
                                    if (data.message == false) {
                                        $('.pageusers').empty().append(page_text);
                                        $('.entetebadge').css('background-color', data.color);
                                        stopload();
                                    } else {
                                        $('.pageusers').empty().append(page_text);
                                        $('.entetebadge').css('background-color', data.color);
                                        stopload();
                                    }
                                }, 'json');

                            } else if (data.message == "refresh") {
                                // localStorage.setItem("codeclient",data.new_id);
                                ////window.location.replace(base_url+'operatrice/Discussions');
                            }
                        }, 'json');

                    }
                },

            },
            onContentReady: function () {
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });



    }



    $('#message').on('change', function () {
        let content = $(this).val();


        /*********************************************************************************************************************/

        swal({
            title: 'Réception du message',
            text: "Veuillez choisir date et heure de réception!",
            type: 'warning',
            buttons: {
                confirm: {
                    text: 'Définir date reception',
                    className: 'btn btn-success'
                },
                cancel: {
                    visible: true,
                    text: "A l'instant",
                    className: 'btn btn-success'
                }
            }
        }).then((Delete) => {
            if (Delete) {
                $.confirm({
                    title: '<p class="text-center" style="font-size:14px;"><b>MESSAGE DU CLIENT</b></p>',
                    content: '<form><p><input type="date" class="form-control date"></p><p><input type="time" class="form-control heure"></p></form>',

                    buttons: {
                        button: {
                            action: function () {

                            },
                            text: 'Annuler',
                            btnClass: 'btn-red',
                        },
                        formSubmit: {
                            text: 'Suivant',
                            btnClass: 'btn-blue',
                            action: function () {
                                var date;
                                date = this.$content.find('.date').val();
                                var heure = this.$content.find('.heure').val();
                                if (!date || !heure) {
                                    $.alert('provide a valid name' + date);
                                    return false;
                                }
                                // let type = $('.type_discussion').val();
                                sendMessage(content, date, heure);
                            }
                        },

                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });


            } else {
                sendMessage(content);
            }
        });




    });













    /********************************************************************************************************************/


    $('.conclure').on('click', function (event) {
        event.preventDefault();
        $('.table_commande .tbody').empty();

        if ($('.mask').attr('class') == 'mask collapse') {
            $('.mask').removeClass('collapse');
            $('.datelivre').parent().removeClass();
            $('.datelivre').parent().addClass('col-lg-3');
            $('.updatedate').parent().addClass('collapse');
            $('.id_facture_collapse').empty();
        }

        $('.form_vente').modal('show');
    });

    $('.rendezvous').on('click', function (event) {
        $('.RDV').modal('show');
    });


    $('.datelivre').on('change', function () {
        let date = $(this).val();
        let now = new Date();
        let ladate = new Date(date);
        let dateDed = new Date(new Date(new Date().setDate(new Date().getDate() + 21)));

        if (ladate.getDay() == 0) {
            alertMessage('Erreur', 'Jour non valide! Pas de livraison le dimanche.', 'error', 'btn btn-danger');
            $(this).val(" ");
        }

    });
    $('.ville').on('focusout', function () {
        let ville = this.value;
        $('.ville').val(ville.toUpperCase());
    });
    $('.zone,.groupe').on('change', function () {
        let groupe = $('.groupe').val();
        let famille = $('.famille').val();
        let zone = $('.zone').val();
        produitname(groupe, famille, zone)
    });
    $('.famille').on('change', function () {
        Init_produit();
    });
    $(".validproduit").on('click', function (event) {
        event.preventDefault();
        let tempPrix = $('.produitname option:selected').val().split('|');
        let tempProduit = $('.produitname option:selected').text().split('|');
        let test = true;
        let table = [];
        //console.log($('.id_facture_collapse').text());
        if (typeof ($('.prod').html()) == 'undefined') {
            if ($('.id_facture_collapse').text() == '') {
                $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0] + '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' + $.trim(tempProduit[0]) + '.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">' + $.trim(tempPrix[0]) + '</th></tr>');
            } else {
                $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0] + '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' + $.trim(tempProduit[0]) + '.jpg"></th><th><button class="btn btn-primary add_produit"><i class="fa fa-plus"></i></button></th><th class="idPrix collapse">' + $.trim(tempPrix[0]) + '</th></tr>');
                addPRoduit();
            }
            $('.total').empty().append(tempPrix[1] + ' MGA');
        } else {
            $('.prod').each(function () {
                table.push($(this).text());
            });
            if ($.inArray(tempProduit[0], table) != -1) {
                alertMessage('Erreur', 'Ce produit existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une une nouvelle produit.', 'error', 'btn btn-danger');

            } else {
                if ($('.id_facture_collapse').text() == '') {
                    $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0] + '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' + $.trim(tempProduit[0]) + '.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">' + $.trim(tempPrix[0]) + '</th></tr>');
                } else {
                    $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0] + '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/' + $.trim(tempProduit[0]) + '.jpg"></th><th><button class="btn btn-primary add_produit"><i class="fa fa-plus"></i></button></th><th class="idPrix collapse">' + $.trim(tempPrix[0]) + '</th></tr>');
                    addPRoduit();
                }
            }
            var sum = 0;
            if (typeof ($('.tot').html()) !== 'undefined') {
                $('.tot').each(function () {
                    sum += parseInt($(this).html());
                });
                $('.total').empty().append(sum + ' MGA');

            }

        }

        fonctiondel();

    });
    $(".qt").on('change', function () {
        let quantite = $(this).val();
        let priproduit = $('.contprix .prix').text();
        let total = quantite * priproduit;
        $('.total .conttotal').empty().append(total + " Ar");
        let table = $(this).parent().parent();
    });
    $(".new_client").on('click', function (event) {
        event.preventDefault();
        $.post(base_url + 'operatrice/Autresin', function (data) {
            $('.autreinpp').empty().append(data);
            $('.plus_client').modal('toggle');
            autres();
        });
    });

    function autres() {
        $('.btn-test').on('click', function (e) {
            e.preventDefault();
            var option = $('.select2 option:selected').val();
            var options = $('.select2 option:selected').text();
            var type = $('.select1 option:selected').val();
            var codepublication = $('.codepublication').val();
            var codeproduit = $('.codeproduit').val();
            var nomproduit = $('.nomproduit').val();
            var date = $('.date ').val();
            var time = $('.time').val();
            var codegroupe = $('.codegroupe').val();
            var nomgroupe = $('.nomgroupe').val();
            var Lien_support = $('.Lien_support').val();
            let pageUsers = localStorage.getItem('pageUsers');
            //var pageUsers = $('.pageUsers option:selected').val();

            if ($('.select2 option:selected').val() == "" || $('.select1 option:selected').val() == "" || $('.codepublication').val() == "" || $('.codeproduit').val() == "" || $('.nomproduit').val() == "" || $('.codegroupe').val() == "" || $('.nomgroupe').val() == "" || $('.Lien_support').val() == "" || $('.pageUsers option:selected').val() == "") {
                initable();
                swal('Erreur', "Une Erreur s'est produit! veuillez recommencer", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger"
                        }
                    },
                });
                stopload();
            } else {
                loding();
                initable();
                $.post(base_url + 'operatrice/autre_outil', { option: option, options: options, type: type, pageUsers: pageUsers, codepublication: codepublication, codeproduit: codeproduit, nomproduit: nomproduit, date: date, time: time, codegroupe: codegroupe, nomgroupe: nomgroupe, Lien_support: Lien_support }, function () {
                    stopload();
                    swal('Success', "Enregistrée avec succès", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success"
                            }
                        },
                    });
                });
            }


        });



        $(".codegroupe").autocomplete({
            source: base_url + "operatrice/autocomplete_codegroupe",
            select: function (t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('.codegroupe').val(items[0]);
                $('.nomgroupe').val(items[1]);
                $('.Lien_support').val(items[2]);
            }
        });

        $(".codeproduit").autocomplete({
            source: base_url + "operatrice/autocomplete_codeproduit",
            select: function (e, ui) {
                e.preventDefault();
                let items = ui.item.label.split('|');
                $('.codeproduit').val(items[0]);
                $('.nomproduit').val(items[1]);
            }
        });


        $(".select1").on('change', function () {
            var codes = $(".select1 option:selected").text();
            var taches = $(".select2 option:selected").text();
            $.post(base_url + 'operatrice/completeTache', { code: codes, taches: taches }, function (data) {
                $('.select2').empty().append(data);
            });

        });

    }

    function initable() {
        $.post(base_url + 'operatrice/tableAutre', function (data) {
            if (data.message == true) {
                $('.tabeContect').empty().append(data.content);
                stopload();
            }

        }, 'json');
    }

    function chargedisc() {

        $(".client_lat").on('click', function () {
            let image = $(this).attr("src");
            let client = $(this).attr("id");
            changerpageclient(image, client);
        });
    }

    $('.termier').on('click', function (event) {
        event.preventDefault();
        $.confirm({
            title: '<p style="color: #2a5591">Confirmation</p>',
            content: '<p>voulez vous terminer cette discussion ?</p>',
            buttons: {
                oui: function () {
                    terminer();
                },
                non: function () {

                }
            }
        });
    });
    $('.asuivre').on('click', function (event) {
        event.preventDefault();
        $.confirm({
            title: '<p style="color: #2a5591">Confirmation</p>',
            content: '<p>voulez vous mettre cette discussion a suivre ?</p>',
            buttons: {
                oui: function () {
                    asuivre();
                },
                non: function () { }
            }
        });

    });

    $('#image').on('change', (e) => {
        let that = e.currentTarget
        if (that.files && that.files[0]) {
            $(that).next('.custom-file-label').html(that.files[0].name)
            let reader = new FileReader()
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(that.files[0])
        }
    });


    $('#liensurfb').on('change', function () {
        var link = $(this).val();
        loding();
        if (link != "") {
            $.post(base_url + 'globale/testLink', { liensurfb: link, type: 'link' }, function (data) {
                if (data.exist == 'true') {
                    stopload();
                    alertMessage('Erreur', 'Ce client existe déjà.', 'error', 'btn btn-danger');
                } else if (data.exist == 'potentiel') {
                    stopload();
                    $('#identifient').val(data.nom);
                    $('#liensurfb').val(data.lien_facebook);
                } else if (data.exist == 'exist') {
                    $('#identifient').val(data.nom);
                    $('#liensurfb').val(data.lien_facebook);
                    $('#preview').attr('src', data.image);
                    $('.save').addClass('collapse');
                    $('.next').removeClass('collapse');
                    localStorage.setItem("codeclient", data.Code_client);
                    stopload();
                    // $.alert('<p class="text-center">Client déjât enregistre</p>');
                } else if (data.exist == 'false') {
                    if ($('.next').attr('class') == "btn btn-primary pull-right next") {
                        $('.save').removeClass('collapse');
                        $('.next').addClass('collapse');
                    }
                    stopload();
                }

            }, 'json');

        }
    });
    $('.save').on('click', function () {
        let type = "potentiel";
        loding();
        $.post(base_url + 'operatrice/nouveau_codeClient', { type: type }, function (data) {
            uploadImage(data);
        }, 'json');
    });
    $('.testPo').on('click', function (event) {
        $.alert('ok');
    });

    $('.next').on('click', function (event) {
        event.preventDefault();
        $.post(base_url + 'operatrice/testIfClientPo', { lienFb: $('#liensurfb').val() }, 'json');
        //var page = $('.page').find('option:selected').val();
        let page = localStorage.getItem('pageUsers');
        $('.Client').attr('src', base_url + "images/client/" + localStorage.getItem('codeclient') + ".jpg");
        //$('.code_client_ban').empty().append(localStorage.getItem('codeclient'));
        if (localStorage.getItem('codeclient').indexOf('CLT') != -1) {
            $('.entetebadge').css('background-color', '#00C851');
        } else if (localStorage.getItem('codeclient').indexOf('CMT') != -1) {
            $('.entetebadge').css('background-color', '#33b5e5');
        } else {
            $('.entetebadge').css('background-color', '#aa66cc');
        }


        $.post(base_url + 'operatrice/testIfClientPo', { lienFb: $('#liensurfb').val() }, 'json');

        //$.alert($('#liensurfb').val());

        $.post(base_url + 'operatrice/testDiscution', { idclient: localStorage.getItem('codeclient'), page: page }, function (data) {
            if (data.message == 'false')
                $.post(base_url + 'operatrice/new_discussion', { client: localStorage.getItem('codeclient') }, function (datas) {
                    localStorage.setItem("DISC", datas);
                    $.post(base_url + 'operatrice/testDiscution', { idclient: localStorage.getItem('codeclient'), page: page }, function (data) {
                        if (data.message === true) {
                            $('.conten-message').empty().append(data.content);
                            $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                            afficherStatut = true;
                            afficherStatutDiscussion(afficherStatut, data);
                            edit_facture();
                        } else {
                            $('.conten-message').empty();
                        }
                    }, 'json');
                }, 'json');
            else if (data.message) {
                localStorage.setItem("DISC", data.id_discussion);
                $.post(base_url + 'operatrice/testDiscution', { idclient: localStorage.getItem('codeclient'), page: page }, function (data) {
                    if (data.message === true) {
                        $('.conten-message').empty().append(data.content);
                        $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                        afficherStatut = true;
                        afficherStatutDiscussion(afficherStatut, data);
                        edit_facture();
                    } else {
                        $('.conten-message').empty();
                    }
                }, 'json');

            }
        }, 'json');
        $('.plus_client').modal('hide');
    });
    $('.valide_content').on('click', function (event) {
        event.preventDefault();
        let reponse_clien = $('#reponse_client').val();
        //let idproduit = $('.codeProduit option:selected').val();
        let idproduit = localStorage.getItem('produitUsers');
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let idRep = $('#reponse_client').val();
        let page = localStorage.getItem('pageUsers');
        //let page = $('.page').find('option:selected').val();
        $.get(base_url + 'operatrice/dataProduitUsers/' + reponse_clien + '/' + idproduit, function (data) {
            var text = 'test';
            if (page != "vide") {
                $.confirm({
                    title: '<p class="text-center" style="font-size:14px;"><b>MESSAGE DU CLIENT</b></p>',
                    content: '<form><textarea id="input" class="form-control message_contes" rows="10">' + data.Content + '</textarea></form>',
                    columnClass: 'col-md-8 col-md-4 col-md-offset-2',
                    buttons: {
                        formSubmit: {
                            text: 'Envoyer',
                            btnClass: 'btn-blue',
                            action: function () {
                                $(".firstcontaact").addClass("collapse");
                                var name;
                                name = this.$content.find('.message_contes').val();
                                if (!name) {
                                    $.alert('provide a valid name' + name);
                                    return false;
                                }

                                let type = "Message";
                                let types = localStorage.getItem('TypeMessage');
                                let tache = localStorage.getItem('taches');
                                //alert();
                                loding();
                                //ici
                                $.post(base_url + 'operatrice/sauvemessages', { tache: tache, types: types, message: name, Id_zone: Id_zone, id_con: id_con, Type: type, sender: $('.PJ').attr('id'), idRep: idRep, page: page, client: localStorage.getItem("codeclient") }, function (data) {
                                    if (data.message == true) {
                                        //localstorage.setItem('DISC',data.idDisc);
                                        $('.conten-message').empty().append(data.content);
                                        $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                                        afficherStatut = true;
                                        afficherStatutDiscussion(afficherStatut, data);
                                        $('#message').val("");
                                    }
                                    stopload();
                                }, 'json');

                            }
                        },
                        cancel: function () {

                        },
                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
            } else {
                alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');
            }
        }, 'json');
    });

    function saveDetail(codeClient) {
        let liensurfb = $('#liensurfb').val();
        let identifient = $('#identifient').val();
        let coach_temp = $('.coach').val();
        let commerciale_temp = $('.commerciale ').val();
        if ($('.commerciale').val() != "") {
            if ($('.coach').val() == "") {
                alertMessage('Erreur', 'Coach obligatoire.', 'error', 'btn btn-danger');
            } else {

                let coach = coach_temp.split('|');
                let commerciale = commerciale_temp.split('|');
                $.post(base_url + 'operatrice/save_detail', { liensurfb: liensurfb, identifient: identifient, codeclient: codeClient, coach: coach[0], commerciale: commerciale[0] }, function (data) {
                    if (data) {
                        localStorage.setItem("codeclient", codeClient);
                        $.post(base_url + 'operatrice/new_discussion', { client: codeClient }, function (data) {
                            localStorage.setItem("DISC", data);
                            window.location.replace(base_url + 'operatrice/Discussions');
                        }, 'json');
                    }
                }, 'json');
            }

        } else {

            $.post(base_url + 'operatrice/save_detail', { liensurfb: liensurfb, identifient: identifient, codeclient: codeClient }, function (data) {
                if (data) {
                    localStorage.setItem("codeclient", codeClient);
                    $.post(base_url + 'operatrice/new_discussion', { client: codeClient }, function (data) {
                        localStorage.setItem("DISC", data);
                        window.location.replace(base_url + 'operatrice/Discussions');
                    }, 'json');
                }

            }, 'json');
        }
    }

    function uploadImage(codeClient) {
        let fd = new FormData();
        let files = $('#image')[0].files[0];
        let data = 'string';
        fd.append('file', files);
        $.ajax({
            url: base_url + 'operatrice/sauveImageClient/' + codeClient,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (data) {
                saveDetail(codeClient);
                stopload();
            },

            error: function (resultat, statut, erreur) {

                saveDetail(codeClient);
                stopload();
            }


        }, 'json');

    }

    function Init_produit() {

        let famille = $('.famille').val();
        $.post(base_url + 'globale/famille', { famille: famille }, function (data) {
            if (data.message == true) {
                $('.groupe').empty().append(data.content);
                var groupe = $('.groupe').val();
                var zone = $('.zone').val();
                produitname(groupe, famille, zone);
            } else {
                alertMessage('Erreur', 'Erreur.', 'error', 'btn btn-danger');
            }
        }, 'json');



        loding();
        $.post(base_url + 'operatrice/listeclients', {}, function (data) {

            $('.listeclients').empty().append(data.content);

            chargedisc();
            stopload();
        }, 'json');

        $.get(base_url + "images/client/" + localStorage.getItem('codeclient') + ".jpg").done(function () {
            $('.Client').attr("src", base_url + "images/client/" + localStorage.getItem('codeclient') + ".jpg");
        }).fail(function () {
            $('.Client').attr("src", base_url + "images/client/default.jpg");
        });




        let pagechose = localStorage.getItem('pageUsers');
        //var pagechose = $('.page').val();

        $.post(base_url + 'operatrice/test_discussion_en_cours', { client: localStorage.getItem('codeclient') }, function (data) {
            if (data.error === false) {
                //
                //$.alert('init produit :'+localStorage.getItem('codeclient'));
                //
                let id_conversation = data.id_discussion;
                $('.Client').attr("id", id_conversation);
                localStorage.setItem("DISC", id_conversation);
                $(".clientMessage").removeAttr("disabled");
                $(".typeahead").removeAttr("disabled");
                $("#reponse_client").removeAttr("disabled");
                $("#CLT").removeAttr("disabled");
                $(".termier").removeAttr("disabled");
                $(".conclure").removeAttr("disabled");
                $(".rendezvous").removeAttr("disabled");
                $(".asuivre").removeAttr("disabled");
                $(".page").removeAttr("disabled");
                $(".type_discussion").removeAttr("disabled");
                $(".codeProduit").removeAttr("disabled");
                $(".firstcontaact").attr('disabled', 'disabled');


                $.post(base_url + 'operatrice/test_statut_client', { page: pagechose, DISC: id_conversation, codeclient: codeclient }, function (data) {
                    if (data.message === false) {
                        $('.pageusers').empty().append(page_text);
                        $('.entetebadge').css('background-color', data.color);
                    } else {
                        $('.pageusers').empty().append(page_text);
                        //$('.code_client_ban').empty().append(data.matricule);
                        //$('.code_client_ban').empty().append(codeclient);
                        $('.entetebadge').css('background-color', data.color);
                    }
                }, 'json');
            } else if (pagechose != "vide") {
                $('.Client').attr("id", '');
                $(".clientMessage").attr('disabled', 'disabled');
                $(".typeahead").attr('disabled', 'disabled');
                $("#reponse_client").attr('disabled', 'disabled');
                $("#CLT").attr('disabled', 'disabled');
                $(".termier").attr('disabled', 'disabled');
                $(".conclure").attr('disabled', 'disabled');
                $(".rendezvous").attr('disabled', 'disabled');
                $(".asuivre").attr('disabled', 'disabled');
                $(".codeProduit").attr('disabled', 'disabled');
                $(".type_discussion").attr('disabled', 'disabled');
                $(".page").attr('disabled', 'disabled');


                $('.firstcontaact').removeAttr('disabled');
                $('.firstcontaact').removeClass('collapse');
                $(".nouveauDiscussion").addClass("collapse");
            } else {
                $('.Client').attr("id", '');
                $(".clientMessage").attr('disabled', 'disabled');
                $(".typeahead").attr('disabled', 'disabled');
                $("#reponse_client").attr('disabled', 'disabled');
                $("#CLT").attr('disabled', 'disabled');
                $(".termier").attr('disabled', 'disabled');
                $(".conclure").attr('disabled', 'disabled');
                $(".rendezvous").attr('disabled', 'disabled');
                $(".asuivre").attr('disabled', 'disabled');
                $(".codeProduit").attr('disabled', 'disabled');
                $(".type_discussion").attr('disabled', 'disabled');
                $(".page").attr('disabled', 'disabled');
                $('.firstcontaact').removeAttr('disabled');
                $('.firstcontaact').removeClass('collapse');
                $(".nouveauDiscussion").addClass("collapse");
            }

        }, 'json');

        $('.image_choise').attr('id', localStorage.getItem('DISC'));
        let page = localStorage.getItem('pageUsers');
        // var page = $('.page').find('option:selected').val();
        var page_text = localStorage.getItem('pagetext');
        //var page_text = $('.page').find('option:selected').text();
        var DISC = localStorage.getItem('DISC');
        var codeclient = localStorage.getItem('codeclient');
        $.post(base_url + 'operatrice/test_statut_client', { page: page, DISC: DISC, codeclient: codeclient }, function (data) {
            if (data.message == false) {
                $('.pageusers').empty().append(page_text);
                $('.entetebadge').css('background-color', data.color);
            } else {
                $('.pageusers').empty().append(page_text);
                //$('.code_client_ban').empty().append(data.matricule);
                $('.entetebadge').css('background-color', data.color);

            }
        }, 'json');





        $.post(base_url + 'operatrice/detail_clients', { codeclient: localStorage.getItem('codeclient') }, function (data) {
            if (data.message == true) {
                //$('.nom_client_ban').empty().append(data.content.toUpperCase());
                // suppr
                //alert(localStorage.getItem('codeclient'));

            }

        }, 'json');

        $.post(base_url + 'operatrice/testDiscution', {
            idclient: localStorage.getItem('codeclient'),
            page: page
        }, function (data) {
            if (data.message === true) {
                $('.conten-message').empty().append(data.content);
                $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                afficherStatut = true;
                afficherStatutDiscussion(afficherStatut, data);
                edit_facture();
                deverouiller();
            } else {
                $('.conten-message').empty();
                verouiller();
            }
        }, 'json');
        $.post(base_url + 'operatrice/detail_clients', { codeclient: localStorage.getItem('codeclient') }, function (data) {
            if (data.message == true) {
                $('.Client').css('border-top', '7px ridge' + data.color);
                if (data.commercial == true) {
                    $('.result_mattr').empty().append(data.code_commercial);
                    $('.ress_sec_oplg').val(data.codevender);
                    $('.ress_sec_oplg').attr('disabled', 'disabled');
                    $('.nature_sc').attr('disabled', 'disabled');
                    //$('.nature_sc').find('option selected');
                }
            }
        }, 'json');


    }
    $('.scrolldown').on('click', function () {
        $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
    });

    function fonctiondel() {
        $('.suppr').on('click', function () {
            $(this).parent().parent().remove();
            totaltab();
        });

        function totaltab() {
            let sum = 0;
            if (typeof ($('.tot').html()) !== 'undefined') {
                $('.tot').each(function () {
                    sum += parseInt($(this).html());
                });
                let aff = $('.total').empty().append(sum + ' MGA');
                return (aff);
            } else {
                $('.total').empty().append('00 MGA');
            }
        }

        $('.Qua').on('change', function () {
            if ($(this).val() < 1) {
                alertMessage('Erreur', 'Le nombre de produit ne doit pas être inférieur a 1.', 'error', 'btn btn-danger');
                $(this).val('1');

            }
            let content = $(this).parent();
            let total = content.next();
            let quantite = $(this).val();
            let prix = content.parent().find('th').eq(2).html();
            let Qt = prix.split(",");
            let number = Qt[0].replace(".", "");
            total.empty().append(parseInt(number) * quantite);
            totaltab();
        });
    }

    function produitname(groupe, famille, zone) {
        $.post(base_url + 'globale/produitname', { groupe: groupe, famille: famille, zone: zone }, function (data) {
            if (data.message == true) {
                $('.produitname').empty().append(data.content);
            } else {
                alertMessage('Erreur', 'Erreur.', 'error', 'btn btn-danger');
            }
        }, 'json');
    }

    function init_lateral_bar(id_discussion) {
        $('.client_lat').each(function () {
            if ($(this).attr('id') == id_discussion) {
                $(this).parent().remove();
            }
        });
    }

    /************************************ Enregistrement vente ****************************************/
    $('.ress_sec_oplg').on('focusout', function () {
        var choix = $('.nature_sc').find('option:selected').text();
        if (choix == '') {
            alertMessage('Erreur', 'Erreur.', 'error', 'btn btn-danger');
        } else {
            $('.result_mattr').empty().append(choix + $(this).val());
        }
    });


    $('.nature_sc').on('change', function () {
        /* var choix = $('.ress_sec_oplg').text();
         if(choix==''){
             $.alert('');
         }else{
            $('.result_mattr').empty().append($(this).text()+choix);  
         }  */
        $('.result_mattr').empty().append('*');
        $('.ress_sec_oplg').val('');
        var choix = $(this).find('option:selected').text();
        if (choix == 'NONE') {
            $('div .ress_sec_oplg').attr('disabled', 'disabled');
            $('.result_mattr').empty().append('NONE');
        } else {
            $('div .ress_sec_oplg').removeAttr('disabled');
        }
    });

    $('.enregistre_commande').on('click', function (event) {
        event.preventDefault();
        let page = localStorage.getItem('pageUsers');
        // var page = $('.page').find('option:selected').val();
        if (page != "vide") {

            var start = new Date();
            var produit = new Array();
            var client = localStorage.getItem('codeclient');
            var date = $('.datelivre').val();
            var Debut = $('.Debut').val();
            var Fin = $('.Fin').val();
            var ville = $('.ville').val();
            var quartier = $('.quartier').val();
            var lieulivre = $('.lieulivre').val();
            var District = $('#District').val();
            var remarque = $('.comment').val();
            var frailivre = $('.frailivre').val();
            var Id_zone = $('.zone').val();
            var contact = $('.contact').val();
            var Id_discussion = $('.image_choise').attr('id');
            let id_con = $('.image_choise').attr("id");
            let id_zone = $('.zone').val();
            let idRep = $('#reponse_client').val();
            let cotactlivre = $('.cotactlivre').val();
            let result_mattr = $('.result_mattr').text();
            let bonus = $('.bonus').is(":checked");;
            var detailcommande = [];

            $('.tbody tr').each(function () {
                detailcommande.push($(this).find('.idPrix').text() + "|" + $(this).find('.quant input').val());
            });

            if (typeof ($('.prod').text()) == undefined) {
                alertMessage('Erreur', 'Veuillez entre au moins une produit.', 'error', 'btn btn-danger');
            } else if (Debut > Fin || Debut == Fin) {
                alertMessage('Erreur', "Tranche d'heure de livraison incorrect,veuiilez entrer tranche d'heure valide.", 'error', 'btn btn-danger');
            } else if (Debut == "") {
                alertMessage('Erreur', "Tranche d'heure de livraison incorrect,veuiilez entrer tranche d'heure valide.", 'error', 'btn btn-danger');
            } else if (Fin == "") {
                alertMessage('Erreur', "Tranche d'heure de livraison incorrect,veuiilez entrer tranche d'heure valide.", 'error', 'btn btn-danger');
            } else if (ville == "") {
                alertMessage('Erreur', "Veuillez remplir tous le champs 'Ville' avant de valider votre transaction.", 'error', 'btn btn-danger');
            } else if (quartier == "") {
                alertMessage('Erreur', "Veuillez remplir tous les champs 'Quartier' avant de valider votre transaction.", 'error', 'btn btn-danger');
            } else if (lieulivre == "") {
                alertMessage('Erreur', "Veuillez remplir tous les champs 'Lieu de livraison'> avant de valider votre transaction.", 'error', 'btn btn-danger');
            } else {
                let idRep = $('#reponse_client').val();
                loding();
                $.post(base_url + 'operatrice/newfacture', function (data) {
                    var fact = data.codefact;
                    $.post(base_url + 'operatrice/sauvemessage', { message: fact, Id_zone: id_zone, id_con: id_con, Type: 'vente', sender: 'OPL', page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function () { });
                    $.post(base_url + 'operatrice/enregistre_commande', { Id_discussion: Id_discussion, contact: contact, fact: fact, Id_zone: Id_zone, date: date, Debut: Debut, Fin: Fin, ville: ville, quartier: quartier, lieu_de_livraison: lieulivre, remarque: remarque, produits: detailcommande, client: client, frailivre: frailivre, District: District, page: page, cotactlivre: cotactlivre, result_mattr: result_mattr,bonus:bonus }, function (datas) {

                        if (datas.message === true) {
                            $.post(base_url + 'operatrice/testDiscution', { idclient: localStorage.getItem('codeclient'), page: page }, function (data) {
                                if (data.message === true) {
                                    $('.conten-message').empty().append(data.content);
                                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                                    afficherStatut = true;
                                    edit_facture();
                                    afficherStatutDiscussion(afficherStatut, data);
                                    $('.fade').modal('hide');
                                    initBon();
                                    stopload();
                                    alertMessage('Succes', 'Commande enregistrée avec succes.', 'success', 'btn btn-succes');

                                } else {
                                    $('.conten-message').empty();
                                    $('.fade').modal('hide');
                                    stopload();
                                    alertMessage('Succes', 'Commande enregistrée avec succes.', 'success', 'btn btn-succes');
                                }
                            }, 'json');
                        } else {
                            $('.fade').modal('hide');
                            stopload();
                            alertMessage('Succes', 'Une erreure ces produis Veuillez recommencer.', 'success', 'btn btn-succes');

                        }
                    }, 'json');

                }, 'json');
            }
        } else {
            alertMessage('Erreur', 'Une erreure ces produis Veuillez recommencer.', 'error', 'btn btn-danger');
        }
    });


    $('.ville').autocomplete({
        source: base_url + "operatrice/autocomplete_ville/"
    });
    $('.ville').on('change', function () {
        $.alert();
    });

    $('.quartier').autocomplete({
        source: base_url + "operatrice/autocomplete_quartier",
        select: function (e, ui) {
            $('.fade ').modal('hide');
            $.post(base_url + 'operatrice/autocomplete_ville', { quartier: ui.item.value }, function (data) {
                $.confirm({
                    title: 'choisir ville',
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
                        cancel: function () {
                            //close
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

    $('.codeProduit').on('change', function () {
        //initCOmplte();
    });
    $('#quartier').on('focus', function () {
        // $(this).val('');
        //  $('#District').val("");
        // $('#ville').val("");
    });

    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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

    function initBon() {
        $('.datelivre').val("");
        $('.Debut').val("");
        $('.Fin').val("");
        $('.ville').val("");
        $('.quartier').val("");
        $('.lieulivre').val("");
        $('#District').val("");
        $('.comment').val("");
        $('.frailivre').val("");
        $('.zone').val("");
        $('.contact').val("");
        $('.cotactlivre').val("");
        $('.result_mattr').text();
        $('.total').empty().append('00 MGA');
    }

    function discrict_chose(quartier, ville) {
        $.post(base_url + 'operatrice/autocomplete_discrict', { quartier: quartier, ville: ville }, function (data) {
            $.confirm({
                title: 'choisir discrict',
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
                    cancel: function () {

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
    //localStorage.getItem("codeclient");


    $('#reponse_client').autocomplete({
        source: function (request, response) {
            let idproduit = localStorage.getItem('produitUsers');
            //var idproduit = $('.codeProduit option:selected').val();
            $.ajax({
                url: base_url + 'operatrice/dataProduitUser/',
                dataType: "json",
                data: {
                    term: request.term,
                    produit: idproduit
                },
                success: function (data) {
                    response(data);
                }
            });


        }
    });

    function initCOmplte() {
        // var idproduit = $('.codeProduit option:selected').val();
        let idproduit = localStorage.getItem('produitUsers');
        var sample_data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: base_url + 'operatrice/dataProduitUser/%QUERY/' + idproduit,
            remote: {
                url: base_url + 'operatrice/dataProduitUser/%QUERY/' + idproduit,
                wildcard: '%QUERY'
            }
        });
        $('#prefetch .typeahead').typeahead(null, {
            hint: true,
            highlight: true,
            minLength: 1,
            type: 'sample_data',
            display: 'CodeDiscussion',
            source: sample_data,
            limit: 10,
            templates: {
                suggestion: Handlebars.compile('<div class="row pt-1" style="background:#e6ee9c;font-size:12px;border-bottom:solid 1px #ddd;width:800px;padding:10px 5px;color:#000;cursor:pointer"><div class="col-md-12 text-left">{{CodeDiscussion}}-{{Content}}</div></div>')
            }
        });
    }

    $('.PJ').on('change', function (event) {
        event.preventDefault();
        loding();
        let fd = new FormData();
        let files = $('.PJ')[0].files[0];
        let sender = $(this).attr('id');
        let data = 'string';
        fd.append('file', files);
        //let page= $(this).find('option:selected').val();
        let page = localStorage.getItem('pageUsers');
        //let page = $('.page').find('option:selected').val();
        let reponse_clien = $('#reponse_client').val();
        let idproduit = $('.codeProduit').val();
        let id_con = $('.image_choise').attr("id");
        let Id_zone = $('.zone').val();
        let message = id_con + new Date().getTime();
        let type = $('.type_discussion').val();
        let idRep = $('#reponse_client').val();
        let tache = localStorage.getItem('taches');
        if (page != "vide") {
            $.post(base_url + 'operatrice/sauvemessage', { tache: tache, message: message, Id_zone: Id_zone, id_con: id_con, Type: 'image', sender: sender, page: page, idRep: idRep, client: localStorage.getItem("codeclient") }, function (data) {
                if (data.message == true) {
                    $('.conten-message').empty().append(data.content);
                    $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 1000);
                    afficherStatut = true;
                    afficherStatutDiscussion(afficherStatut, data);
                    $('#message').val("");

                    $.ajax({
                        url: base_url + 'operatrice/uploadFils/' + message,
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 20);
                            stopload();
                        },

                        error: function (resultat, statut, erreur) {
                            $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 20);
                            stopload();

                        }

                    }, 'json');
                }
            }, 'json');
        } else {
            alertMessage('Erreur', 'veuillez choisir une page.', 'error', 'btn btn-danger');

        }


    });




    function edit_facture() {


        $('div .modify').on('click', function (e) {
            e.preventDefault();
            var id = $(this).children().first().attr('id');

            if ($('#lock').attr('class') == 'fa fa-unlock-alt') {
                $.post(base_url + 'operatrice/dettail_vente_modif', { facture: id }, function (data) {

                    if (data.message == 'true') {
                        $('.mask').addClass('collapse');
                        $('.datelivre').parent().removeClass();
                        $('.datelivre').parent().addClass('col-lg-8');
                        $('.form_vente').modal('show');
                        $('.RDV').modal('show');
                        $('.table_commande .tbody').empty().append(data.content);
                        $('.total').empty().append(data.total);
                        $('.id_facture_collapse').empty().append(data.facture);
                        $('.updatedate').parent().removeClass('collapse');
                        edit_produit();
                    } else {
                        $('.mask').addClass('collapse');
                        $('.form_vente').modal('show');
                        $('.RDV').modal('show');
                    }
                }, 'json');
            }
        });
    }

    function edit_produit() {

        $('.edit_produit').on('click', function (event) {
            event.preventDefault();
            var parent = $(this).parent().parent();
            var quantite = parent.find('.Qua').val();
            var facture = parent.find('.idfacture').text();
            $.post(base_url + 'operatrice/modifquantite', { idvente: facture, quantite: quantite }, function (data) {

            });

        });

        $('.updatedate').on('click', function (event) {
            event.preventDefault();
            var facture = $('.id_facture_collapse').text();
            var date = $('.datelivre').val();
            $.post(base_url + 'operatrice/changedatefacture', { id: facture, date: date }, function (data) { });
        });

        $('.delete_produit').on('click', function (event) {
            event.preventDefault();
            var parent = $(this).parent().parent();
            var facture = parent.find('.idfacture').text();
            $.post(base_url + 'operatrice/annuleproduit', { idvente: facture }, function (data) {

            });
        });


    }

    function addPRoduit() {
        $('.add_produit').on('click', function (event) {
            event.preventDefault();
            var parent = $(this).parent().parent();
            var quantite = parent.find('.Qua').val();
            var idPrix = parent.find('.idPrix').text();
            var facture = $('.id_facture_collapse').text();
            $.post(base_url + 'operatrice/addProduit', { facture: facture, idPrix: idPrix, quantite: quantite }, function (data) {

            });

        });
    }

    $('.saveContact').on('click', function (event) {
        event.preventDefault();
        var daterdv = $('.daterdv').val();
        var heurervd = $('.heurervd').val();
        var contactRvd = $('.contactRvd').val();
        var produitUsers = localStorage.getItem('produitUsers');
        var pageUsers = localStorage.getItem('pageUsers');
        var idDiscussion = localStorage.getItem('DISC');
        var taches = localStorage.getItem('taches');
        var tache = localStorage.getItem('tache');
        var obs = $('.produiRV').val();
        var TypeMessage = localStorage.getItem('TypeMessage');
        var codeclient = localStorage.getItem('codeclient');
        $.post(base_url + 'operatrice/rendezvous', { obs: obs, TypeMessage: TypeMessage, idDiscussion: idDiscussion, taches: taches, tache: tache, codeclient: codeclient, daterdv: daterdv, heurervd: heurervd, contactRvd: contactRvd, produitUsers: produitUsers, pageUsers: pageUsers }, function (data) {
            $('.daterdv').val("");
            $('.heurervd').val("");
            $('.contactRvd').val("");
            $('.RDV').modal('hide');
            $('.conten-message').empty().append(data.content);
            $('.conten-message').animate({ scrollTop: $('.conten-message').get(0).scrollHeight }, 20);
        }, 'json').done(function () {
            alertMessage("Succè!", "Rendez-vous", "success", "btn btn-success");
        }).fail(function () {
            alertMessage("Erreur!", "Ooops!", "error", "btn btn-danger");
        });

    });
    function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn
                }
            },
        });

    }




});