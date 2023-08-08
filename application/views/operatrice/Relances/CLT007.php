<form class="col-md-12">
  <fieldset class="border p-1">
    <legend class="w-auto"><b class="text-sm">
                    LISTE DES CLIENTS CLT007<i class="flaticon-chat-4 supporttrc014" style="color:red; margin-left: 50px;" aria-hidden="true"></i></b>
    </legend>
    <div class="row col md-12">
      <div class="col md-4">Nombre clients: <?= count($this->global_model->clientctl007($this->session->userdata('page')));?> </div>
      <div class="col md-4"> Traités: <?= $this->global_model->testchecks(date('Y-m-d'),$this->session->userdata('matricule')); ?></div> 
      <div class="col md-4">Non traités: <?= count($this->global_model->clientctl007($this->session->userdata('page'))) - $this->global_model->testchecks(date('Y-m-d'),$this->session->userdata('matricule'));?></div>
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
              <th class="text-center">Lien facebook</th>
              <th class="text-center">Page / Compte</th> 
              <th class="text-center">Status</th> 
              <th class="text-cente"></th>
                                                     
            </tr>
          </thead>
          <tbody class="tbody">  
                <?php foreach ($listeclient as $value): ?>
                   <tr>
                    
                    <td><a href="#" class="client0007"><?= $value->Code_client?></a></td>
                    <td><a href="<?= $value->lien_facebook?>" target="_blank">  <?= $value->Compte_facebook?></a></td>
                    <td><?= $value->lien_facebook?></td>
                    <td><?= $value->Nom_page?></td>
                    <td class="text-center"><?php $statut = $this->global_model->testcheck(date('Y-m-d'),$this->session->userdata('matricule'),$value->Code_client); if($statut >= 1){ echo '<i class="fa fa-check " style="color:green" aria-hidden="true"></i>'; }else{ 
                      echo '<i class="fa fa-times-circle text-danger" style="color:red" aria-hidden="true"></i>'; } ?></td>
                    <td><a class="btn btn-primary discussion" href="#"> <i class="fa fa-envelope"></i></td>
                    </tr>
                    
                <?php endforeach ?>                      
                   
          </tbody>
        </table>      
  </div>


    