$(document).ready(function(){
    $('.matricule').autocomplete({
        source:base_url + "Administrateur/autocomplete_gestion_pages",
        /*select: function (t, ti) {
            t.preventDefault();
            let items = ti.item.label;
            $('.matricule').val(items[0].trim());   
        }*/
    });
});