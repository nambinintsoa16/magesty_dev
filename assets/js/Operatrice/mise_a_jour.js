$(document).ready(function() {

    $('.clients').autocomplete({
        source: base_url + "CarteGratee/autocomplete_codeproduit",
        select: function(t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|');
            $('.clients').val(items[1].trim());
        }

    });
    $(".affichers").on('click', function(event) {
        event.preventDefault();
        loding();
        var lien = $('#nom_facebook').val();
        if (lien == "") {
            stopload();
            alert("Champ obligatoire");
        } else {
            $.post(base_url + 'CarteGratee/InfoClient_tache', { lien: lien }, function(data) {
                $('#historique').empty().append(data);

                stopload();
            });
        }
    });

     $(".afficher").on('click', function(event) {
        event.preventDefault();
        //loding();
        var lien = $('#nom_facebook').val();
        if (lien == "") {
            stopload();
            alert("Champ obligatoire");
        } else {
            $.post(base_url + 'Operatrice/detailProduit', { lien: lien }, function(data) {
                $('#historique').empty().append(data);

                stopload();
            });
        }
    });

    $(".prise_en_charge").on('click', function(event) {

        /* event.preventDefault();
         loding();
         $.post(base_url + 'Accueil/Viewdiscussion', { codeclient: localStorage.getItem('codeclient') }, function(data) {
                 $('#historique').empty().append(data);
                 
                 stopload();
             };*/
    });

    $('#table_id').DataTable();
    $(".previ").on('click', function(event) {
        $.post(base_url + 'Etat_de_vente/PrevisionnelleData', function(data) {
            $('.data').empty().append(data);
        });

    })

    $(".livre").on('click', function(event) {
        $.post(base_url + 'Etat_de_vente/LivreData', function(data) {
            $('.data').empty().append(data);
        });
    })

    $(".annule").on('click', function(event) {
        alert("liste annulé");

    })


    $(".confirme").on('click', function(event) {
        alert("liste confirmé");

    })

    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #ff0090;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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