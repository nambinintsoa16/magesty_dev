$(()=>{
    $('.matricule').autocomplete({
        source:base_url + "Administrateur/autocomplete_gestion_pages",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|')
            $('.matricule').val(items[0].trim())
            $('.prenoms').val(items[2].trim())   

        }
    })
    $('.afficher').on('click',function(e){
        e.preventDefault()
        var operatrice = $('.matricule').val();
        var prenoms = $('.prenoms').val();
        const link = base_url + "Administrateur/lisPageFbOperatrice?operatrice=" + operatrice + "&prenoms=" + prenoms;
        console.log(link);
        Table.ajax.url(link);
        Table.ajax.reload()

    })
    $('.modifier').on('click',function(e){
        e.preventDefault()
        var operatrice = $('.matricule').val();
        var prenoms = $('.prenoms').val();
        const link = base_url + "Administrateur/lisPageFbOperatrice?operatrice=" + operatrice + "&prenoms=" + prenoms;
        console.log(link);
        Table.ajax.url(link);
        Table.ajax.reload()

    })
    Table = $('.table_gestion_pages').DataTable({
        processing: true,
        ajax: base_url + 'Administrateur/lisPageFbOperatrice',
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
    })
})