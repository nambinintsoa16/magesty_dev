<form class="col-md-12">
  <fieldset class="border p-1">
    <legend class="w-auto"><b class="text-sm">
                    RAPPORT DES RELANCES</b>
    </legend>
    
  </fieldset>
</form>
<div class="form-group contentTable table-striped ">
      <span class="date_collapse collapse"></span>

        <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTables">
          <thead class=" bg-<?=$nav_color?> text-white">
            <tr >
              <th class="w-40">TYPES DES RELANCES</th>
              <th class="text-center">NOMBRE DES CLIENTS A TRAITES</th>
              <th class="text-center">CLIENTS TRAITES</th> 
              <th class="text-center">CLIENTS NON TRAITES</th>                               
            </tr>
          </thead>
          <tbody class="tbody"> 
          	<tr>
             	<td class="w-40">ACC007</td>
             	<td class="text-center"><?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?= $this->global_model->AAC07($this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?= count($this->global_model->client_a_traiterAAC7($this->session->userdata('page'))) - $this->global_model->AAC07($this->session->userdata('matricule')); ?></td>
             </tr> 
             <tr>
              <td class="w-40">ACC014</td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),14,'PROD014')); ?></td>
              <td class="text-center"><?= $this->global_model->ACC14($this->session->userdata('matricule')); ?></td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),14,'PROD014')) - $this->global_model->ACC14($this->session->userdata('matricule')); ?></td>
             </tr>
             <tr>
              <td class="w-40">ACC021</td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021')); ?></td>
              <td class="text-center"><?= $this->global_model->ACC21($this->session->userdata('matricule')); ?></td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),21,'PROD021')) - $this->global_model->ACC21($this->session->userdata('matricule')); ?></td>
             </tr>
             <tr>
             	<td class="w-40">ACC028</td>
             	<td class="text-center"><?php echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?php echo $this->global_model->ACC28($this->session->userdata('matricule'));?></td>
             	<td class="text-center"><?php echo count($this->global_model->client_a_traiterAAC28($this->session->userdata('page'))) - $this->global_model->ACC28($this->session->userdata('matricule'));?></td>
             </tr>
             <tr>
              <td class="w-40">ACC035</td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),35,'PROD035')); ?></td>
              <td class="text-center"><?= $this->global_model->AAC07($this->session->userdata('matricule')); ?></td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),35,'PROD035')) - $this->global_model->AAC07($this->session->userdata('matricule')); ?></td>
             </tr>
             <tr>
              <td class="w-40">ACC042</td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),42,'PROD042')); ?></td>
              <td class="text-center"><?= $this->global_model->ACC42($this->session->userdata('matricule')); ?></td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),42,'PROD042')) - $this->global_model->ACC42($this->session->userdata('matricule')); ?></td>
             </tr>
              <tr>
             	<td class="w-40">ACC049</td>
             	<td class="text-center"><?= count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?php echo $this->global_model->ACC49($this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?php echo count($this->global_model->client_a_traiterAAC49($this->session->userdata('page'))) - $this->global_model->ACC49($this->session->userdata('matricule')); ?></td>
             </tr>
             <tr>
              <td class="w-40">ACC056</td>
              <td class="text-center"><?= count($this->global_model->relance_produit($this->session->userdata('page'),56,'PROD056')); ?></td>
              <td class="text-center"><?php echo $this->global_model->ACC56($this->session->userdata('matricule')); ?></td>
              <td class="text-center"><?php echo count($this->global_model->relance_produit($this->session->userdata('page'),56,'PROD056')) - $this->global_model->ACC56($this->session->userdata('matricule')); ?></td>
             </tr>
              <tr>
             	<td class="w-40">ACC070</td>
             	<td class="text-center"><?= count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?php echo $this->global_model->ACC70($this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?php echo count($this->global_model->client_a_traiterAAC70($this->session->userdata('page'))) - $this->global_model->ACC70($this->session->userdata('matricule')); ?></td>
             </tr>
              <tr>
             	<td class="w-40">CLT007</td>
             	<td class="text-center"><?= count($this->global_model->clientctl007($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?= $this->global_model->testchecks(date('Y-m-d'), $this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?= count($this->global_model->clientctl007($this->session->userdata('page'))) - $this->global_model->testchecks(date('Y-m-d'), $this->session->userdata('matricule')); ?></td>
             </tr>
             <tr>
             	<td class="w-40">VENTES NON LIVREES</td>
             	<td class="text-center"><?= count($this->global_model->vente_non_livre($this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?php echo $this->global_model->VENTENONLIVREE($this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?= count($this->global_model->vente_non_livre($this->session->userdata('page'))) - $this->global_model->VENTENONLIVREE($this->session->userdata('matricule')); ?></td>
             </tr>
              <tr>
             	<td class="w-40">RENDEZ-VOUS</td>
             	<td class="text-center">0</td>
             	<td class="text-center">0</td>
             	<td class="text-center">0</td>
             </tr>
              <tr>
             	<td class="w-40">PROSPECTION CLIENT</td>
             	<td class="text-center"><?= count($this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('page'))); ?></td>
             	<td class="text-center"><?php echo $this->global_model->JAIME($this->session->userdata('matricule')); ?></td>
             	<td class="text-center"><?= count($this->global_model->reactionjaime(date('Y-m-d'), $this->session->userdata('page'))) - $this->global_model->JAIME($this->session->userdata('matricule')); ?></td>
             </tr>
          </tbody>
        </table>      
  </div>



    