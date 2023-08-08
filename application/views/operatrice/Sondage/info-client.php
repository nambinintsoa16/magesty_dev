<?php foreach ($info_client as $value) {?>
            <div id="form">
 	 		<div class="form-group row">
			    <label for="colFormLabel" class="col-sm-2 col-form-label"> Client</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control "  id="nom_client" value="<?php echo $value->Compte_facebook; ?>">
			    </div>
			     <label for="colFormLabel" class="col-sm-2 col-form-label"> Code </label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control " id="client_code" value="<?php echo $value->Code_client; ?>" disabled>
			    </div>
			</div>
		  	<div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Type Tache </label>
			    <div class="col-sm-10">
			      <select class="form-control type">
			      	<option value="" collapse disabled></option>
			      	<option value="Sondage">Sondage</option>
			      	<option value="Temoignage">Temoignage</option>
			      	<option value="Faharetana">Faharetana</option>
			      </select>
			    </div>
			</div>
		  	<div class="form-group row">
		    	<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Reponse  </label>
		    	<div class="col-sm-10">
		      		<textarea rows="4" class="form-control reponse text-left" placeholder="Entrez la reponse du client">
		      		</textarea>
		    	</div>
		  	</div>
          </div>
		  	<div class="form-group row">
			    <div class="col-sm-12 text-right">
			     	<button class="btn btn-primary btn-sm add">Ajouter</button>
			    </div>
		  	</div>
		</form>
 <?php } ?>
 <script type="text/javascript">
 $(document).ready(function() {
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

        $(".suprimer").click(function(Event) {
            Event.preventDefault();
          $("tbody.Contenu").find('input[name="select"]').each(function() {
            if($(this).is(":checked")){
              $(this).parents("tbody.Contenu tr").remove();
            }
          });
        });

 });
 </script>
      