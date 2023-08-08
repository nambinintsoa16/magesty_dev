<fieldset class="border">
    <div class="container">
        <div class="form-group collapse">
                    <label for="etape">Etape</label>
                    <input type="text" class="form-control form-control-sm" name="etape" id="etape" placeholder="etape" value="Etape_2" required>
                </div>
                <div class="form-group collapse">
                    <label for="nom">code Client</label>
                    <input type="text" class="form-control form-control-sm" name="codeClient" id="codeClient" placeholder="codeClient" value="<?=$codeclient?>" required>
                </div>
               
                <div class="form-group">
                    <label>Miasa ve ianao?</label>
                    <select class="custom-select miasa" id="miasa" name="miasa">
                        <option value="choisir">Misafidy</option>
                        <option value="oui">oui</option>
                        <option value="non">non</option>
                    </select>
                </div>
                <div class="form-group">
                <select class="custom-select type_oui" id="asa" name="asa">
                    <option class="default" value="choisir">Misafidy</option>
                    <option class="oui"  value="asa_tena">Asa tena</option>
                    <option class="oui"  value="asa_panjakana">Asa-panjakana</option>
                    <option class="oui"  value="tsy_miankina">Tsy miankina</option>
                    <option class="oui"  value="misotro_ronono">Misotro ronono</option>
                    <option class="non" value="chommeur">Chomeur</option>
                    <option class="non"  value="femme_foyer">Femme au foyer</option>
                    <option class="non" value="retraite">Retraité</option>
                    <option class="non" value="etudiant">Etudiant</option>
                </select>
            </div>            
      
    </div>
</fieldset>
<script>
$(document).ready(function(){
  $('#miasa').on("change",function(){
    var txt=$(this).val();
    $('.default').attr("selected",true);
    if(txt=='oui'){
       $('.non').attr('hidden',true);
       $('.oui').removeAttr('hidden');
    }else{
       $('.oui').attr('hidden',true);
       $('.non').removeAttr('hidden');
    }
  }); 
  $('.enregistrer').on('click',function(e){
    e.preventDefault();
    var miasa=$('#miasa').val();
    if(miasa=='oui'){
      var asa=document.getElementById('asa').value;
      $.post(base_url+"Client/formulaireUpdateProfil",{miasa:miasa,asa:asa},function(data){
        Swal.fire('Ajout avec success!');
      });         
    }else{
      var asa1=$('.type_non').val();
      $.post(base_url+"Client/formulaireUpdateProfil1",{miasa:miasa,asa1:asa1},function(data){
        Swal.fire('Ajout avec success!');
      });
    }
      $('select').val('');              
  });

  $('form').on('submit',function(e){
       e.preventDefault();
         var fd = new FormData(this);
         $.ajax({
         type:'POST',
         url: "Accueil/updateProlis",
         data: fd,
         cache:false,
         contentType: false,
         processData: false,
         success: (data) => {
            $('#modaltache').modal('hide');
            swal("Succés", "Profil mis à jour", {
                  icon : "success",
                  buttons: {                 
                     confirm: {
                        className : "btn-success"
                            }
                          },
            });
         },error: function(data){
             swal("Erreur", "Une erreur est survenue, veuillez recommencer!", {
                  icon : "error",
                  buttons: {                 
                     confirm: {
                        className : "btn-danger"
                            }
                          },
            });
                           
         }
      });       
  });

});
</script>
