$(document).ready(function(){
    $('.ajout_bonus').on('click',function(e){
        e.preventDefault();
        var client=$('.client').val();
        var koty =$('.koty ').val();
        var type =$('.type ').val();
        var raison =$('.raison ').val();
        var observation =$('.observation ').val();
        var date_expir=$('.date_expir').val();
        $.post(base_url+"Administrateur/Ajout_Bonus",{ client:client,koty:koty,type:type,raison:raison,observation:observation,date_expir:date_expir},function(data){
            console.log(data);
        });
     });

    $('.client').autocomplete({
    	source:base_url + "Administrateur/autocomplete_client",
    	select: function (t, ti) {
                t.preventDefault();
                let items = ti.item.label.split('|');
                $('.client').val(items[0]);
               
            }
    });


     
});
