$(document).ready(function(){
    Init_produit();
    //initCOmplte();
    
    $('.page').on('change',function(){
        var page= $('.page').find('option:selected').val();
        var page_text= $('.page').find('option:selected').text();
        var DISC=localStorage.getItem('DISC');
        var codeclient=localStorage.getItem('codeclient');
        $.post(base_url+'operatrice/test_statut_client',{page:page,DISC:DISC,codeclient:codeclient},function(data){
          if(data.message==false){
             $('.pageusers').empty().append(page_text);
             $('.entetebadge').css('background-color',data.color);
          }else{
           $('.pageusers').empty().append(page_text);
           $('.code_client_ban').empty().append(data.matricule);
           $('.entetebadge').css('background-color',data.color);
           
          }
        },'json');
    });
    $('.pageusers').empty().append($('.page').find('option:selected').text());
   
    $('.chercher').on('keyup',function(){
       let chain=$(this).val();
       if(chain==""){
           $('.scrolling-wrapper .client_name').each(function(){   
                   $(this).parent().removeClass('collapse');
           });
       }else{
       $('.scrolling-wrapper .client_name').each(function(){
           if( $(this).text().toLowerCase().search(chain.toLowerCase())== -1){
               $(this).parent().addClass('collapse');
           }else{
               $(this).parent().removeClass('collapse');
           }
       });
     } 
    });
    $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 20);
    $('.user').on('click',function(){
           if( $('.clientMessage').attr("class")=="form-control clientMessage" ){
                $('.clientMessage').addClass('collapse');
                $('#reponse_client').removeClass('collapse');
                $('.right_bull').removeClass('collapse');
                $('.left_bull').addClass('collapse');   
                $('.PJ').attr('id','OPL');
           } 
   
           $('.clientzoom').css("width", '50px');
           $('.clientzoom').css("height", '50px');
           $('.clientzoom').css("object-fit",  'cover');      
           $('.clientzoom').css("border",  'solid 2px #ff4444');
           $('.userzoom').css("width",  '100px');
           $('.userzoom').css("height",  '85px');
           $('.userzoom').css("object-fit",  'cover');
           $('.userzoom').css("border",  'solid 5px #00C851');
           /*$('.entetebadge').css("background",  '#e6ee9c');  
            $('.entetebadge').css("color",  '#000');  */ 
        });
    $('.Client').on('click',function(){
    
            if( $('#reponse_client').attr("class")=="form-control typeahead ui-autocomplete-input" ){
                $('.clientMessage').removeClass('collapse');
                $('#reponse_client').addClass('collapse');
                $('.left_bull').removeClass('collapse');
                $('.right_bull').addClass('collapse');
                $('.PJ').attr('id','CLT');
   
           } 
           $('.userzoom').css("width", '50px');
           $('.userzoom').css("height", '50px');
           $('.userzoom').css("object-fit",  'cover');
           $('.userzoom').css("border",  'solid 2px #ff4444');
           $('.clientzoom').css("width",  '100px');
           $('.clientzoom').css("height",  '85px');
           $('.clientzoom').css("border",  'solid 5px #00C851');
           $('.clientzoom').css("object-fit",  'cover');
           /*$('.entetebadge').css("background",  '#33b5e5');
            $('.entetebadge').css("color",  '#000'); */ 
   
   
   
    
        });
      
    $('#message').on('change',function(){
           let content=$(this).val();
           let id_con=$('.image_choise').attr("id");
           let Id_zone=$('.zone').val();
           var page= $('.page').find('option:selected').val();
           var page_text= $('.page').find('option:selected').text();
           var DISC=localStorage.getItem('DISC');
           var codeclient=localStorage.getItem('codeclient');
       
   
   
           $.confirm({
               title: '<p class="text-center" style="font-size:9px;">MESSAGE DU CLIENT</p>',
               content:'<form><textarea id="input" class="form-control message_contes" rows="3">'+content+'</textarea></form>',
               buttons: {
                   formSubmit: {
                       text: 'Envoyer',
                       btnClass: 'btn-blue',
                       action: function () {
                           var name;
                           loding();
                           name=this.$content.find('.message_contes').val();
                           if(!name){
                               $.alert('provide a valid name'+name);
                               return false;
                           }
                         
                           let type=$('.type_discussion').val();
                            $.post(base_url+'operatrice/sauvemessage',{message:name,Id_zone:Id_zone,id_con:id_con,Type:type,sender:'CLT',page:page},function(data){
                                    if(data.message==true ){
                                       $('.conten-message').empty().append(data.content); 
                                       $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);    
                                       $('#message').val("");
                                       $.post(base_url+'operatrice/test_statut_client',{page:page,DISC:DISC,codeclient:codeclient},function(data){
                                           if(data.message==false){
                                              $('.pageusers').empty().append(page_text);
                                              $('.entetebadge').css('background-color',data.color);
                                              stopload(); 
                                           }else{
                                            $('.pageusers').empty().append(page_text);
                                            $('.code_client_ban').empty().append(data.matricule);
                                            $('.entetebadge').css('background-color',data.color);
                                            stopload(); 
                                           }
                                         },'json'); 
        
                                    }else if(data.message=="refresh"){ 
                                       localStorage.setItem("codeclient",data.new_id);
                                       window.location.replace(base_url+'operatrice/Discussions');
                                    }
                            },'json');
                       
                       }
                   },
                   cancel: function () {
                   
                   },
               },
               onContentReady: function () {
                   var jc = this;
                   this.$content.find('form').on('submit', function (e) {
                       e.preventDefault();
                       jc.$$formSubmit.trigger('click'); // reference the button and click it
                   });
               }
           });
   
       /*    $.confirm({
               keyboardEnabled: true,
                title: '<p class="text-center" style="font-size:9px;">MESSAGE DU CLIENT</p> ',
                content: '<textarea id="input" class="form-control message_contes" rows="3">'+content+'</textarea>',
                animation: 'zoom',
                buttons: {
                   formSubmit: {
                       text: 'Envoyer',
                       btnClass: 'btn-blue',
                       action: function () {
                      let message = this.$content.find('.message_contes').text();
                      let type=$('.type_discussion').val();
                       $.post(base_url+'operatrice/sauvemessage',{message:message,Id_zone:Id_zone,id_con:id_con,Type:type,sender:'CLT'},function(data){
                               if(data.message==true){
                                  $('.conten-message').empty().append(data.content); 
                                  $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);    
                                  $('#message').val("");
                               }
                       },'json');
                   }
                },
                'Annule': function(){
                 
                },
                onContentReady: function () {
                   var jc = this;
                   this.$content.find('.chose').on('click', function (e) {
                       e.preventDefault();
                       jc.$$formSubmit.trigger('click'); // reference the button and click it
                   });
                 }
               }
             });*/
        });  
    $('.conclure').on('click',function(event){
        event.preventDefault();
    $('.form_vente').modal('show');
   });
    $('.datelivre').on('change',function(){
       let date=$(this).val();
       let now = new Date();
       let ladate=new Date(date);
        if(ladate.getDay()==0){
          $.alert('<p class="text-center">Oooh! Jour non valide!!! <br/> Pas de livraison le dimanche.</p>');
          $(this).val(" ");
        }else if (new Date(now) > new Date( date)){
          /*$.alert('<p class="text-center">Oooh! Jour non valide!!<br/> Date sélectionnée inférieure aux dates du jour.</p>');
           $(this).val(" ");*/
        }
     });
    $('.ville').on('focusout',function(){
       let ville=this.value;
           $('.ville').val(ville.toUpperCase());
       });
    $('.zone,.groupe').on('change',function(){
           let groupe= $('.groupe').val();
           let famille=$('.famille').val();
           let zone=$('.zone').val();
                produitname(groupe,famille,zone)
         });    
    $('.famille').on('change',function(){
       Init_produit(); 
      }); 
    $(".validproduit").on('click', function(event) {
       event.preventDefault();
       let tempPrix = $('.produitname option:selected').val().split('|');
       let tempProduit = $('.produitname option:selected').text().split('|');
       let test= true;
       let table=[];
       
       if (typeof($('.prod').html()) == 'undefined') {
           $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
           $('.total').empty().append(tempPrix[1] + ' MGA');
       } else {
           $('.prod').each(function() {
               table.push($(this).text());
           });
       if($.inArray(tempProduit[0], table) != -1){
           $.alert('<p class="text-center">Ce produit existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une une nouvelle produit.</p>');
       }else{
           $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
           
      
       }
       var sum = 0;
         if (typeof($('.tot').html()) !== 'undefined') {  
            $('.tot').each(function() {
                sum += parseInt($(this).html());
            });
            $('.total').empty().append(sum + ' MGA');
   
         }
   
   }
      
       fonctiondel();
   
    }); 
    $(".qt").on('change', function() {
          let quantite = $(this).val();
          let priproduit = $('.contprix .prix').text();
          let total = quantite * priproduit;
          $('.total .conttotal').empty().append(total + " Ar");
          let table = $(this).parent().parent();
       });
    $(".new_client").on('click',function(event){
       event.preventDefault();
       $('.plus_client').modal('toggle');
    });
    $(".client_lat").on('click',function(){
       loding();
       let image = $(this).attr("src");
       let id_conversation= $(this).attr("id");
       let temp_id=image.split("/");
       let id_client=temp_id[6].split(".");
       localStorage.setItem('codeclient',id_client[0]);
       $('.code_client_ban').empty().append(localStorage.getItem('codeclient'));
       if(localStorage.getItem('codeclient').indexOf('CLT')!=-1){
           $('.entetebadge').css('background-color','#00C851');
       }else if(localStorage.getItem('codeclient').indexOf('CMT')!=-1){
           $('.entetebadge').css('background-color','#33b5e5');
       }else{
           $('.entetebadge').css('background-color','#aa66cc'); 
       }
   
       $.post(base_url+'operatrice/detail_clients',{codeclient:localStorage.getItem('codeclient')},function(data){
            if(data.message==true){
               $('.nom_client_ban').empty().append(data.content.toUpperCase());
               $('.Client').css('border-top','7px ridge'+data.color);
               stopload();
            }else{
               stopload();
            }
   
       },'json');
   
       $('.Client').attr("src",image);
       $('.Client').attr("id",id_conversation);  
       let bttest= $('.btn-disabled').attr('class');
       if(bttest=="form-group col-md-12 text-left btn-disabled"){
          $('.btn-disabled').addClass('collapse');
          $('.btn-init').removeClass('collapse');
       }
       $.post(base_url+'operatrice/testDiscution',{idclient:id_client[0]},function(data){
           if(data.message===true){
              $('.conten-message').empty().append(data.content);
              $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);         
           }else{
               $('.conten-message').empty(); 
           }
      },'json');
   
    });
    $('.termier').on('click',function(event){
       event.preventDefault();
       loding();
       let page= $(this).find('option:selected').val(); 
       let reponse_clien=$('#reponse_client').val();
       let idproduit=$('.codeProduit').val();
       let id_con=$('.image_choise').attr("id");
       let Id_zone=$('.zone').val();
       let idRep=$('#reponse_client').val();
       let message = 'terminer';
       let type=$('.type_discussion').val();
        $.post(base_url+'operatrice/sauvemessage',{message:message,Id_zone:Id_zone,id_con:id_con,Type:'termier',sender:'OPL',page:page},function(data){
                if(data.message==true){
                   $('.conten-message').empty().append(data.content);    
                   $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);     
                   $('#message').val("");
                   stopload();
                }
        },'json');
   
      /*$.post(base_url+'operatrice/changeStatutDiscussion',{id_discussion:id_discussion,statut:statut},function(data){
        if(data.message==true){
   
           $('.btn-disabled').removeClass('collapse');
           $('.btn-init').addClass('collapse');
           init_lateral_bar(id_discussion);
           localStorage.clear();
           
        }
      },'json');*/
   
   
   
   
    });
    $('#image').on('change', (e) => {
       let that = e.currentTarget
       if (that.files && that.files[0]) {
           $(that).next('.custom-file-label').html(that.files[0].name)
           let reader = new FileReader()
           reader.onload = (e) => {
               $('#preview').attr('src', e.target.result)
           }
           reader.readAsDataURL(that.files[0])
       }
   });
    $('#liensurfb').on('change',function(){
       var link=$(this).val();
       loding();
   if(link!=""){
   
   $.post(base_url+'globale/testLink',{liensurfb:link,type:'link'},function(data){
      if (data.exist=='true') {
             stopload();
            $.alert('<p class="text-center">Ce client existe déjà</p>');
            
      }else if(data.exist=='potentiel'){
            stopload();
             $('#identifient').val(data.nom);
             $('#liensurfb').val(data.lien_facebook);
          }else if(data.exist=='exist'){
            $('#identifient').val(data.nom);
            $('#liensurfb').val(data.lien_facebook);
            $('#preview').attr('src',data.image);
            $('.save').addClass('collapse');
            $('.next').removeClass('collapse');
            localStorage.setItem("codeclient",data.Code_client);
            stopload();
           // $.alert('<p class="text-center">Client déjât enregistre</p>');
       }else  if(data.exist=='false') {
            if( $('.next').attr('class')=="btn btn-primary pull-right next"){
               $('.save').removeClass('collapse');
               $('.next').addClass('collapse');
            }
            stopload();
       }
   
       },'json');
         
   }
   });
    $('.save').on('click',function(){
       let type="potentiel";
       loding();
       $.post(base_url+'operatrice/nouveau_codeClient',{type:type},function(data){
            uploadImage(data);      
       },'json');
    });
    $('.next').on('click',function(event){
        event.preventDefault();
        $('.Client').attr('src',base_url+"images/client/"+localStorage.getItem('codeclient')+".jpg"); 
        $('.code_client_ban').empty().append(localStorage.getItem('codeclient'));
        if(localStorage.getItem('codeclient').indexOf('CLT')!=-1){
           $('.entetebadge').css('background-color','#00C851');
       }else if(localStorage.getItem('codeclient').indexOf('CMT')!=-1){
           $('.entetebadge').css('background-color','#33b5e5');
       }else{
           $('.entetebadge').css('background-color','#aa66cc'); 
       }
        $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
           if(data.message=='false')
              $.post(base_url+'operatrice/new_discussion',{client:localStorage.getItem('codeclient')},function(datas){
                 localStorage.setItem("DISC",datas);
                 $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
                   if(data.message===true){
                      $('.conten-message').empty().append(data.content);     
                      $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);    
                   }else{
                       $('.conten-message').empty(); 
                   }
                 },'json');
             },'json');
           else if(data.message){
                 localStorage.setItem("DISC",data.id_discussion);
                 $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
                   if(data.message===true){
                      $('.conten-message').empty().append(data.content);     
                      $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);    
                   }else{
                       $('.conten-message').empty(); 
                   }
                 },'json');
     
           }  
          },'json');
        $('.plus_client').modal('hide');
    });
    $('.valide_content').on('click',function(event){
       event.preventDefault();
       
       let reponse_clien=$('#reponse_client').val();
       let idproduit=$('.codeProduit option:selected').val();
       let id_con=$('.image_choise').attr("id");
       let Id_zone=$('.zone').val();
       let idRep=$('#reponse_client').val();
       let page= $('.page').find('option:selected').val(); 
    $.get(base_url+'operatrice/dataProduitUsers/'+reponse_clien+'/'+idproduit,function(data){
        var text='test';
   
        $.confirm({
           title: '<p class="text-center" style="font-size:9px;">MESSAGE DU CLIENT</p>',
           content:'<form><textarea id="input" class="form-control message_contes" rows="3">'+data.Content+'</textarea></form>',
           buttons: {
               formSubmit: {
                   text: 'Envoyer',
                   btnClass: 'btn-blue',
                   action: function () {
                       var name;
                       name=this.$content.find('.message_contes').val();
                       if(!name){
                           $.alert('provide a valid name'+name);
                           return false;
                       }
                     
                       let type=$('.type_discussion').val();
                       loding();
                        $.post(base_url+'operatrice/sauvemessages',{message:name,Id_zone:Id_zone,id_con:id_con,Type:type,sender:'OPL',idRep:idRep,page:page},function(data){
                           if(data.message==true){
                               $('.conten-message').empty().append(data.content);    
                               $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);     
                               $('#message').val("");
                               stopload();
                            }
                        },'json');
                   
                   }
               },
               cancel: function () {
               
               },
           },
           onContentReady: function () {
               var jc = this;
               this.$content.find('form').on('submit', function (e) {
                   e.preventDefault();
                   jc.$$formSubmit.trigger('click'); // reference the button and click it
               });
           }
       });
   
   
       /*$.confirm({
           keyboardEnabled: true,
            title: '<p class="text-center" style="font-size:9px;">REPONSE AU MESSAGE</p> ',
            content: '<textarea id="input" class="form-control message_contes" rows="3">'+data.Content+'</textarea>',
            animation: 'zoom',
            buttons: {
            'Ok': function(){
               
                  let message = $('.message_contes').text();
                  let type=$('.type_discussion').val();
                   $.post(base_url+'operatrice/sauvemessages',{message:message,Id_zone:Id_zone,id_con:id_con,Type:type,sender:'OPL',idRep:idRep},function(data){
                           if(data.message==true){
                              $('.conten-message').empty().append(data.content);    
                              $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);     
                              $('#message').val("");
                           }
                   },'json');
            },
            'Annule': function(){
             
            }
           }
         });*/
       },'json'); 
    });
   
   function saveDetail(codeClient){
       let liensurfb=$('#liensurfb').val();
       let identifient=$('#identifient').val();
       let coach_temp =$('.coach').val();
       let commerciale_temp =$('.commerciale ').val();
       if($('.commerciale').val()!="") {
          if($('.coach').val()==""){
              $.alert('<p class="text-center">Coach obligatoire</p>');
           }else{
   
            let coach= coach_temp.split('|');
            let commerciale= commerciale_temp.split('|');
            $.post(base_url+'operatrice/save_detail',{liensurfb:liensurfb,identifient:identifient,codeclient:codeClient,coach:coach[0],commerciale:commerciale[0]},function(data){
               if(data){
                     localStorage.setItem("codeclient",codeClient);
                     $.post(base_url+'operatrice/new_discussion',{client:codeClient},function(data){
                        localStorage.setItem("DISC",data);
                        window.location.replace(base_url+'operatrice/Discussions');
                     },'json');
                     
               }
            
               },'json');
         } 
           
       }else{
   
         $.post(base_url+'operatrice/save_detail',{liensurfb:liensurfb,identifient:identifient,codeclient:codeClient},function(data){
               if(data){
                     localStorage.setItem("codeclient",codeClient);
                     $.post(base_url+'operatrice/new_discussion',{client:codeClient},function(data){
                        localStorage.setItem("DISC",data);
                        window.location.replace(base_url+'operatrice/Discussions');
                     },'json');
               }
            
               },'json');
       } 
   }
   function uploadImage(codeClient){    
     let fd = new FormData();
     let files = $('#image')[0].files[0];
     let data='string'; 
     fd.append('file',files);
      $.ajax({
         url:base_url+'operatrice/sauveImageClient/'+codeClient,
         type: 'post',
         data: fd,
         contentType: false,
         processData: false,
         success: function(data){
            saveDetail(codeClient);
            stopload();
          },     
   
         error : function(resultat, statut, erreur){
            
            saveDetail(codeClient);
            stopload();
           }
   
          
         },'json');   
        
   }
   function Init_produit(){
           let famille=$('.famille').val();
           $.post(base_url+'globale/famille',{famille:famille},function(data){
             if(data.message==true){
                $('.groupe').empty().append(data.content);
                var groupe= $('.groupe').val();
                var zone=$('.zone').val();
                produitname(groupe,famille,zone);         
           }else{
               $.alert('<p class="text-center"><i class="fa fa-warning danger"></i>&nbsp;Erreur</p>');
           } 
         },'json');   
   
          $('.Client').attr("src",base_url+"images/client/"+localStorage.getItem('codeclient')+".jpg");
          $('.image_choise').attr('id',localStorage.getItem('DISC'));
          $('.code_client_ban').append(localStorage.getItem('codeclient'));
          if(localStorage.getItem('codeclient').indexOf('CLT')!=-1){
           $('.entetebadge').css('background-color','#00C851');
       }else if(localStorage.getItem('codeclient').indexOf('CMT')!=-1){
           $('.entetebadge').css('background-color','#33b5e5');
       }else{
           $('.entetebadge').css('background-color','#aa66cc'); 
       }
          $.post(base_url+'operatrice/detail_clients',{codeclient:localStorage.getItem('codeclient')},function(data){
           if(data.message==true){
              $('.nom_client_ban').empty().append(data.content.toUpperCase());
              
           }
   
      },'json');
   
          $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
           if(data.message===true){
              $('.conten-message').empty().append(data.content);     
              $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);    
           }else{
               $('.conten-message').empty(); 
           }
         },'json');
       }
   $('.scrolldown').on('click',function(){
       $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000); 
   });
   
   function fonctiondel() {
           $('.suppr').on('click', function() {
               $(this).parent().parent().remove();
               totaltab();
           });
   
           function totaltab() {
               let sum = 0;
            if (typeof($('.tot').html()) !== 'undefined') {  
               $('.tot').each(function() {
                   sum += parseInt($(this).html());
               });
               let aff = $('.total').empty().append(sum + ' MGA');
               return (aff);
              }else {
                  $('.total').empty().append('00 MGA');  
              }
           }
   
           $('.Qua').on('change', function() {
               if ($(this).val() < 1) {
                   $.alert('<p  class="text-center">Le nombre de produit ne doit pas être inférieur a 1</p>');
                   $(this).val('1');
   
               }
               let content = $(this).parent();
               let total = content.next();
               let quantite = $(this).val();
               let prix = content.parent().find('th').eq(2).html();
               let Qt = prix.split(",");
               let number = Qt[0].replace(".", "");
               total.empty().append(parseInt(number) * quantite);
               totaltab();
           });
       }
   function produitname(groupe,famille,zone){
           $.post(base_url+'globale/produitname',{groupe:groupe,famille:famille,zone:zone},function(data){
               if(data.message==true){
                   $('.produitname').empty().append(data.content);
               }else{
                  $.alert('<p class="text-center"><i class="fa fa-warning danger"></i>&nbsp;Erreur</p>');
               }
           },'json');    
       }  
   function init_lateral_bar(id_discussion){
     $('.client_lat').each(function(){
          if($(this).attr('id')==id_discussion){ 
             $(this).parent().remove();
          }   
     });
   }
   
   /************************************ Enregistrement vente ****************************************/
   
   $('.enregistre_commande').on('click', function(event) {
       event.preventDefault();
       loding();
       var start = new Date();
       var produit = new Array();
       var client = localStorage.getItem('codeclient');
       var date = $('.datelivre').val();
       var Debut = $('.Debut').val();
       var Fin = $('.Fin').val();
       var ville = $('.ville').val();
       var quartier = $('.quartier').val();
       var lieulivre = $('.lieulivre').val();
       var District = $('#District').val();
       var remarque = $('.comment').val();
       var frailivre = $('.frailivre').val();
       var Id_zone = $('.zone').val();
       var contact=$('.contact').val();
       var Id_discussion=$('.image_choise').attr('id');
       let id_con=$('.image_choise').attr("id");
       let id_zone=$('.zone').val();
       let idRep=$('#reponse_client').val();
       var detailcommande=[];
       var page= $('.page').find('option:selected').val();
      $('.tbody tr').each(function(){
         detailcommande.push( $(this).find('.idPrix').text()+"|"+  $(this).find('.quant input').val());
      });
      
      if (typeof($('.prod').text()) == undefined) {
       stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez entre au moins une produit</p>');
      }else if (Debut > Fin || Debut == Fin){    
           stopload();  
           $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>');
       } else if (Debut == "") {
           stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>');
       } else if (Fin == "") {
           stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Tranche d\'heure de livraison incorrect,veuiilez entrer tranche d\'heure valide.</p>');
       } else if (ville == "") {
           stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous le champs " <u>Ville</u> " avant de valider votre transaction.</p>');
       } else if (quartier == "") {
           stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous les champs " <u>Quartier</u>" avant de valider votre transaction.</p>');
       } else if (lieulivre == "") {
           stopload();  
          $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i>Veuillez remplir tous les champs " <u>Lieu de livraison</u>"  avant de valider votre transaction.</p>');
       } else {
   $.post(base_url+'operatrice/newfacture', function(data) {
               var fact = data.codefact;
   $.post(base_url+'operatrice/sauvemessage',{message:fact,Id_zone:id_zone,id_con:id_con,Type:'vente',sender:'OPL',page:page},function(){
   });
   $.post(base_url+'operatrice/enregistre_commande', { Id_discussion: Id_discussion,contact: contact, fact: fact,Id_zone: Id_zone ,date: date, Debut: Debut, Fin: Fin, ville: ville, quartier: quartier, lieu_de_livraison: lieulivre, remarque: remarque, produits: detailcommande, client: client,frailivre:frailivre,District:District,page:page }, function(datas) {
      
       if(datas.message === true){
               $('.fade').modal('hide');
              
               $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
                   if(data.message===true){
                      $('.conten-message').empty().append(data.content);     
                      $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);  
                      stopload();  
                      $.alert('<p class="text-center"><i class="fa fa-check" aria-hidden="true" style="color:green;" ></i>Commande enregistrée avec succes</p>');
                   }else{
                       $('.conten-message').empty(); 
                       stopload();
                       $.alert('<p class="text-center"><i class="fa fa-check" aria-hidden="true" style="color:green;" ></i>Commande enregistrée avec succes</p>');
                   }
                 },'json');
           }else{
               $('.fade').modal('hide');
               stopload();
               $.alert('<p class="text-center"><i class="fa fa-warning" aria-hidden="true" style="color:red;" ></i> &nbsp;Oops! Une erreure ces produis Veuillez recommencer</p>');
        }
   },'json');
             
           }, 'json');
   
            
   
       }
   });
   
   
   $('.ville').autocomplete({
       source: base_url+"operatrice/autocomplete_ville/"
   });
   $('.ville').on('change',function(){
          $.alert();
   });
   
   $('.quartier').autocomplete({
       source:base_url+"operatrice/autocomplete_quartier",
       select: function (e, ui) {
            $('.fade ').modal('hide'); 
           $.post(base_url+'operatrice/autocomplete_ville',{quartier:ui.item.value},function(data){
               $.confirm({
                   title: 'choisir ville',
                   content:data,
                   buttons: {
                       formSubmit: {
                           text: 'choisir',
                           btnClass: 'btn-blue',
                           action: function () {
                               var name;
                               this.$content.find('.chose').each(function(){
   
                                 if($(this).prop('checked')){
                                       name=$(this).val();
                                    }
                                    
                               });
                               if(!name){
                                   $.alert('provide a valid name'+name);
                                   return false;
                               }
                               $('#ville').val(name);
                               discrict_chose(name,ui.item.value);
                           }
                       },
                       cancel: function () {
                           //close
                       },
                   },
                   onContentReady: function () {
                       var jc = this;
                       this.$content.find('.chose').on('click', function (e) {
                           e.preventDefault();
                           jc.$$formSubmit.trigger('click'); // reference the button and click it
                       });
                   }
               });
               
             
         },'json');
       }
      
   }); 
   
   $('.codeProduit').on('change',function(){
       //initCOmplte();
   });
   $('#quartier').on('focus',function(){
      // $(this).val('');
     //  $('#District').val("");
     // $('#ville').val("");
   });
   function loding(){ 
       var htmls='<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
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
   function stopload(){
   $('.jconfirm ').remove();
       
   }
   function discrict_chose(quartier,ville){
           $.post(base_url+'operatrice/autocomplete_discrict',{quartier:quartier,ville:ville},function(data){
               $.confirm({
                   title: 'choisir discrict',
                   content:data,
                   buttons: {
                       formSubmit: {
                           text: 'choisir',
                           btnClass: 'btn-blue',
                           action: function () {
                               var name;
                               this.$content.find('.chose').each(function(){
   
                                 if($(this).prop('checked')){
                                       name=$(this).val();
                                    }
                                    
                               });
                               if(!name){
                                   $.alert('provide a valid name'+name);
                                   return false;
                               }
                               $('#District').val(name);
                               $('.form_vente ').modal('show');
                           
                           }
                       },
                       cancel: function () {
                       
                       },
                   },
                   onContentReady: function () {
                       var jc = this;
                       this.$content.find('.chose').on('click', function (e) {
                           e.preventDefault();
                           jc.$$formSubmit.trigger('click'); // reference the button and click it
                       });
                   }
               });
               
             
         },'json');
   
   }
   
   
   $('#reponse_client').autocomplete({
       source:function(request,response){
           var idproduit = $('.codeProduit option:selected').val();
           $.ajax({
               url: base_url+'operatrice/dataProduitUser/',
               dataType: "json",
               data: {
                   term: request.term,
                   produit: idproduit
               },
               success: function (data) {
                   response(data);
               }
           });
   
   
       }
   }); 
   
   function initCOmplte(){
     var idproduit = $('.codeProduit option:selected').val();
     var sample_data = new Bloodhound({
       datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
       queryTokenizer: Bloodhound.tokenizers.whitespace,
       prefetch:base_url+'operatrice/dataProduitUser/%QUERY/'+idproduit,
       remote:{
           url:base_url+'operatrice/dataProduitUser/%QUERY/'+idproduit,
           wildcard:'%QUERY'
            }
               });
   $('#prefetch .typeahead').typeahead(null, {
       hint: true,
       highlight: true,
       minLength: 1,
       type: 'sample_data',
       display: 'CodeDiscussion',
       source:sample_data,
       limit:10,
       templates:{
       suggestion:Handlebars.compile('<div class="row pt-1" style="background:#e6ee9c;font-size:12px;border-bottom:solid 1px #ddd;width:800px;padding:10px 5px;color:#000;cursor:pointer"><div class="col-md-12 text-left">{{CodeDiscussion}}-{{Content}}</div></div>')
       }
    });
   }
   
   $('.PJ').on('change',function(event){
     event.preventDefault();
     loding();
     let fd = new FormData();
     let files = $('.PJ')[0].files[0];
     let sender=$(this).attr('id');
     let data='string'; 
     fd.append('file',files);
       let page= $(this).find('option:selected').val(); 
       let reponse_clien=$('#reponse_client').val();
       let idproduit=$('.codeProduit').val();
       let id_con=$('.image_choise').attr("id");
       let Id_zone=$('.zone').val();
       let message = id_con+new Date().getTime();
       let type=$('.type_discussion').val();
        $.post(base_url+'operatrice/sauvemessage',{message:message,Id_zone:Id_zone,id_con:id_con,Type:'image',sender:sender,page:page},function(data){
                if(data.message==true){
                   $('.conten-message').empty().append(data.content);    
                   $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);     
                   $('#message').val("");
       
            $.ajax({
                 url:base_url+'operatrice/uploadFils/'+message,
                 type: 'post',
                 data: fd,
                 contentType: false,
                 processData: false,
                  success: function(data){
                      $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 20);
                      stopload();
                   },     
   
              error : function(resultat, statut, erreur){
                       $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 20);
                       stopload();
            
                   }
   
         },'json');   
                } 
     },'json');    
   
   });
   
   
   });
   