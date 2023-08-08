$(document).ready(function() {

    $('.valider').on('click', function(event) {
        event.preventDefault();
        let datelivre = $('.datelivre').val();
        let debut = $('.debut').val();
        // let fin=$('.fin').val(); 
        let facture = $('.facture').text();
        let remarque = $('.remarque').val();
        let matrliv = $('.matrisec').val();
        let contactliv = $('.cotactliv').val();
        let lieulirevc = $('.lieulivrsc').val();

        loding();
        $.post(base_url + 'service_clientel/sauvelivraison', { datelivre: datelivre, debut: debut, remarque: remarque, type: 'confirmer', facture: facture, lieulirevc: lieulirevc, matrliv: matrliv, cotactliv: contactliv }, function(data) {
            if (data.message == true) {
                stopload();
                $('.confirmform').addClass('collapse');
                alertMessage("Succé", "Commande confirmée avec succès", "success", "btn-success");
            } else {
                stopload();
                alertMessage("Erreur", "Erreur veuiilez réessaie.", "error", "btn-danger");
            }


        }, 'json');

    });

    $('.Annule').on('click', function(event) {
        event.preventDefault();
        let facture = $('.facture').text();
        let remarque = $('.Remarqueannul').val();
        let code_annulation = $('.annula option:selected').val();
        loding();
        $.post(base_url + 'globale/annulationCommande', { facture: facture, remarque: remarque, code_annulation: code_annulation }, function(data) {
            if (data.message == true) {
                stopload();
                $('.confirmform').addClass('collapse');
                alertMessage("Succé", "Annulée confirmée avec succès", "success", "btn-success");
            } else {
                alertMessage("Erreur", "Erreur veuiilez réessaie.", "error", "btn-danger");
            }
        }, 'json');
    });

    $('.reporte').on('click', function(e) {
        e.preventDefault();
        let date = $('.datelivre').val();
        let debut = $('.debut').val();
        let fin = $('.fin').val();
        let Remarque = $('.remarque').val();
        let facture = $('.facture').text();
        if (date == "") {
            alertMessage("Erreur", "Date non valide", "error", "btn-danger");
        } else if (debut == "") {
            alertMessage("Erreur", "Heure  non valide", "error", "btn-danger");
        } else if (fin == "") {
            alertMessage("Erreur", "Heure  non valide", "error", "btn-danger");
        } else if (Remarque == "") {
            alertMessage("Erreur", "Vous deviez indiquer pourquoi la commande a été reporter.", "error", "btn-danger");
        } else {
            loding();
            $.post($(this).attr('href'), { facture: facture, date: date, fin: fin, Remarque: Remarque }, function(data) {
                if (data.message == true) {
                    stopload();
                    $('.confirmform').addClass('collapse');
                    $('.fade').modal('hide');

                    alertMessage("Succé", "Commande repporter avec succés!", "success", "btn-success");

                } else {
                    stopload();
                    alertMessage("Erreur", "Ooops erreur!", "error", "btn-danger");

                }

            }, 'json');

        }

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

    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: red;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
        $('.jconfirm').remove();

    }


});