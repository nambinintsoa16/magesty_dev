 $(document).ready(function() {
	$('.add_tsf').on('click', function(Event){
 		 Event.preventDefault();
 		 $(".hide").css("display", "block");
         $(".hide_tsf").show();
 	});
    $('.hide_tsf').on('click', function(Event){
         Event.preventDefault();
         $(".hide").hide();
         $(".hide_tsf").hide();
    });
 	 $('.valider_link').on('click', function(Event) {
        Event.preventDefault();
        let link = $('.Lien_client').val();
        loding();
        if (link == ''){
            $.alert({
                title: 'Attention',
                content: 'Le lien de profile du client est obligatoire ',
            });
        }else{
            $.post('https://magesty-prod.combo.fun/operatrice/Afficher_info_client',{link:link}, function(data){
               stopload()
               $('.info').empty().append(data);
            });
        }        
    });

 	 $('.save').on('click', function(Event) {
        Event.preventDefault();
        let Code_client = $('.client_code').val(); 
        let type = $('.type option:selected').text();
        let client = $('.nom_client').val();
        let produit = $('.Produit').val();
        let reponse = $('.reponse').val();
        let page = $('.page').val();
        let reference =  $('.reference option:selected').val();
        loding();
        if (Code_client == '' || type == '' || client == ''||  reponse == '' || produit == '' || page == '' || reference == ""){
            $.alert({
                title: 'Confirmation ',
                content: 'Tous les champs sont obligatoire',
            });
        }else{
            $.post('https://magesty-prod.combo.fun/operatrice/save_sondage',{Code_client:Code_client,type:type,client:client,reponse:reponse,produit:produit,page:page,reference:reference}, function(data){   
            	  stopload();
            	  $.confirm({
                  title: 'Temoignage / Sondage',
                  content: 'Votre temoignage / Sondage a bien été enregistré',
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
         $('.add').on('click', function(Event) {
             Event.preventDefault();
             var Code_client = $('#client_code').val(); 
             var client = $('#nom_client').val();
             var type =  $('.type option:selected').text();
             var Reponse =  $(".reponse").val();
             if(Code_client == "" || client == "" || type == "" || Reponse == ""){
              $.alert('Veillez completer tous les champs ');
                }else{
                  var ligne = "<tr class='testb'><td class='CodeClient'>" + Code_client + "</td><td class='NomClient'>" + client + "</td><td class='TypeTFS'>" + type + "</td><td class='ReponseTFS pt-2 pb-2'><textarea >" + Reponse + "</textarea></td><td class='text-center'> <input type='checkbox' name='select'> | <i class='fa fa-edit' style='color:#007bff'></i></td></tr>";
                        $("tbody.Contenu").append(ligne);
                        $("#form").trigger("reset");
                }            
        });

        $(".suprimer").click(function(Event){
            Event.preventDefault();
          $("tbody.Contenu").find('input[name="select"]').each(function() {
            if($(this).is(":checked")){
              $(this).parents("tbody.Contenu tr").remove();
            }
          });
        });
        $(".enregistrer").on('click',function(event){
            event.preventDefault();
            let id_psf = $('.id_get').text();
            loding(); 
            $('.testb').each(function(){
                var Code_client = $(this).find('.CodeClient').text();
                var Client = $(this).find('.NomClient').text();
                var Type = $(this).find('.TypeTFS').text();
                var Reponse = $(this).find('.ReponseTFS').text();
                Send_Tache_TSF_detail(Code_client,Client,Type,Reponse,id_psf); 

            });   

            location.reload(); 

        });

        $('.terminer_tache').on('click',function(event){
             event.preventDefault();
             let id_tsf = $('.id_get').text();
             $.confirm({
                  title: 'TERMINER TACHE TSF',
                  content: 'Vous êtes sur le point de terminer cette Tache TSF definitivement, Voulez vous continuer?',
                  type: 'green',
                  typeAnimated: true,
                  buttons: {
                      tryAgain: {
                          text: 'Confirmer',
                          btnClass: 'btn-green',
                          action: function(){
                             $.post('https://magesty-prod.combo.fun/operatrice/Valider_TSF_opl',{id_tsf:id_tsf}, function(data){
                                  $.confirm({
                                      title: 'Confirmation',
                                      content: 'Tâche terminée avec succée',
                                      type: 'green',
                                      typeAnimated: true,
                                      buttons: {
                                          tryAgain: {
                                              text: 'Fermer',
                                              btnClass: 'btn-green',
                                              action: function(){
                                                location.reload();
                                              }
                                          }
                                      }
                                  });      
                                });
                          }
                      }
                  }
              });  

        });


        $('.delete').on('click',function(event){
            event.preventDefault();
            var Id_detail_tsf =$(this).attr("id");
            
             $.confirm({
                  title: 'Attention!!',
                  content: 'Vous êtes sur le point de suprimer cette definitivement, Voulez vous continuer?',
                  type: 'red',
                  typeAnimated: true,
                  buttons: {
                      tryAgain: {
                          text: 'suprimer',
                          btnClass: 'btn-red',
                          action: function(){
                             $.post('https://magesty-prod.combo.fun/operatrice/Delete_TSF_detail_By_Id',{Id_detail_tsf:Id_detail_tsf}, function(data){
                                  $.confirm({
                                      title: 'Confirmation',
                                      content: 'la suppression a été effectué avec succée',
                                      type: 'green',
                                      typeAnimated: true,
                                      buttons: {
                                          tryAgain: {
                                              text: 'Contnuer',
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
                      'Fermer': function () {
                      }
                  }
              });  
        })
        function Send_Tache_TSF_detail(Code_client, Client,Type,Reponse,Id){
            $.post('https://magesty-prod.combo.fun/operatrice/Save_TSF_detail',{Code_client:Code_client,Client:Client,Type:Type,Reponse:Reponse,Id:Id},function(){
            });
        }
        $('.import_image').on('click',function() {
            $('#import_image_client').modal('show');
             var Code_client =$(this).attr("id");
             console.log(Code_client);
        });

        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": " imgstyle"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
});
