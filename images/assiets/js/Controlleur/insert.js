$(document).ready(function(){
    $('.insert').on('click',function(e){
    e.preventDefault();
        var Code_groupe=$('.Code_groupe').val();
        var Nom_groupe=$('.Nom_groupe').val();
        var Lien_support=$('.Lien_support').val();
        
    $.post(base_url+'controlleur/enregistrer_groupe',{Code_groupe:Code_groupe,Nom_groupe:Nom_groupe,Lien_support:Lien_support},function(){

        $('.Code_groupe').val("");
        $('.Nom_groupe').val("");
        $('.Lien_support').val("");

     
           });

    }); 
}); 
$( ".Code_groupe" ).autocomplete({
    source: base_url+"controlleur/autocomplete_groupe", 
    select:function(t,ti){
        t.preventDefault();
        let items=ti.item.label.split('|');
        $('.Code_groupe').val(items[0]);
        $('.Nom_groupe').val(items[1]);
    }
});

