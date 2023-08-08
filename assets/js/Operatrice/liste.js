$(document).ready(function(){
    function historique(){
    $('.client0007').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });
    }

    $('.supporttrc014').on('click', function(e) {
        e.preventDefault();
        
        $.post(base_url + 'Operatrice/support_trc014', {  }, function(data) {
            $.alert({
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.supporttrc042').on('click', function(e) {
        e.preventDefault();
        
        $.post(base_url + 'Operatrice/support_trc042', {  }, function(data) {
            $.alert({
                content: data,
                columnClass: 'col-md-12 col-md-offset-8',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });
    });

    $('.promo3').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table3").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/GNPINKJII",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo4').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table_passionlessjia").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/passionlessjia",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo5').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table_vivitecwji").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/vivitecwji",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo6').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table_vivitecwjii").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/vivitecwjii",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo7').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table_VIVTECCJII").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/VIVTECCJII",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo8').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablejia").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/VIVITE_CLEAR_CONFIDENTjia",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });

    $('.promo9').on('click', function(e) {
        e.preventDefault();
        var Table = $(".table_zasynyvoloko").DataTable({
            processing: true,
            searching: true,
            paging:false,
            retrieve: false,
            ordering: true,
            ajax: base_url + "operatrice/zasynyvoloko",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {
                historique();

            },
            initComplete: function(setting) {
                historique();
            }
        });
    });
});