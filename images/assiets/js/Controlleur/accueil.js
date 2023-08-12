$(document).ready(function () {

    $('.calen').on('click', function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let parent = $(this).parent().parent();
        let link = $(this).attr('href');
        $.confirm({
            title: 'Confirmer!',
            content: 'Voulez-vous vraiment supprimer?',
            buttons: {
                'Valider': function () {

                    $.post(link, { id: id }, function (data) {
                        if (data.message == true) {
                            parent.remove();
                        }

                    }, 'json');

                },
                'Annuler': function () {
                }
            }
        });


    });
    $('.link').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitUser', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.linka').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitListe', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });



});
