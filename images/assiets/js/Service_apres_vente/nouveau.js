$(document).ready(function(){
    Init_produit(); 
   var codeClient = "codeClient" ; 
   $('.client_lat').on('click',function(event){
      event.preventDefault();
      
      var parent=$(this).parent().parent().parent().parent();
    
      parent.find('.img-thumbnail').each(function(){
          $(this).css('border-color', 'gray') ; 
      });
      
      $(this).css('border-color', 'blue') ; 
      

      let id=$(this).attr('id');
      codeClient = id ; 
        $.post(base_url+'Service_apres_vente/test',{idclient:id},function(data){
           if(data.erreur!='false'){
            $('.conten-message').empty().append(data.codeclient); 
            console.log(data.codeclient);
            if(data.type == "message" || data.type == "image" || data.type == "vente_Annule")
            {
               $("#nouvelleDiscu").hide(); 
               $("#terminerBut").show(); 
               $("#aSuivre").show(); 
               $("#fileInput").prop("disabled", false);
               $("#message").prop("disabled", false);
               $("#validation").prop("disabled", false);

            }
            if(data.type == "termine")
            {
               $("#terminerBut").hide(); 
               $("#aSuivre").hide(); 
               $("#nouvelleDiscu").show(); 
               $("#fileInput").prop("disabled", true);
               $("#message").prop("disabled", true);
               $("#validation").prop("disabled", true);
            }
            if(data.type == "aSuivre")
            {
               $("#terminerBut").show(); 
               $("#nouvelleDiscu").hide(); 
               $("#aSuivre").hide(); 
               $("#fileInput").prop("disabled", false);
               $("#message").prop("disabled", false);
               $("#validation").prop("disabled", false);
            }

           }
      },'json');
      
      let nm = $('#clientListe'+id).text(); 
      $("#nomDuClient").text(nm +'  '+codeClient);  

      let imgSrc = $('#'+id).attr('src');  
      $('#clImg').attr("src", imgSrc); 

      $('#cl').attr("src", imgSrc) ; 
      
/*
      let var = $('#'+id).nextUntil("#heading3"). */
   });   

   var choice = "" ;
              
   $('#cl').on('click',function(event){
      $(this).css('border-color', 'blue') ;  
      $('#us').css('border-color', 'grey') ;   
      choice = "CLT" ;                              
   });  
   
   $('#us').on('click',function(event){
      $(this).css('border-color', 'blue') ;  
      $('#cl').css('border-color', 'grey') ;  
      choice = "SAV" ;                            
   });   

  $("#validation").on('click' , function(e){
    
  
      e.preventDefault();
   
      var messageContent = "messageContent" ; 
      var message = $("#message").val();
      var file = $("#fileInput").val() ; 
      typeOfMessage = "type" ; 
      let fd = new FormData(); 
      let files = null ; 
      if(message == "" ) 
      {
       
            files = $('.PJ')[0].files[0];
            let name = files.name ; 

            messageContent = name ;
            typeOfMessage = "file" ;   
      }
      else 
      {
         messageContent = message ; 
         typeOfMessage = "message" ; 
      }
      
     // <input type="text" placeholder="Your name"  value="'+messageContent+'" class="name form-control" required />
      $.confirm({
         title: 'Confirmation!',
         content: '' +
         '<form action="" class="formName">' +
         '<div class="form-group">' +
         '<label>confirmer ou modifier</label>' +
         '<textarea class="name form-control" name="w3review" rows="4" cols="50">'+messageContent+'</textarea>'+
         '</div>' +
         '</form>',
         buttons: {
             formSubmit: {
                 text: 'Submit',
                 btnClass: 'btn-blue',
                 action: function () {
                     var name = this.$content.find('.name').val();
                     if(!name){
                         $.alert('provide a valid name'); 
                         return false;
                     }
                     $.alert('message enregistre' + name);
                     $.post(base_url+'Service_apres_vente/insertMessage',{codeClient:codeClient,messageContent:name,sender:choice,messageType:typeOfMessage},function(data){
                        if(data.erreur!='false'){
                           $('.conten-message').empty().append(data.codeclient); 
                           $("#terminerBut").show(); 
                           $("#aSuivre").show(); 
                           $("#nouvelleDiscu").hide(); 
                           $("#fileInput").prop("disabled", false);
                           $("#message").prop("disabled", false);
                           $("#validation").prop("disabled", false);
   
                        }
                        console.log(data);
                     },'json');
                     
                     if(typeOfMessage == "file")
                     {
                        name = codeClient+'_'+name; 
                        fd.append('file',files);
                        $.ajax({
                           url:base_url+'Service_apres_vente/uploadFils/'+name,
                           type: 'post', 
                           data: fd,
                           contentType: false,
                           processData: false,
                              success: function(data){
                                // $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 20); 
                              // let h =  $('.PJ').val();
                              //   alert(files.name) ; 
                              },     
               
                        error : function(resultat, statut, erreur){
                                /* $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 20);
                                 stopload(); */ 
                                 alert("no") ; 
                        
                              }
               
                     },'json');  
                     }
                     
                 }
             },
             cancel: function () {
                 //close
             }, 
         },
         onContentReady: function () {
             // bind to events
             var jc = this;
             this.$content.find('form').on('submit', function (e) {
                 // if the user submits the form by pressing enter in the field.
                 e.preventDefault();
                 jc.$$formSubmit.trigger('click'); // reference the button and click it
             });
         }
     }); 

     
      /*alert(
         "codeClient:"+codeClient+"message:"+messageContent+"sender:"+choice+"type de message"+typeOfMessage
         ) ; */
     
      /*$.post(base_url+'Service_apres_vente/insertMessage',{codeClient:codeClient,messageContent:messageContent,sender:choice,messageType:typeOfMessage},function(data){
         if(data.erreur!='false'){
          $('.conten-message').empty().append(data.codeclient); 
         }
         console.log(data);
    },'json'); */
     
   }) ; 
   
   $("#terminerBut").on("click", function() {

      $.post(base_url+'Service_apres_vente/terminerDiscussion',{codeClient:codeClient},function(data){
         if(data.erreur!='false'){
          $('.conten-message').empty().append(data.codeclient); 
            $("#aSuivre").hide(); 
            $("#terminerBut").hide(); 
            $("#nouvelleDiscu").show(); 
            $("#fileInput").prop("disabled", true);
            $("#message").prop("disabled", true);
            $("#validation").prop("disabled", true);
         }
         console.log(data);
      },'json');
     });     

     $("#aSuivre").on("click", function() {

      $.post(base_url+'Service_apres_vente/aSuivre',{codeClient:codeClient},function(data){
         if(data.erreur!='false'){
          $('.conten-message').empty().append(data.codeclient); 
            $("#aSuivre").hide(); 
            $("#terminerBut").show(); 
            $("#nouvelleDiscu").hide(); 
            $("#fileInput").prop("disabled", false);
            $("#message").prop("disabled", false);
            $("#validation").prop("disabled", false);
         }
         console.log(data);
      },'json');
     });     

     $("#nouvelleDiscu").on("click", function() {

      $.post(base_url+'Service_apres_vente/nouvelleDiscu',{codeClient:codeClient},function(data){
         if(data.erreur!='false'){
          $('.conten-message').empty().append(data.content); 
            $("#aSuivre").hide(); 
            $("#terminerBut").hide(); 
            $("#nouvelleDiscu").hide(); 
            $("#fileInput").prop("disabled", false);
            $("#message").prop("disabled", false);
            $("#validation").prop("disabled", false);
         }
         console.log(data);
      },'json');
     });     





   $("#searchId").on("keyup", function() {
      var value = $(this).val().toLowerCase();
     $('#idListeClient .classeClient').each(function(){
        var nom=$(this).find('.nomclients').text().toLowerCase();
         if(nom.indexOf(value) == -1){
            $(this).addClass('collapse');
         }else{
            $(this).removeClass('collapse');
         }
      }); 
     });     
     
     $("#conclusionModal").on("click", function() {
      $('.form_vente').modal('show') ; 
     });     


     /*$.post(base_url+'Service_apres_vente/search',{mot:value},function(data){
         if(data.erreur!='false'){
          $('#idListeClient').empty().append(data.mot); 
         }
         console.log(data);
      },'json');
    });*/
    function uploadImage(){    
      let fd = new FormData();
      let files = $('#fileInput')[0].files[0]; 
      fd.append('file',files);
       $.ajax({
          url:base_url+'Service_apres_vente/testUploadFile',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){
                 
           },     
          error : function(resultat, statut, erreur){
            }
          },'json');   
       }
      


    function uploadImage(codeClient){    
      let fd = new FormData();
      let files = $('#image')[0].files[0]; 
      fd.append('file',files);
       $.ajax({
          url:base_url+'operatrice/sauveImageClient/'+codeClient,
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){
                 
           },     
          error : function(resultat, statut, erreur){
             
            }
          },'json');   
       } 






               
    $('.conclure').on('click',function(event){
        event.preventDefault();
        $('.table_commande .tbody').empty();
        
        if($('.mask').attr('class')=='mask collapse'){
            $('.mask').removeClass('collapse');
            $('.datelivre').parent().removeClass();
            $('.datelivre').parent().addClass('col-lg-3');
            $('.updatedate').parent().addClass('collapse');
            $('.id_facture_collapse').empty();

        }

    $('.form_vente').modal('show');
   });
    $('.datelivre').on('change',function(){
       let date=$(this).val();
       let now = new Date();
       let ladate=new Date(date);
       let dateDed= new Date(new Date(new Date().setDate(new Date().getDate() + 21)));
   
        if(ladate.getDay()==0){
          $.alert('<p class="text-center">Oooh! Jour non valide!!! <br/> Pas de livraison le dimanche.</p>');
          $(this).val(" ");
        }
        //else if (ladate.toLocaleDateString() < now.toLocaleDateString()){
         // $.alert('<p class="text-center"><span style="color:red"> Jour non valide!!<br/> Date sélectionnée inférieure aux dates du jour. Veuillez choisir une date valide<span></p>');
           //$(this).val(" "); 
        //}/*else  if(dateDed.toLocaleDateString() < ladate.toLocaleDateString()){
           //$.alert('<p class="text-center"><span style="color:red"> Jour non valide!!<br/> Date sélectionnée inférieure aux dates du jour. Veuillez choisir une date valide<span></p>');
       // }*/
   
   
   
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
       //console.log($('.id_facture_collapse').text());
       if (typeof($('.prod').html()) == 'undefined') {
          if($('.id_facture_collapse').text() ==''){
             $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
          }else{
             $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-primary add_produit"><i class="fa fa-plus"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
             addPRoduit();
          } 
           $('.total').empty().append(tempPrix[1] + ' MGA');
       } else {
           $('.prod').each(function() {
               table.push($(this).text());
           });
       if($.inArray(tempProduit[0], table) != -1){
           $.alert('<p class="text-center">Ce produit existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une une nouvelle produit.</p>');
       }else{
          if($('.id_facture_collapse').text() ==''){
               $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-danger suppr"><i class="icon_close_alt2"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
          }else{
              $('.table_commande>tbody:last').append('<tr><th class="prod">' + tempProduit[0]+ '</th><th class="codeProduit">' + tempProduit[1] + '</th><th class="prix">' + tempPrix[1] + '</th><th class="quant"><input style="width:50px;text-align:center;" type="number" class="Qua" value="1"></th><th class="tot">' + tempPrix[1] + '</th><th><img class="img img-thumbnail w-5" style="width:50px;" src="http://combo.in-expedition.com/images/produit/'+$.trim(tempProduit[0])+'.jpg"></th><th><button class="btn btn-primary add_produit"><i class="fa fa-plus"></i></button></th><th class="idPrix collapse">'+$.trim(tempPrix[0])+'</th></tr>');
              addPRoduit();   
            } 
      
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

  /************************************ Enregistrement vente ****************************************/

  $('.ress_sec_oplg').on('focusout',function(){
    var choix = $('.nature_sc').find('option:selected').text();
     if(choix==''){
         $.alert('');
     }else{
        $('.result_mattr').empty().append(choix + $(this).val());  
     }
 });
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
    let cotactlivre=$('.cotactlivre').val();
    let result_mattr = $('.result_mattr').text();
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
            $.post(base_url+'operatrice/enregistre_commande', { Id_discussion: Id_discussion,contact: contact, fact: fact,Id_zone: Id_zone ,date: date, Debut: Debut, Fin: Fin, ville: ville, quartier: quartier, lieu_de_livraison: lieulivre, remarque: remarque, produits: detailcommande, client: client,frailivre:frailivre,District:District,page:page,cotactlivre:cotactlivre,result_mattr:result_mattr}, function(datas) {
               
                if(datas.message === true){
                        $('.fade').modal('hide');
                        $.post(base_url+'operatrice/testDiscution',{idclient:localStorage.getItem('codeclient')},function(data){
                            if(data.message===true){
                               $('.conten-message').empty().append(data.content);     
                               $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000);  
                               stopload();  
                               edit_facture();
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
   //localStorage.getItem("codeclient");

   
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
   function edit_facture(){


       $('div .modify').on('click',function(e){
           e.preventDefault();
          var id = $(this).children().first().attr('id');
       
        if($('#lock').attr('class')=='fa fa-unlock-alt'){
            $.post(base_url+'operatrice/dettail_vente_modif',{facture:id},function(data){
               
                if(data.message=='true'){
                    $('.mask').addClass('collapse');
                    $('.datelivre').parent().removeClass();
                    $('.datelivre').parent().addClass('col-lg-8');
                    $('.form_vente').modal('show');
                    $('.table_commande .tbody').empty().append(data.content);
                    $('.total').empty().append(data.total);
                    $('.id_facture_collapse').empty().append(data.facture);
                    $('.updatedate').parent().removeClass('collapse');
                    edit_produit();
                }else{
                    $('.mask').addClass('collapse');
                    $('.form_vente').modal('show');
                }
            },'json');
    }
}); 
   }

function  edit_produit(){

   $('.edit_produit').on('click',function(event){
    event.preventDefault();
      var parent = $(this).parent().parent();
      var quantite=parent.find('.Qua').val();
      var facture=parent.find('.idfacture').text(); 
    $.post(base_url+'operatrice/modifquantite',{idvente:facture,quantite:quantite},function(data){

    });
     
   });

   $('.updatedate').on('click',function(event){
       event.preventDefault();
       var facture=$('.id_facture_collapse').text();
       var date=$('.datelivre').val();
       $.post(base_url+'operatrice/changedatefacture',{id:facture,date:date},function(data){

       });

   });

   $('.delete_produit').on('click',function(event){
    event.preventDefault();
        var parent = $(this).parent().parent();
        var facture=parent.find('.idfacture').text(); 
        $.post(base_url+'operatrice/annuleproduit',{idvente:facture},function(data){

        });
   });
  
   
}
function addPRoduit(){
    $('.add_produit').on('click',function(event){
        event.preventDefault();
      var parent = $(this).parent().parent();
      var quantite=parent.find('.Qua').val();
      var idPrix=parent.find('.idPrix').text();
      var facture=$('.id_facture_collapse').text();
        $.post(base_url+'operatrice/addProduit',{facture:facture,idPrix:idPrix,quantite:quantite},function(data){
  
       });
  
     });
}





});

    

    