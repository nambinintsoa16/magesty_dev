$(document).ready(function(){
    $('.link').on('click',function(e){
       e.preventDefault();
       var parent=$(this).parent().parent();
       var matricule = parent.children().first().text();
       var date=$('.date_collapse').text();
       $.post(base_url+'controlleur/produitUser',{date:date,matricule:matricule},function(data){ 
            $.alert(data);
       }); 
     
    });
    $('.linka').on('click',function(e){
        e.preventDefault();
        var parent=$(this).parent().parent();
        var matricule ="";
        var date=$('.date_collapse').text();
        $.post(base_url+'controlleur/produitListe',{date:date,matricule:matricule},function(data){
              $.alert(data);
        }); 
      
     });
    });