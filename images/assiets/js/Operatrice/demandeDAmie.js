$(document).ready(function() {
	$('.savedonne').on('click',function(event){
		event.preventDefault();
		   
       		if($('#image').val()==""){
			$.alert("Image obligatoire");
		}else if($(".NomEtPrenom").val() ==""){
			$.alert("Nom et Prènom obligatoire");
      		}else if($(".Lien").val()==""){
                        $.alert("Lien facebook obligatoire");
      		}else{
                    loding();
   			$.post(base_url+'operatrice/nouveau_codeAmie',function(data){
	        		uploadImage(data);
	       		},'json');
      		} 
	              
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

	function uploadImage(codeClient){    
        let fd = new FormData();
        let files = $('#image')[0].files[0];
        let data='string'; 
        fd.append('file',files);
         $.ajax({
            url:base_url+'operatrice/sauveImageAmie/'+codeClient,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
               saveDetail(codeClient);
              },     
   
            error : function(resultat, statut, erreur){
               
               saveDetail(codeClient);
               
              }
   
             
            },'json');   
           
    }
   
   function saveDetail(codeClient){
        var NomEtPrenom=$(".NomEtPrenom").val();
        var Lien=$(".Lien").val();
        var PageOuCompte=$(".PageOuCompte option:selected").val();
        var Type=$(".Type option:selected").val();
        $.post(base_url+"operatrice/saveAmie",{Code:codeClient,NomEtPrenom:NomEtPrenom,Lien:Lien,PageOuCompte:PageOuCompte,Type:Type},function(data){
               stopload();
              $('#preview').attr('src',"http://magesty.combo.fun/images/profil_vide.jpg");
              $(".NomEtPrenom").val("");
              $(".Lien").val("");
        });
   }
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
	
});
