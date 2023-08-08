    <fieldset class="border">
        <div class="m-2">
            <h3>Etape 3</h3>
            <form>
                <div class="form-group">

                    <div class="form-group collapse">
                        <label for="nom">code Client</label>
                        <input type="text" class="form-control form-control-sm codeClient" name="codeClient" id="codeClient" placeholder="codeClient" value="<?=$codeclient?>" required>
                    </div>
                    <label for="situation">Situation Familiale</label>
                    <select class="custom-select my-1 mr-sm-2 situation" id="inlineFormCustomSelectPref" name="situation">
                        <option value="choisir">Misafidy</option>
                        <option value="marie">Marié</option>
                        <option value="celibataire">Célibataire</option>
                        <option value="separe">Séparé(e)</option>
                        <option value="divorce">Divorcé(e)</option>
                        <option value="veuve">Veuf(ve)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="enfant">Vous avez des enfants ?</label>
                    <div class="form-check">
                        <input type="radio" id="oui" class="enfants" name="enfants" value="oui">
                        <label for="oui">Oui</label>
                        <input type="radio" id="non" class="enfants" name="enfants" value="non">
                        <label for="non">Non</label>
                    </div>
                </div>
                <div class="form-group " id="form_enfant" style="display:none;">
                    <div class="form-group description">
                        <label for="description">Description Enfants</label>
                        <input type="text" name="nombre_gars" id="nombre" class="form-control mb-2 nombre" placeholder="Nombres">
                    </div>
               
                <div class="row affiche p-1">
                       
                </div> 
             </div> 
            </form>
        </div>
    </fieldset>
<script>
    $(document).ready(function(){
        $('#oui').on('click',function(){
            $('#form_enfant').slideDown();
        });
        $('#non').on('click',function(){
            $('#form_enfant').slideUp();
        });
        $('#nombre').on("input",function(){
            var numbre = $(this).val();
            $('.affiche').empty();
            
            for(var i=0;i<numbre;i++){
                $('.affiche').append('<span class="data-enfant w-100"><div class="form-group col-12"><label for="enfants">Enfants N°'+(i+1)+'</label><select class="custom-select my-1 mr-sm-2 genre" ><option value="garcons">Garçons</option><option value="fille">Fille</option></select></label><input type="text" class="form-control mb-2 age" placeholder="Ages"><input type="text"  class="form-control mb-2 college" placeholder="Ecoles ou Universités"></div></span>');
            } 
        });
       
        $('.valid').on('click',function(e){
          e.preventDefault();
                let codeClient = $('.codeClient').val();
                let situation = $('.situation option:selected').val();
                let enfants = $('.enfants').val();
                let nombre = $('.nombre').val();

             if(nombre != "" && nombre > 0){   
               $('.data-enfant').each(function(){
                 let Sexe = $(this).find('.genre').val();
                 let Age = $(this).find('.age').val();
                 let college = $(this).find('.college').val();
              
                   $.post(base_url+'Client/sauveEnfant',{Id_client:codeClient,Sexe:Sexe,Age:Age,college:college},(data)=>{
                        console.log(true);
                    }).fail((error)=>{
                        console.log(false);
                    });
             });
           }
       $.post(base_url+'Accueil/updateProlis',{etape:"Etape_3",codeClient:codeClient,situation:situation,enfants:enfants,nombre:nombre},(data)=>{
            $('.modaltache').modal('hide');
            $('.modaltache > input').val('');
            swal("Succés", "Profil mis à jour", {
                icon : "success",
                buttons: {                 
                confirm: {
                className : "btn-success"
                    }
                }
            });
        }).fail((error)=>{
            swal("Erreur", "Une erreur est survenue, veuillez recommencer!", {
                icon : "error",
                buttons: {                 
                confirm: {
                    className : "btn-danger"
                         }
                    }
                });
            });
        }); 
  
});
</script>