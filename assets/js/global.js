$(document).ready(function() {
    $('.login-form').on('submit', function(event) {
        event.preventDefault();
        var matricule = $('.matricule').val();
        var password = $('.password').val();
        $.post(base_url + 'authentification/login', { matricule: matricule, password: password }, function() {
            location.reload();
        });
    });
    $(".dataTable").dataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
    });

    $('.historique').on('click', function(e) {
        e.preventDefault();
        var codeclient = localStorage.getItem("codeclient");
        $.post(base_url + 'Operatrice/client_details', { codeclient: codeclient }, function(data) {
            $.alert({
                title: codeclient,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.historiques').on('click', function(e) {
        e.preventDefault();
        var codeclient = localStorage.getItem("codeclient");
        var type = "Historique de discussions";
        $.post(base_url + 'Operatrice/historique_discu', { codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + ' | ' + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.relance').on('click', function(e) {
        e.preventDefault;
        var codeclient = localStorage.getItem("codeclient");
        var type = "Historique de relances";
        $.post(base_url + 'Operatrice/historique_relance', { codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + ' | ' + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.linkPage').on('click', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.post(base_url + "Accueil/pageUser", { id }, function(data) {

        });


    });
    if (typeof($('.badgeRelance').text()) != undefined) {
        $('.badgeRelance').each(function() {
            let $this = $(this);
            let param = $this.attr('id');
            $.post(base_url + "relance/badgeRelance", { param }, function(data) {
                if ($this.hasClass("badge-success")) {
                    if (data != 0) {
                        $this.addClass('badge-danger');
                        $this.removeClass('badge-success');
                    }
                }
                $this.text(data);

            });
        });
    }



});