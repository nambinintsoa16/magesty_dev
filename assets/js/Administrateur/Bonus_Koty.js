$(document).ready(function () {

	CKEDITOR.replace( 'observation' );
    $('.ajout_bonus').on('click', function (e) {
        e.preventDefault();
        var client = $('.client').val();
        var koty = $('.koty option:selected').val();
        var type = $('.type ').val();
        var raison = $('.raison ').val();
        var observation = $('.observation ').val();
        var date_expir = $('.date_expir').val();
        $.post(base_url + "Administrateur/Ajout_Bonus", { client: client, koty: koty, type: type, raison: raison, observation: observation, date_expir: date_expir }, function (data) {
            alertMessage('Succes', 'Enregistre avec succé', 'success', 'btn btn-success');
            $('input').val('');
        });
    });

    $('.client').autocomplete({
        source: base_url + "Administrateur/autocomplete_client",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|');
            $('.client').val(items[0].trim());

        }
    });




    $('.afficher_client').on('click', function (e) {
        e.preventDefault();
        var client1 = $('.client1').val();
        var date_expir1 = $('.date_expir1').val();
        $.post(base_url + "Administrateur/Afficher_client", { client1: client1, date_expir1: date_expir1 }, function (data) {
            console.log(data);
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
