$(document).ready(function() {

    Table = $('.table-relanceDisc').DataTable({
        processing: true,

        "rowCallback": function(row, data) {
            $('.valopy').on('click', function(e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                window.open(base_url + 'operatrice/enquette_form?id='+code_client);


            });
            $('.check').on('click', function(e) {
                e.preventDefault();
                let refnum = $(this).attr('id');
                $.post(base_url + 'relance/checkRelanceDiscussion', { refnum }, function() {
                    Table.ajax.reload();
                });

            });
        },

        "drawCallback": function(settings) {
            $('.valopy').on('click', function(e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                window.open(base_url + 'operatrice/enquette_form?id='+code_client);


            });
            $('.check').on('click', function(e) {
                e.preventDefault();
                let refnum = $(this).attr('id');
                $.post(base_url + 'relance/checkRelanceDiscussion', { refnum }, function() {
                    Table.ajax.reload();
                });

            });
        },
        initComplete: function(settings, json) {
            $('.valopy').on('click', function(e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                window.open(base_url + 'operatrice/enquette_form?id='+code_client);
            });
            $('.check').on('click', function(e) {
                e.preventDefault();
                let refnum = $(this).attr('id');
                $.post(base_url + 'relance/checkRelanceDiscussion', { refnum }, function() {
                    Table.ajax.reload();
                });

            });



        },
        autoFill: {
            alwaysAsk: true
        },
        ajax: base_url + "relance/ListeRElasnceDiscussion?type=duJour",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },


    })

    $('.btn-click').on('click', function(e) {

        e.preventDefault();
        var page = $(this).children().find('b').text();

        if (page == "RELANCE DU JOUR") {
            let links = base_url + 'relance/ListeRElasnceDiscussion?type=duJour';
            //$('.headerTable').replaceClass('bg-danger','bg-primary');
            Table.ajax.url(links);
            Table.ajax.reload();

        }
        if (page == "LISTE DES RELANCE DISCUSSION A FAIRE (URGENT)") {
            let links = base_url + 'relance/ListeRElasnceDiscussion?type=nonfait';
            //$('.headerTable').replaceClass('bg-primary','bg-danger');
            Table.ajax.url(links);
            Table.ajax.reload();

        }


    });


});