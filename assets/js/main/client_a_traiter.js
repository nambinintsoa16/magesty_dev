$(document).ready(function() {

    var Table = $(".table_mois").DataTable({
        searching: false,
        processing: true,
        ordering: true,
        paging: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
    });

    $('.jaime').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tablejaime").DataTable({
            processing: true,
            searching: false,
            retrieve: true,
            ordering: true,
            destroy: true,
            ajax: base_url + "operatrice/reaction_jaime",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {

            },
            initComplete: function(setting) {

            }
        });
    });


    $('.AAC07').on('click', function(e) {
        e.preventDefault();
        var Table = $(".tableAAC07").DataTable({
            processing: true,
            searching: false,
            retrieve: true,
            ordering: true,
            ajax: base_url + "operatrice/cientAAC07",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            rowCallback: function(row, data) {

            },
            initComplete: function(setting) {

            }
        });
    });
});