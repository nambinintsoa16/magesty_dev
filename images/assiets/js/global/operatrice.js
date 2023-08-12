$(document).ready(function(){
function loding(){ 
        let data='<div class="d-flex justify-content-center" style="height:50px;width: 50px;margin: auto;"><img src="'+base_url+'/images/loading.gif"></div>';
        $.confirm({
         title: '',
         content:  data,
         cancelButton: false,
         confirmButton: false,
         buttons: { ok: { isHidden: true } }
       });
       }
function stopload(){
  $('.jconfirm ').remove();
        
  }
});