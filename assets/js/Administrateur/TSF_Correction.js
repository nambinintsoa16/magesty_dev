$(document).ready(function(){
    $('.deverouiller').on('click',function(e){
        e.preventDefault();
        $(".edit_line").css("display", "block");
        $(".lock_line").css("display", "none");
    });  

    $('.lock').on('click',function(e){
        e.preventDefault();
        $( ".contenu" ).attr("disabled", true);
        $('.terminer_tache').removeAttr("disabled"); 
    });
     
    $('.terminer_tache').on('click',function(e){
        e.preventDefault();
        var id =  $('.id_get').text();
        loding();           
        $.post('https://magesty-prod.combo.fun/administrateur/Valider_Correction',{id:id}, function(data){   
            stopload();
            $.confirm({
                title: 'CONFIRMATION',
                content: 'Votre Correction a été  valider  avec succès ',
                type: 'green',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Continuer',
                        btnClass: 'btn-green',
                        action: function(){
                            window.location.replace("https://magesty-prod.combo.fun/Administrateur/Liste_TSF");
                        }
                    }
                }
            });  
        });
       
    });

    $('.valider_correction').on('click',function(e){
         e.preventDefault();
         var currentRow=$(this).closest("tr");
         var id = currentRow.find("td:eq(0)").text();
         var contenu = currentRow.find("td:eq(4)").text();
         $.confirm({
            title: 'Correction',
            content: '' +
            '<form action="" class="formName">' +
            '<div class="form-row pl-2 pr-2">' +
            '<label class="col-4">Numuro :  </label>' +
            '<input type="number" class="form-control col-8 Id_TSF_detail" value="'+id+'" disabled/> ' +
            '</div>'+
            '<div class="form-row pl-2 pr-2">' +
            '<label>Reponse </label>' +
            '<textarea class="form-control Reponse_TSF_detail" value="" rows="4">'+contenu+'</textarea>' +
            '</div>'+
            '</form>',
             buttons: {
                formSubmit: {
                    text: 'Enregistrer',
                    btnClass: 'btn-blue test_inection',
                    action: function (){
                       loding();
                       var id =  this.$content.find('.Id_TSF_detail').val();
                       var contenu = this.$content.find('.Reponse_TSF_detail').val();
                        $.post('https://magesty-prod.combo.fun/administrateur/Enregistrer_Correction',{id:id,contenu:contenu}, function(data){   
                              stopload();
                              $.confirm({
                              title: 'CONFIRMATION',
                              content: 'Votre Correction a été  enregsitrée avec succès ',
                              type: 'green',
                              typeAnimated: true,
                              buttons: {
                                  tryAgain: {
                                      text: 'Continuer',
                                      btnClass: 'btn-green',
                                      action: function(){
                                        location.reload();
                                      }
                                  }
                              }
                          });  
                        }); 
                    }
                },
                cancel: function (){
                    //close
                },
            }
        });  
    });
    $('.test_inection').on('click',function(event){
        event.preventDefault();
        var id = $('.Id_TSF_detail').text();
        var reponse = $('.Reponse_TSF_detail').text();
        alert(id+' : '+reponse);
    });
    function loding() {
        var htmls = '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
                $.dialog({
                    "title": "",
                    "content": htmls,
                    "show": true,
                    "modal": true,
                    "close": false,
                    "closeOnMaskClick": false,
                    "closeOnEscape": false,
                    "dynamic": false,
                    "height": 150,
                    "fixedDimensions": true
                });
        }

    function stopload() {
        $('.jconfirm ').remove();
    }
    
});