$(document).ready(function () {

    Table = $('.dataTables').DataTable({
        processing: true,
        searching: true,
        paging: true,
        ajax: base_url + "relance/relanceProduit",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "rowCallback": function (row, data) {
            $('.valopy').on('click', function (e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                let produits = parent.children().eq(4).text();
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("produitUsers", produits);
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans  achat");
                localStorage.setItem('tache', "RELANCE PRODUIT");
                localStorage.setItem("idRelance", This.attr('id'));
                window.open(base_url + 'operatrice/Discussions');
            });
        },
        "drawCallback": function (settings) {
            $('.valopy').on('click', function (e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                let produits = parent.children().eq(4).text();
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("produitUsers", produits);
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans  achat");
                localStorage.setItem('tache', "RELANCE PRODUIT");
                localStorage.setItem("idRelance", This.attr('id'));
                window.open(base_url + 'operatrice/Discussions');
            });
        },
        initComplete: function (settings, json) {
            $('.valopy').on('click', function (e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                let produits = parent.children().eq(4).text();
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("produitUsers", produits);
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans  achat");
                localStorage.setItem('tache', "RELANCE PRODUIT");
                localStorage.setItem("idRelance", This.attr('id'));
                window.open(base_url + 'operatrice/Discussions');
            });
        }
    });

});
