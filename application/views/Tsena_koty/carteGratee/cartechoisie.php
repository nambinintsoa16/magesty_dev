 <div class="modal-body ">
   <div class="row">
  <div class="col-md-12">
    <div class="card-body">

      <div class="card" style="">
        <img src="<?=base_url()?>images/cartegratter/<?= $detatilcarte->code_carte ?>.png" class="card-img-top" style="width: 30%;margin:auto;"  alt="<?=$detatilcarte->code_carte?>">
        <div class="card-body ">
           <h5 class="card-title" style="font-size: 16px!important;"> INFORMATION CARTE TIRER </h5>
           <hr>
            <ul class="" style="list-style-type: none;padding-left: 2px;font-size: 14px;">
              <li> <i class="fa fa-hand-o-right text-success " aria-hidden="true"></i> Numero de Tirage :  <mark id="num_tirage"> <?= 
              $detatilcarte->numero_tirage;?>  </mark> </li>
              <li> <i class="fa fa-hand-o-right text-success" aria-hidden="true"></i> Code Carte : <mark class="code" id="<?= $detatilcarte->code_carte ?>" style="font-size:12px"> <?= $detatilcarte->code_carte ?>  </mark> </li>
               <li> <i class="fa fa-hand-o-right text-success" aria-hidden="true"></i> Designation lot  : <mark style="font-size:12px">  <?= $detatilcarte->designation ?> </mark> </li>
                <li> <i class="fa fa-hand-o-right text-success" aria-hidden="true"></i> Gain  : <mark style="font-size:12px">  <?= 
                $detatilcarte->gain ?> </mark> </li>
                 <li> <i class="fa fa-hand-o-right text-success" aria-hidden="true"></i> Valeur  : <mark style="font-size:12px">  <?= $detatilcarte->operation ?> </mark> </li>
            </ul>
          
        </div>
      </div>
           
          
        </div>
  </div>
</div>    
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
  <button type="button" id="<?= $detatilcarte->numero_tirage;?>" class="btn btn-success btn-sm tirer">Affecter au Client </button>
</div>

<script>
 $(document).ready(function(){
    $('.tirer').on('click', function(e) {
        e.preventDefault();
        var codeClient = $('.codeClientSpan').text();
        var num_tirage = $(this).attr('id');
        $.post(base_url + 'CarteGratee/Tirage',{codeClient:codeClient,num_tirage:num_tirage},function(data){
            if(data==1){
                    $.alert({
                        title: 'Tirage',
                        content: 'Tirage effectué avec succèes',
                    });     
               }
               if (data==0){
                    alert("Une erreur c'est produite");
               } 

        });
         location.reload(); 
    });
     });
   </script>
