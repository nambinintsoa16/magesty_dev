$(document).ready(function () {

    Table = $('.table-relanceDisc').DataTable({
        processing: true,

        "rowCallback": function (row, data) {
            $('.valopy').on('click', function (e) {
                e.preventDefault();
                let This = $(this);
                let parent = This.parent().parent();
                let code_client = parent.children().eq(0).text();
                localStorage.setItem("produitUsers", "PRO028");
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans  achat");
                localStorage.setItem('tache', "RELANCE DISCUSSION");
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
                localStorage.setItem("produitUsers", "PRO028");
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans achat");
                localStorage.setItem('tache', "RELANCE DISCUSSION");
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
                localStorage.setItem("produitUsers", "PRO028");
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("pageUsers", This.attr("href"));
                localStorage.setItem("DISC", "");
                localStorage.setItem("typeRelance", "Relance sans achat");
                localStorage.setItem('tache', "RELANCE DISCUSSION");
                localStorage.setItem("idRelance", This.attr('id'));
                window.open(base_url + 'operatrice/Discussions');


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

    $('.btn-click').on('click', function (e) {

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

    /* function chargement(){
         var htmls='<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
         $.dialog({
           "title": "",
           "content": htmls,
           "show": true,
           "modal": true,
           "close": false,
           "closeOnMaskClick": false,
           "closeOnEscape": false,
           "dynamic": false,
           "height": 150,
           "fixedDimensions": true,
         });   
           
           
         }
         
         function closeDialog(){
          $('.jconfirm').remove();
         }*/
    function evenTdiscussion() {
        $('.valopy').on('click', function (e) {
            e.preventDefault();
            let This = $(this);
            let parent = This.parent().parent();
            let code_client = parent.children().eq(0).text();
            $.post(base_url + 'operatrice/new_discussion', { client: code_client }, function (data) {
                localStorage.setItem("codeclient", code_client);
                localStorage.setItem("DISC", data);
                window.open(base_url + 'operatrice/Discussions');

            }, 'json');
        });
    }


});