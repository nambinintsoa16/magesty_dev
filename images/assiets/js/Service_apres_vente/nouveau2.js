$(document).ready(function(){
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
             $('.conten-message').animate({scrollTop: $('.conten-message').get(0).scrollHeight}, 1000); 
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
               console.log(data);
       },'json');
 
       let nm = $('#clientListe'+id).text(); 
       $("#nomDuClient").text(nm+'  '+codeClient);  
 
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
 /*
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
        } */
  
 });
 
     
 
     