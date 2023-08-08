$(document).ready(function(){
    $('.ajout_smile').on('click',function(e){
        e.preventDefault();
        var code_client=$('.client').val();
        var smile =$('.smile').val();
        var type =$('.type').val();
        var raison =$('.raison').val();
        var observation =$('.observation ').val();
        var date_expir=$('.date_expir').val();
        var level=$('.level').val();
        $.post(base_url+"Administrateur/insertSmile",{ code_client:code_client,smile:smile,type:type,raison:raison,observation:observation,date_expir:date_expir,level:level},function(data){
            swal("Succes", "Smile enregistrer avec succer", {
                           icon: "success",
                           buttons: {
                               confirm: {
                                   className: "btn-success"
                               }
                           },
                       
                       });
            $('input').val('');
            $('textarea').val('');
        });
    });
});