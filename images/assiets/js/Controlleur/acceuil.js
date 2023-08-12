$(document).ready(function () {
    $('.link').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitsUser', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.linka').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/produitsListe', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.lienn').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var matricule = parent.children().first().text();
        var date = $('.date_collapse').text();
        $.post(base_url + 'controlleur/OPL', { date: date, matricule: matricule }, function (data) {
            $.alert(data);
        });

    });
    $('.nom').on('click', function (e) {
        e.preventDefault();
        var parent = $(this).parent().parent();
        var code_client = parent.children().first().text();
        var date = $('.date_collapse').text();
        //var code1=$('.nom').text();
        $.post(base_url + 'controlleur/NAME', { date: date, code_client: code_client }, function (data) {
            $.alert(data);

        });

    });
});

