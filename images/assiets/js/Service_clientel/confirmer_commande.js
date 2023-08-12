$(document).ready(function(){
 $('.valider').on('click',function(event){
    event.preventDefault();
    let livreur=$('.livreur').val();
    let remarque=$('.Remarquelivre').val();
    let client=$('.code_client').text();
    let facture=$('.facture').text();
    loding(); 
    $.post(base_url+'Service_clientel/livre_vente',{livreur:livreur,remarque:remarque,facture:facture,client:client},function(data){
        if(data.message){
            $('.confirmform').addClass('collapse');
            stopload();
            $.alert('<p class="text-center">Vente livrée avec succès</p>')
        }
    },'json');
 }); 
 $('.Annule').on('click',function(event){
    event.preventDefault();
    let facture=$('.facture').text();
    let remarque=$('.Remarqueannul').val();
    let code_annulation=$('.annula option:selected').val();
    let nomlivre=$('.nomlivre').val();
    loding();  
   $.post(base_url+'globale/annulationCommandes',{nomlivre:nomlivre,facture:facture,remarque:remarque,code_annulation:code_annulation},function(){
          $('.confirmform').addClass('collapse');
          stopload();
          $.alert('<p class="text-center">Vente annulée avec succès</p>')
   });
 });
 $('.repporer').on('click',function(e){
     e.preventDefault();
  
      let date=$('.Repportdate').val();
      let debut=$('.Repportdebut').val();
      let fin=$('.Repportfin').val();
      let Remarque=$('.Remarquerapporer').val();
      let facture =$('.facture').text();
      if(date==""){
         $.alert('<p class="center">Date non valide</p>');
      }else if(debut==""){
         $.alert('<p class="center">Heure  non valide</p>');
      }else if(fin==""){
        $.alert('<p class="center">Heure  non valide</p>');
      }else if(Remarque==""){
        $.alert('<p class="center">Vous deviez indiquer pourquoi la commande a été reporter.</p>');
      }else{ 
            loding();
        $.post($(this).attr('href'),{facture:facture,date:date,fin:fin,Remarque:Remarque},function(data){
            if(data.message==true){
                stopload();
                $.alert('<p class="center">Commande repporter avec succés!</p>');
            }else{
                stopload();
                $.alert('<p class="center">Ooops erreur!</p>');
            }
            
        },'json');
        
      }
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
$('.jconfirm').remove();
    
}

});