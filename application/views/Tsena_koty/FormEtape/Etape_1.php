<div class="container">
<fieldset class="border">
    <div class="m-2">
        <div>
            <h3>Etape 1</h3>
        </div>
          
            <fieldset class="border mb-2">
                <div class="row">
                    <div class="form-group m-auto col-md-3">
                        <img src="https://nambinintsoatest.combo.fun/images/client/default.jpg" id="preview" class="img img-thumbnail" style="width: 150px; height: 150px;" /><br />
                        <div class="fileUpload btn btn-primary mr-2">
                            <span>Choisir image</span>
                            <input id="image" type="file" class="upload" name="image" />
                        </div>
                    </div>
                </div>
            </fieldset>
                 <div class="form-group collapse">
                    <label for="etape">Etape</label>
                    <input type="text" class="form-control form-control-sm" name="etape" id="etape" placeholder="etape" value="Etape_1" required>
                </div>
                <div class="form-group collapse">
                    <label for="nom">code Client</label>
                    <input type="text" class="form-control form-control-sm" name="codeClient" id="codeClient" placeholder="codeClient" value="<?=$codeclient?>" required>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control form-control-sm" name="nom" id="nom" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control form-control-sm" name="prenom" id="prenom" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                    <label for="date">Date de naissance</label>
                    <input type="date" class="form-control form-control-sm" name="date" id="date" required>
                </div>
                <div class="form-group ">
                    <label for="sexe">Sexe</label>
                    <div class="form-check">
                        <input type="radio" id="Masculin" name="sexe" value="masculin">
                        <label for="Masculin">Masculin</label>
                        <input type="radio" id="feminin" name="sexe" value="feminin">
                        <label for="feminin">Féminin</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="num_tel">Numéro Téléphone</label>
                    <input class="form-control contact" type="tel" id="num_tel" name="num_tel" placeholder="+261 33 32 123 12" pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" required="" maxlength="10" minlength="10">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse de livraison</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control form-control-sm" name="quartier" id="quartier" placeholder="Quartier" required>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control form-control-sm commune" name="commune" id="commune" placeholder="Commune" required>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control form-control-sm" name="district" id="district" placeholder="District" required>
                    </div>  
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse Exacte</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control form-control-sm" name="quartiers" id="quartiers" placeholder="Quartier" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control form-control-sm" name="communes" id="communes" placeholder="Commune" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control form-control-sm" name="districts" id="districts" placeholder="District" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control form-control-sm" name="lot" id="lot" placeholder="Lotissement" required>
                    </div>   
                </div>
           
        </div>
    </div>
</fieldset>
</div>
<script>
   $(document).ready(function() {
      $("#dateNaisse").datepicker();
      $.get("https://nambinintsoatest.combo.fun/images/client/" + localStorage.getItem('codeclient') + ".jpg")
         .done(function() {
            $('#preview').attr("src", "https://nambinintsoatest.combo.fun/images/client/" + localStorage
               .getItem('codeclient') + ".jpg");
         }).fail(function() {
            $('#preview').attr("src", "https://nambinintsoatest.combo.fun/images/client/default.jpg");
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
         $('.contact,.cotactlivre').on('keyup',function(){
          var valeur=$(this).val();
           if (valeur.length==9) {
               $(this).mask("+261 99 99 999 99"); 

           }
       });    
    $('.contact,.cotactlivre').on('focusout ',function(){
        var num = $(this).val();
        console.log(num.length);
        if(num.length != '17'){
            alertMessage('Erreur', 'Numero invalide.', 'error', 'btn btn-danger');
             $(this).val("");
        }
    });

    });

$('#quartier').autocomplete({
        source: base_url + "operatrice/autocomplete_quartier",
        appendTo:'#modaltache',
        select: function (e, ui) {
            $('.fade ').modal('hide');
            $.post(base_url + 'operatrice/autocomplete_ville', { quartier: ui.item.value }, function (data) {
                $.confirm({
                    title: 'choisir ville',
                    content: data,
                    buttons: {
                        formSubmit: {
                            text: 'choisir',
                            btnClass: 'btn-blue',
                            action: function () {
                                var name;
                                this.$content.find('.chose').each(function () {

                                    if ($(this).prop('checked')) {
                                        name = $(this).val();
                                    }

                                });
                                if (!name) {
                                    $.alert('provide a valid name' + name);
                                    return false;
                                }
                                $('#commune').val(name);
                                discrict_chose(name, ui.item.value);
                            }
                        },
                        cancel:{
                             text: 'Fermer',
                            btnClass: 'btn-danger', 
                            action:function () {
                            //close
                        }

                        },
                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('.chose').on('click', function (e) {
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });


            }, 'json');
        }

    });



$('#quartiers').autocomplete({
        source: base_url + "operatrice/autocomplete_quartier",
        appendTo:'#modaltache',
        select: function (e, ui) {
            $('.fade ').modal('hide');
            $.post(base_url + 'operatrice/autocomplete_ville', { quartier: ui.item.value }, function (data) {
                $.confirm({
                    title: 'choisir ville',
                    content: data,
                    buttons: {
                        formSubmit: {
                            text: 'choisir',
                            btnClass: 'btn-blue',
                            action: function () {
                                var name;
                                this.$content.find('.chose').each(function () {

                                    if ($(this).prop('checked')) {
                                        name = $(this).val();
                                    }

                                });
                                if (!name) {
                                    $.alert('provide a valid name' + name);
                                    return false;
                                }
                                $('#communes').val(name);
                                discrict_choses(name, ui.item.value);
                            }
                        },
                        cancel:{
                             text: 'Fermer',
                            btnClass: 'btn-danger', 
                            action:function () {
                            //close
                        }

                        },
                    },
                    onContentReady: function () {
                        var jc = this;
                        this.$content.find('.chose').on('click', function (e) {
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });


            }, 'json');
        }

    });

function discrict_chose(quartier, ville) {
        $.post(base_url + 'operatrice/autocomplete_discrict', { quartier: quartier, ville: ville }, function (data) {
            $.confirm({
                title: 'choisir discrict',
                content: data,
                buttons: {
                    formSubmit: {
                        text: 'choisir',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name;
                            this.$content.find('.chose').each(function () {

                                if ($(this).prop('checked')) {
                                    name = $(this).val();
                                }

                            });
                            if (!name) {
                                $.alert('provide a valid name' + name);
                                return false;
                            }
                            $('#district').val(name);
                            $('.fade').modal('show');
                            

                        }
                    },
                    cancel:{
                             text: 'Fermer',
                            btnClass: 'btn-danger', 
                            action:function () {
                            //close
                        }
                    },
                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('.chose').on('click', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });


        }, 'json');

    }


function discrict_choses(quartier, ville) {
        $.post(base_url + 'operatrice/autocomplete_discrict', { quartier: quartier, ville: ville }, function (data) {
            $.confirm({
                title: 'choisir discrict',
                content: data,
                buttons: {
                    formSubmit: {
                        text: 'choisir',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name;
                            this.$content.find('.chose').each(function () {

                                if ($(this).prop('checked')) {
                                    name = $(this).val();
                                }

                            });
                            if (!name) {
                                $.alert('provide a valid name' + name);
                                return false;
                            }
                            $('#districts').val(name);
                            $('.fade').modal('show');
                            

                        }
                    },
                    cancel:{
                             text: 'Fermer',
                            btnClass: 'btn-danger', 
                            action:function () {
                            //close
                        }
                    },
                },
                onContentReady: function () {
                    var jc = this;
                    this.$content.find('.chose').on('click', function (e) {
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });


        }, 'json');

    }


   });
</script>