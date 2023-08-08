$(document).ready(function(){
    $('.afficher_promo').on('click',function(e){
        e.preventDefault();
        var date_debut=$('.date_debut').val();
        var date_fin=$('.date_fin').val();
        $.post(base_url+"Administrateur/affichageListePromotion",{date_debut:date_debut,date_fin:date_fin},function(data){

        });
    });
    $('.table_rapport').DataTable();
});