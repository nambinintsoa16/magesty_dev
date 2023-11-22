$(document).ready(function() {
    autres();
    $('.pageUsers').on('change', function() {
        let page = $('.pageNav').text();
        let pages = $(".pageUsers option:selected").text();
        let pagesArray = pages.split('-');


        if (pagesArray[1].trim() != page.trim()) {
            if (!$(".alert-page").hasClass("bounceInRight")) {
                $('.alert-page').removeClass("alert-success bounce bounceInRight").addClass("alert-danger pulse");
            }
            $('.alert-page').removeClass("alert-success bounce").addClass("alert-danger bounce");
            $('input, select').attr("disabled", "disabled");
            $(this).removeAttr("disabled");

        } else {

            $('.alert-page').removeClass("alert-danger pulse bounceInRight").addClass("alert-success bounce");
            $('input, select').removeAttr("disabled");
        }

        if (pagesArray.length > 3) {
            let pagefb = pagesArray[1] + "-" + pagesArray[2];
            if (pagefb.trim() != page.trim()) {
                if (!$(".alert-page").hasClass("bounceInRight")) {
                    $('.alert-page').removeClass("alert-success bounce bounceInRight").addClass("alert-danger pulse");
                }
                $('.alert-page').removeClass("alert-success bounce").addClass("alert-danger bounce");
                $('input, select').attr("disabled", "disabled");
                $(this).removeAttr("disabled");

            } else {

                $('.alert-page').removeClass("alert-danger pulse bounceInRight").addClass("alert-success bounce");
                $('input, select').removeAttr("disabled");
            }

        }




    });
    $('#liensurfb').on('change', function() {
        var link = $(this).val();
        if (link != "") {
            loding();
            $.post(base_url + 'globale/testLink', { liensurfb: link, type: 'link' }, function(data) {
                if (data.exist == 'true') {
                    stopload();
                    alertMessage('Erreur', 'Ce client existe déjà.', 'error', 'btn btn-danger');
                } else if (data.exist == 'potentiel') {
                    $('#identifient').val(data.nom);
                    $('#liensurfb').val(data.lien_facebook);
                    stopload();
                } else if (data.exist == 'exist') {
                    $('#identifient').val(data.nom);
                    $('#liensurfb').val(data.lien_facebook);
                    //$('#preview').attr('src', data.image);
                    $('.save').addClass('collapse');
                    $('.next').removeClass('collapse');
                    $.post(base_url + "Clients/testImage/", { codeclient: data.Code_client }, function(datas) {
                        if (datas == "true") {
                            $('#preview').attr("src", base_url + "images/client/" + data.Code_client + ".jpg");
                        } else {
                            $('#preview').attr("src", base_url + "images/default_user.png");
                        }
                    }).fail(function() {
                        alertMessage('Erreur', 'Veuillez choisir une photo.', 'error', 'btn btn-danger');

                    });

                    ///---------------- nouveau manda---------------------
                    if (data.commerciale_terain)
                        $("#commerciale_p").val(data.commerciale_terain);
                    if (data.coach)
                        $("#coach_p").val(data.commerciale_terain);
                    localStorage.setItem("codeclient", data.Code_client);
                    stopload();
                    // $.alert('<p class="text-center">Client déjât enregistre</p>');
                } else if (data.exist == 'false') { //btn btn-primary collapse next 
                    //if( $('.next').attr('class')=="btn btn-primary pull-right next"){
                    //if ($('.next').attr('class') == "btn btn-primary next") {

                    $('.save').removeClass('collapse');
                    $('.next').addClass('collapse');
                    //}
                    stopload();
                }
            }, 'json');
        }
    });

    $('.next').on('click', function(event) {
        event.preventDefault();
        loding();
        $('#identifient').val("");
        $('#liensurfb').val("");
        $.post(base_url + 'operatrice/testIfClientPo', { lienFb: $('#liensurfb').val() },
            function(data) {
                 stopload();
                if (data.existe == true) {
                    localStorage.setItem("DISC", "");
                   
                    localStorage.setItem('pageUsers', $('.pageUsers option:selected').val());
                    localStorage.setItem('pagetext', $('.pageUsers option:selected').text());
                    localStorage.setItem('produitUsers', $('.codeproduit').val());
                    localStorage.setItem('tache', $('.select1 option:selected').text());
                    window.location.replace(base_url + 'operatrice/Discussions');
                } else if (data.existe == false) {
                    localStorage.setItem('lienFb', $('#liensurfb').val());
                    $('<form action="' + base_url + 'operatrice/premier_contact" method="post"><input type="hidden" name="lienFb" value="' + $('#liensurfb').val() + '"></input></form>').appendTo('body').submit();
                }
            }, 'json');
    });

    function action() {
        /*$.post(base_url+'operatrice/Autresin',function(data){
                $('.autreinpp').empty().append(data);
                $('.plus_client').modal('toggle');
                
          });*/
        autres();
    }

    function modalShow(option, types) {
        $.post(base_url + "operatrice/testMessages", { option: option, type: types }, function(data) {
            stopload();
            if (data.reponse = "true") {
                $('.plus_client').modal('toggle');
            } else {
                swal('Success', "Enregistrée avec succès", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success"
                        }
                    },
                });
            }
        }, 'json');
    }

    function autres() {
        $('.fermerModale').on('click', function(e) {
            e.preventDefault();
            $('input').val('');
            $('select').prop("selectedIndex", 0);
        });
        $('.btn-test').on('click', function(e) {
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
            var pageUsers = $('.pageUsers option:selected').val();

            if ($('.select2 option:selected').val() == "" || $('.select1 option:selected').val() == "" || $('.codeproduit').val() == "" || $('.nomproduit').val() == "" || $('.pageUsers option:selected').val() == "") {
                initable();
                swal('Erreur', "Une Erreur s'est produit! veuillez recommencer", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger"
                        }
                    },
                });
            } else {
                loding();

                $.post(base_url + 'operatrice/autre_outil', { options: options, option: option, type: type, pageUsers: pageUsers, codepublication: codepublication, codeproduit: codeproduit, nomproduit: nomproduit, date: date, time: time, codegroupe: codegroupe, nomgroupe: nomgroupe, Lien_support: Lien_support }, function() {
                    modalShow(option, type);

                    initable();
                });
            }
        });

        $(".codegroupe").autocomplete({
            source: base_url + "operatrice/autocomplete_codegroupe",
            select: function(t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('.codegroupe').val(items[0]);
                $('.nomgroupe').val(items[1]);
                $('.Lien_support').val(items[2]);
            }
        });

        $(".codeproduit").autocomplete({
            source: base_url + "operatrice/autocomplete_codeproduit",
            select: function(e, ui) {
                e.preventDefault();
                let items = ui.item.label.split('|');
                $('.codeproduit').val(items[0]);
                $('.nomproduit').val(items[1]);
            }
        });


        $(".select1").on('change', function() {
            var codes = $(".select1 option:selected").text();
            var pageUsers = $('.pageUsers option:selected').val();
            var taches = $(".select2 option:selected").text();
            var textCont = $('.pageUsers option:selected').text().split("-");
            var pageText = textCont[1];

            $.post(base_url + 'operatrice/completeTache', { code: codes, taches: taches }, function(data) {
                $('.select2').empty().append(data);
            });


        });

    }
    $('.save').on('click', function(event) {
        event.preventDefault();
        let type = "potentiel";
        let test = $('#preview').attr('src').trim();

        if (test == base_url + "images/default_user.png") {
            alertMessage('Erreur', 'Veuillez choisir une photo.', 'error', 'btn btn-danger');
        } else if ($('#liensurfb').val() == "") {
            alertMessage('Erreur', 'Lien facebook obligatoire.', 'error', 'btn btn-danger');
        } else if ($('#identifient').val() == "") {
            alertMessage('Erreur', 'ID facebook obligatoire.', 'error', 'btn btn-danger');
        } else {
            loding();
            $.post(base_url + 'operatrice/nouveau_codeClient', { type: type }, function(data) {
                uploadImage(data, $('#liensurfb').val());
            }, 'json');
        }

    });
    $(".coach").autocomplete({
        source: base_url + "operatrice/autocomplete_coach/",
        appendTo: ".plus_client"
    });

    $(".commerciale").autocomplete({
        source: base_url + "operatrice/autocomplete_commerciele/",
        appendTo: ".plus_client"
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

    function saveDetail(codeClient) {
        let liensurfb = $('#liensurfb').val();
        let identifient = $('#identifient').val();
        let coach_temp = $('.coach').val();
        let commerciale_temp = $('.commerciale ').val();
        localStorage.setItem('pageUsers', $('.pageUsers option:selected').val());
        localStorage.setItem('pagetext', $('.pageUsers option:selected').text());
        localStorage.setItem('produitUsers', $('.codeproduit').val());
        localStorage.setItem('tache', $('.select1 option:selected').text());

        if ($('.commerciale').val() != "") {
            if ($('.coach').val() == "") {
                alertMessage('Erreur', 'Coach obligatoire.', 'error', 'btn btn-danger');
            } else {

                let coach = coach_temp.split('|');
                let commerciale = commerciale_temp.split('|');
                $.post(base_url + 'operatrice/save_detail', { liensurfb: liensurfb, identifient: identifient, codeclient: codeClient, coach: coach[0], commerciale: commerciale[0] }, function(data) {
                    localStorage.setItem("codeclient", codeClient);
                    localStorage.setItem('type', 'new');
                    window.location.replace(base_url + 'operatrice/premier_contact');
                    //$('.localisations').modal('show');
                });
            }

        } else {
            $.post(base_url + 'operatrice/save_detail', { liensurfb: liensurfb, identifient: identifient, codeclient: codeClient }, function(data) {
                localStorage.setItem("codeclient", codeClient);
                localStorage.setItem('type', 'new');
                window.location.replace(base_url + 'operatrice/premier_contact');


            });
        }
    }

    function uploadImage(codeClient, lienfb) {
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
            success: function(data) {
                localStorage.setItem('lienFb', $('#liensurfb').val());
                saveDetail(codeClient);
            },

            error: function(resultat, statut, erreur) {
                localStorage.setItem('lienFb', $('#liensurfb').val());
                // localStorage.setItem('pagetext', $('#liensurfb').val());
                saveDetail(codeClient);
                window.location.replace(base_url + 'operatrice/premier_contact');

            }


        }, 'json');

    }

    function initable() {
        $.post(base_url + 'operatrice/tableAutre', function(data) {
            if (data.message == true) {
                $('.tabeContect').empty().append(data.content);
                stopload();
            }

        }, 'json');
    }

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

    $('.client').on('click', function(e) {
        e.preventDefault();
        var codeclient = $(this).text();
        $.post(base_url + 'Operatrice/client_details', { codeclient: codeclient }, function(data) {
            $.alert({
                title: codeclient,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                buttons: {
                    fermer: {
                        btnClass: 'btn-red text-center', // multiple classes.

                    },
                }

            });
        });

    });

});