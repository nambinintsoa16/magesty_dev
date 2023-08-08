
    <form>
    
      <div class="form-group">
        <div class="col-md-12">
          <div class="col-md-4">
            <fieldset><legend>Date</legend>
            <div class="col-md-12">
            <input type="Date" name="dateinfo" class="form-control date" value="<?=date("d-m-Y")?>">
            </div>
            </fieldset>
          </div>
        <div class="col-md-4">
            <fieldset><legend>Objet</legend>
            <div class="col-md-12">
             <select class="form-control ReclamationNature objet">
                <option>Réclamation</option>
                <option>demande d'information</option>             
              </select>
            </div>
            </fieldset>
          </div>
            <div class="col-md-4">
             <fieldset><legend>Nature</legend>
              <select class="form-control ReclamationNature type">
                <option>Autre</option>
                <option>Efficacité</option>
                <option>Produit</option>
                <option>Prix</option>
                <option>Mode d'utisation</option>
                <option>Qantité</option>
                <option>Service de livraison</option>             
              </select>
               </fieldset>
            </div>
         
          
         </div>
      </div>
 <div class="produitcont">
<fieldset> <legend>Produit</legend>
       <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-7">
                  <input type="text" class="form-control cherche produit select-client" id="client" style="width: 350px;" placeholder="Produit">
                </div>
                <div class="col-lg-4" style="text-align: right;">
                  <div class="imageproduit img-thumbnail" style="width: 150px;height: 150px;text-align:center;padding: auto auto;">
                    <h5 style="margin-top:45%; ">Photo Produit</h5> 
                  </div>
                  <span class="idProduit"></span>
                </div>
                 
            </div>
        </div>
</fieldset>
</div>



<fieldset class="class="border p-2""><legend>Client</legend>
      <div class="form-group col-md-12">
       
           <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-7">
                  <input type="text" class="form-control cherche client select-client" id="client" style="width: 350px;" placeholder="Client">
                </div>
                <div class="col-lg-4" style="text-align: right;">
                  <div class="image img-thumbnail" style="width: 150px;height: 150px;text-align:center;padding: auto auto;">
                    <h5 style="margin-top:45%; ">Photo client</h5> 
                  </div>
                  <span class="idclient"></span>
                </div>
                 
            </div>
        </div>
      
      </div>
</fieldset>

<fieldset class="class="border p-2""><legend>Commentaire</legend>
      
      <div class="form-group">
        <textarea class="form-control remarque" style="resize:none;"></textarea>
      </div> 
</fieldset>
<fieldset>
  <button class="btn btn-primary valider"><i class="fa fa-sauve"></i> Enregistré</button>
</fieldset>
    </form>
  </div>
 </section>
 </section> 
 <script type="text/javascript">
   $(document).ready(function(){
    select();
    $('.client').autocomplete({
       source : 'fonction/fonctionlisteclien.php',
    select : function(event, ui){ 
      $.post('fonction/image.php',{image:ui.item},function(data){
         $('.image').empty().append('<img style="width:100%;height:100%;" src="../img/photoclient/'+data.image+'">');
          $('.idclient').empty().append(data.idclient);
      },'json'); 
    }
  });
  $('.type').on('change',function(){
         select();
  });
  function select(){
    var nature=$('.type').val();
    if (nature=="Autre" || nature=="Service de livraison"){
       $('.produitcont').addClass('collapse');
    }else{
      $('.produitcont').removeClass('collapse');
    }
  }
  $('.valider').on('click',function(event){
       event.preventDefault();

       if(typeof($('.produitcont').val())=='undifend'){
        var date=$('.date').val();
        var idclient=$('.idclient').html();
        var commentaire=$('.remarque').val();
        var nature=$('.type').val();
     $.post('fonction/fonctionajoutreclamation.php',{date:date,idclient:idclient,commentaire:commentaire,nature:nature},function(data){
        });
       }else{
        var date=$('.date').val();
        var idclient=$('.idclient').html();
        var commentaire=$('.remarque').val();
        var nature=$('.type').val();
        var objet=$('.objet').val();
        var codeproduit=$('.idProduit').html();
        $.post('fonction/fonctionajoutreclamation.php',{codeproduit:codeproduit,date:date,idclient:idclient,commentaire:commentaire,nature:nature,objet:objet},function(data){
          console.log(data);

        });
       }
  });

    $('.produit').autocomplete({
       source : 'fonction/fonctionlisteprod.php',
    select : function(event, ui){ 
      $.post('fonction/imageprod.php',{image:ui.item},function(data){
         $('.imageproduit').empty().append('<img style="width:100%;height:100%;" src="../img/produit/'+data.image+'">');
            $('.idProduit').empty().append(data.codeproduit);
      },'json'); 
    }
  });
   });
 </script>