$(document).ready(function() {
    $('.AAC007').on('click', function(e) {
        e.preventDefault();
            var Table = $(".aac7nonfait").DataTable({
                processing: true,
                searching: false,
                paging:false,
                retrieve: false,
                ordering: true,
                ajax: base_url + "relance/aac7nonfait",
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                initComplete: function(row, data) {                

            },
        });
    });

    $('.AAC028').on('click', function(e) {
        e.preventDefault();
            var Table = $(".aac28nonfait").DataTable({
                processing: true,
                searching: false,
                paging:false,
                retrieve: false,
                ordering: true,
                ajax: base_url + "relance/aac28nonfait",
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                initComplete: function(row, data) {                

            },
        });
    });

    $('.AAC049').on('click', function(e) {
        e.preventDefault();
            var Table = $(".aac49nonfait").DataTable({
                processing: true,
                searching: false,
                paging:false,
                retrieve: false,
                ordering: true,
                ajax: base_url + "relance/aac7nonfait",
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                },
                initComplete: function(row, data) {                

            },
        });
    });

    $('.CLT007').on('click', function(e){
        e.preventDefault();
        var Table = $(".tableclt007").DataTable({
            processing: true,
            searching: false,
            paging: false,
            ordering: true,
            ajax: base_url + "relance/clt007nontraite",
            language: {
                url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
        });
    });
});