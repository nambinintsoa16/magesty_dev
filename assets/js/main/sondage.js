$(document).ready(function(){
 
    $('.fff').on('click',function(e){
    e.preventDefault();
        var date=$('.date').val();
        var Type=$('.select1 option:selected').val();
        var nom_client=$('.nom').val();
        var lien_facebook=$('.lien').val();
        var marque=$('.mark').val();
        var produit=$('.produit').val();
        var commentaire=$('.text').val();
        var interpretation=$('.select2 option:selected').val();
        loading();
    $.post(base_url+'operatrice/enregistrer_sondage',{date:date,Type:Type,nom_client:nom_client,lien_facebook:lien_facebook,marque:marque,produit:produit,commentaire:commentaire,interpretation:interpretation},function(){

        $('.date').val("");
        $('.select1 option:selected').val("");
        $('.nom').val("");
        $('.lien').val("");
        $('.mark').val("");
        $('.produit').val("");
        $('.commentaire').val("");
        $('.select2 option:selected').val("");
        initable();
           });

    }); 
}); 
 
    $( ".mark" ).autocomplete({
        source: base_url+"operatrice/autocomplete_mark", 
        select:function(t,ti){
            t.preventDefault();
            let items=ti.item.label.split('|');
            $('.mark').val(items[0]);
            $('.produit').val(items[1]);
        }
    });
    $(".produit").autocomplete({
        source:base_url+"operatrice/autocomplete_produit",
        select:function(e,ui){
            e.preventDefault();
            let items=ui.item.label.split('|');
            $('.mark').val(items[0]);
            $('.produit').val(items[1]);
        }
    });
    initable();
function loading(){ 
  let data='<div class="d-flex justify-content-center" style="height:50px;width: 50px;margin: auto;"><img src="'+base_url+'/images/loading.gif"></div>';
  $.confirm({
   title: '',
   content:  data,
   cancelButton: false,
   confirmButton: false,
   buttons: { ok: { isHidden: true } }
 });
 }
 function stopload(){

    $('.jconfirm-open').remove();
    
    }
    function initable(){
        $.post(base_url+'operatrice/tablesondage',function(data){
           if(data.message==true){
                 $('.tbody').empty().append(data.content);
                 stopload();     
           }
        
         },'json');  
      }
function Tables(){
$(".dataTable").dataTable({
    "language":{
        "sUrl": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"
    }
})
}

