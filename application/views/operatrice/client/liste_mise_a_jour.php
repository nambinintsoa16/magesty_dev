
<div class="form-group contentTable table-striped">

    <span class="date_collapse collapse"> <?php echo $date; ?></span>

        <table class="table table-striped table-hover table-bordered  table-responsive nowrap miavaka">
            <thead>
                <tr class="bg-secondary text-white">
                    <th class="text-center">Code client</th>
                    <th class="text-center">Nom client</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Page / Compte</th> 
                    <th class="text-center">Status</th> 
                    <th></th>                
                </tr>
            </thead>
                <tbody class="tbody">
                    <?php  $i = 1;?>
                    <?php foreach ($listeclient7 as $value): ?>

                    <tr>                            
                        <td><a href="#" class="client0007 code_client<?= $i; ?>"><?= $value->code_client?></a></td>
                        <td class="compte<?= $i; ?>"><?= $value->compte_facebook?></td>
                        <td class="lien<?= $i; ?>"><?= $value->lien_facebook?></td>
                        <td class="page<?= $i; ?>"><?= $value->nom_page?></td>
                        <td class="text-center"><?php $statut = $this->global_model->testlistesmaj($this->session->userdata('matricule'),$value->code_client); if($statut >= 1){ echo '<i class="fa fa-check-circle text-success" ></i>'; }else{ 
                        echo '<i class="fa fa-times-circle text-danger"></i>'; } ?></td>
                        <td><a class="btn btn-primary maj" href="#"> <i class="fa fa-refresh"></i></td>
                       
                    </tr>
                    <?php  $i++;?>
                    <?php endforeach ?>
                        
                </tbody>
    </table>      
    <form action="<?php /**  base_url().'Operatrice/add_via_exel_file' */?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">

            <div class="input-group mb-3">
                <input type="file" class="form-control" placeholder="Upload Fichier excel" aria-label="Upload Fichier excel" aria-describedby="button-addon2" name="file" id="file">
                <button class="btn btn-outline-success" type="button" id="button-addon2"><i class="fa fa-upload"></i></button>
            </div>

         </div>
    </form>
</div>