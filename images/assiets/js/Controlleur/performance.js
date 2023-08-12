$(document).ready(function(){
          $('.linky').on('click',function(e){
            e.preventDefault();
            var parent=$(this).parent().parent();
            var matricule = parent.children().first().text();
            var datedeb = $('.dateAutre1').val();
            var datefin = $('.dateAutre2').val();
            $.post(base_url+'controlleur/produitUsermois',{datedeb:datedeb,datefin:datefin,matricule:matricule},function(data){
                $.alert(data);
            }); 

        });
      
       $('.lien').on('click',function(event){
            event.preventDefault();
            var matricule = null;
            var datedeb = $('.dateAutre1').val();
            var datefin = $('.dateAutre2').val();
            $.post(base_url+'controlleur/produitListemois',{dateAutre1:datedeb,dateAutre2:datefin,matricule:matricule},function(data){
                 $.alert(data);
            }); 
          
    });
});