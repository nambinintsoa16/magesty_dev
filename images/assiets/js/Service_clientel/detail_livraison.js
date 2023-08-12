
  $(document).ready(function(){
        var date ="";
            init(date);
  function init(date) {
      var statut='Previ';
        $('.livre').on('click',function(){
             $.post('fonction/fonctionlisteLivraisonEffectuée.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
 $.post('fonction/fonctionlisteLivraisonEffectuée.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        
        $('.Plan').on('click',function(){
            $.post('fonction/fonctionlisteLivraisonPlanif.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
         $('.Previ').on('click',function(){
            $.post('fonction/fonctionlisteLivraisonPrevi.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
        $('.confirmer').on('click',function(){
            $.post('fonction/fonctionlisteLivraisonConfirmée.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
        $('.annule').on('click',function(){
            $.post('fonction/fonctionlisteLivraisonAnnulle.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
        $('.att').on('click',function(){
            $.post('fonction/fonctionattente.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });

        $('.etdc').on('click',function(){
            $.post('fonction/fonctionlisteLivraisonetdc.php',{date:date},function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        });
    
      };
    };