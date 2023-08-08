$(document).ready(function() {
    // produit();
    $('.prise_en_charge').on('click', function(e) {
        e.preventDefault();
        var codeclient = $('.clientkoty').text();
        $.post(base_url + "Tsena_koty/tachekoty", { codeclient: codeclient }, function(data) {
            $('.modalkoty').empty().append(data);
            $('#modaltache').modal('show');
        });

    });
    $('.image-promo').on('click', function(e) {
        e.preventDefault();
        let promo = $(this).attr('id');
        $.post(base_url + "Tsena_koty/DetailPromotion", {
            promo: promo
        }, function(data) {
            $('.formContaint').empty().append(data);
            $('#modalePromo').modal('show');
        });


    });
    $('.majprofil').on('click', function(e) {
        e.preventDefault();
        var codeclient = $('.clientkoty').text();

        $.post(base_url + "Clients/formulaireUpdateProfil", { client: codeclient }, function(data) {
            $('.modalkoty').empty().append(data);
            $('#modaltache').modal('show');
        });
    });


    function produit() {
        $('.produitpromu').on('click', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var codeproduit = parent.children().first().text();
            console.log(codeproduit)
            $.post(base_url + '', { codeproduit: codeproduit }, function(data) {
                //$.alert(data);
            });

        });
    }
});