<form class="col-md-12">
  <fieldset class="border p-1">
    <legend class="w-auto"><b class="text-sm">
                    LISTE DES CLIENTS AAC007<i class="flaticon-chat-4" style="color:red; margin-left: 50px;" aria-hidden="true"></i></b>
    </legend>
    <div class="row col md-12">
      <div class="col md-4">Nombre clients: <?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))); ?> </div>
      <div class="col md-4"> Traités: <?php echo $this->global_model->AAC07($this->session->userdata('matricule'));?></div> 
      <div class="col md-4">Non traités: <?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))) - $this->global_model->AAC07($this->session->userdata('matricule')) ?></div>
    </div>    
  </fieldset>
</form>


  <div class="form-group contentTable table-striped ">
      <span class="date_collapse collapse"></span>

        <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTables">
          <thead class="bg-<?=$nav_color?> text-white">
            <tr >
              <th class="text-center">Code client</th>
              <th class="text-center">Nom client</th>
              <th class="text-center">Page / Compte</th> 
              <th class="text-center">Status</th> 
                                                     
            </tr>
          </thead>
          <tbody class="tbody">  
             <?php foreach ($listeclient7 as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testlistes(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client,'PROP_CLT_AAC07'); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger"></i>'; } ?></td>
                    
                    </tr>
                <?php endforeach ?>                            
                   
          </tbody>
        </table>      
  </div>
<script >
  $(document).ready(function(){
    alert();


    $('.client0007').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/client_details', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-12',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',
                    buttons: {
                    fermer: {
                        btnClass: 'btn-red text-center', // multiple classes.
                        
                    },
                }

            });
        });

    });

    
    
});

</script>
    