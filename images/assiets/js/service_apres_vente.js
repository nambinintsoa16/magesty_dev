$(document).ready(function() {
    /*$('.enCharge').on('click',function(event){
    event.preventDefault();
    let id=$(this).attr('id');
    $.post(base_url+'Service_apres_vente/test2',{idFacture:id},function(data){
        if(data.erreur!='false'){
         // $('.etatLivraison').empty().append(data.codeclient);            
         // location.reload(true);
       
         $.confirm({
            title: 'Information commande',
            content: data.content  ,
            type: 'green',
            typeAnimated: true,
            columnClass: 'col-md-6 col-md-offset-3',
            buttons: {
                valider: function () {
                    $.post(base_url+'Service_apres_vente/prendreEnCharge',{idFacture:id},function(data){
                      //  location.reload(true);
                       // if(data.erreur!='false'){
                         // $('.etatLivraison').empty().append(data.codeclient);            
                         
                      //  }
                        
                   },'json');
                     //  }
                     $.confirm({
                        title: 'Confirmation',
                        content: 'Le client a bien ete pris en charge',
                        buttons: {
                        OK: function () {
                        
                                                            setTimeout(function(){
                                                                  window.location = "service_apres_vente";
                                                                 },1000); 
                        
                                                        }
                        
                                                    }
                                                });
                    
                },
                annuler: function () {
                    $.alert('annulé!');
                },
            }
        });
            
         append(data.content) ; 
        }
        console.log(data);
   },'json');
});  */

    $('.enCharge').on('click', function(event) {
        event.preventDefault();
        let id = $(this).attr('id');
        $.confirm({
            title: 'voulez-cous vraiment prendre en charge cette facture',
            type: 'green',
            typeAnimated: true,
            columnClass: 'col-md-6 col-md-offset-3',
            buttons: {
                valider: function() {
                    // $.post(base_url+'Service_apres_vente/priseCharge',{idFacture:id},function(data){
                    //  location.reload(true);
                    // if(data.erreur!='false'){
                    // $('.etatLivraison').empty().append(data.codeclient);            
                    //  }

                    /*       console.log(data) ; 
                       },'json'); */
                    window.location.href = "Service_apres_vente/nouveau2/" + id;
                },
                annuler: function() {
                    $.alert('annulé!');
                },
            }
        });
    });


    $('.discussion').on('click', function(event) {
        event.preventDefault();
        let id = $(this).attr('id');
        $.post(base_url + 'Service_apres_vente/consulterDiscu', { codeClient: id }, function(data) {
            if (data.erreur != 'false') {
                // $('.etatLivraison').empty().append(data.codeclient);            
                location.reload(true);

                $.confirm({
                    title: 'DISCUSSION',
                    content: data.content,
                    type: 'green',
                    typeAnimated: true,
                    columnClass: 'col-md-8 col-md-offset-2',
                    buttons: {
                        quitter: function() {}
                    }
                });

                append(data.content);
            }
            console.log(data);
        }, 'json');
    });




});