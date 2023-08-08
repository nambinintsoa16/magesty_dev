<form class="col-md-12">
  <fieldset class="border p-1">
    <legend class="w-auto"><b class="text-sm">
                    LISTE DES J'AIME</b>
    </legend>
    <div class="row col md-12">
      <div class="col md-4">Nombre clients: <?= count($this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('page')));?> </div>
      <div class="col md-4"> Traités:<?php echo $this->global_model->JAIME($this->session->userdata('matricule'));?></div> 
      <div class="col md-4">Non traités: <?= count($this->global_model->reactionjaime(date('Y-m-d'),$this->session->userdata('page'))) - $this->global_model->JAIME($this->session->userdata('matricule'));?> </div>
    </div>    
  </fieldset>
</form>
  <div class="form-group contentTable table-striped ">
      <span class="date_collapse collapse"></span>

        <table class="table table-striped table-hover table-bordered dt-responsive nowrap dataTables">
          <thead class="bg-<?=$nav_color?> text-white">
            <tr >
              <th>N°</th>
              <th class="text-center">Date de publication</th>
              <th class="text-center">Nom client</th>
              <th class="text-center">Lien facebook</th>
              <th class="text-center">Page</th> 
              <th class="text-center">Status</th> 
                                                     
            </tr>
          </thead>
          <tbody class="tbody">                  
               <?php echo $jaimess?> 
          </tbody>
        </table>      
  </div>


    