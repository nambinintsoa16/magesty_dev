<?php foreach($data as $data):?>
<div class="col-md-3">
      <div class="card" style="">
        <img src="<?=base_url('images/imageKoty/cadeauVide.gif')?>" class="card-img-top" style="width: 100%;margin:auto;"  alt="<?=$data->code_carte?>">
        <div class="card-body">
           <h5 class="card-title" style="font-size: 16px!important;"> INFORMATION CARTE  </h5>
           <hr>
            <ul class="" style="list-style-type: none;padding-left: 2px;font-size: 14px;">
              <li> <i class="fa fa-hand-o-right text-success" aria-hidden="true"></i> Numero de Tirage :  <mark class="<?=$data->numero_tirage?>"> <?=$data->numero_tirage?> </mark> </li>
              
             
            </ul>
          <a href="#" id="<?=$data->numero_tirage?>" class="btn btn-primary btn-sm tiree pull-right">Choisir</a>
        </div>
      </div>
    </div>
<!-- Modal de confirmation tirage -->
<div class="modal fade" id="Confirmation_tirage_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tirage Carte Gratter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="tirage_client">
        
      </div>
     
    </div>
  </div>
</div>
<?php endforeach;?>    
<script>
 $(document).ready(function(){

   /* $('.tirer').on('click', function(e) {
        e.preventDefault();
        alert('andry');
        var codeClient = $('.codeClientSpan').text();
        var num_tirage = $('.num_tirage').text();
        $.post(base_url + 'CarteGratee/Tirage',{codeClient:codeClient,num_tirage:num_tirage},function(data){
              
          });
    });*/

   $('.tiree').on('click',function(e){
     e.preventDefault();
     let codeClient = $('.codeClientSpan').text();
     let id = $(this).attr('id');
     let $this = $(this);
     loding();
      $.get($(this).attr('href'),{codeClient:codeClient,id:id},function(){
       $('#Confirmation_tirage_modal').modal('show') ;
        $.post(base_url + 'CarteGratee/Carte_choisie',{codeClient:codeClient,id:id},function(data){
              $('#Confirmation_tirage_modal').modal('show') ;
              $('.tirage_client').empty().append(data); 
               
          });
        stopload();
      }).fail(function(){
        stopload();
      });
   });

   
  function loding(){ 
  var htmls='<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #ff0090;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
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
</script>