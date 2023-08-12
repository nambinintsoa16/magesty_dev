$(document).ready(function(){  
        $('.enCharge').on('click',function(event){
        event.preventDefault();
        let id=$(this).attr('id');
        
        
        $.post(base_url+'Service_apres_vente/test2',{idFacture:id},function(data){
            if(data.erreur!='false'){
             // $('.etatLivraison').empty().append(data.codeclient);            
             // location.reload(true);
           
             $.confirm({
                title: 'Confirm!',
                content:  append(data.content)  ,
                buttons: {
                    confirm: function () {
                         $.alert('Canceled!');
                       
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    },
                }
            });
                
             append(data.content) ; 
            }
            console.log(data);
       },'json');

     /*   $.confirm({
            title: 'Confirm!',
            content: 'voulez vous vraiment prendre en charge?',
            buttons: {
                confirm: function () {
                   
                    $.post(base_url+'Service_apres_vente/prendreEnCharge',{idFacture:id},function(data){
                        if(data.erreur!='false'){
                         // $('.etatLivraison').empty().append(data.codeclient);            
                          location.reload(true);
                        }
                           console.log(data);
                   },'json');
                },
                cancel: function () {
                    $.alert('Canceled!');
                },
            }
        }); */
    });   
});
 
     
 
     