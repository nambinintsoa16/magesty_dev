$(()=>{
    alert()
    $(".Matricule").autocomplete({
        source:base_url +"Administrateur/autoCompletePersonnel",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|')
            $('.vb').val(items[0].trim())
            $('.nom').val(items[1].trim())
        }
    })
    $('#nomPage').autocomplete({
        source:base_url +"Administrateur/autoCompleteNouvellePage",
        select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label.split('|')
            $('.nomPage').val(items[0].trim())
            $('.lienPage').val(items[1].trim())
        }
    })


    $('.saveNewPage').on('click',function(e){
        e.preventDefault();
        var vb = $('.vb').val();
        var nom = $('.nom').val(); 
        var nomPage = $('.nomPage').val();
        var lienPage = $('.lienPage').val();
        var date_activation = $('.date_activation').val();
        
        $.post(base_url+"Administrateur/saveNewPage",{vb:vb,nom:nom,nomPage:nomPage,lienPage:lienPage,date_activation:date_activation},function(data){
            swal("Succes", "Nouvelle Page enregistrer avec succes", {
                icon: "success",
                buttons: {
                    confirm: {
                        className: "btn-success"
                    }
                },
            
            });
            $('input').val('');
        });
    })
});