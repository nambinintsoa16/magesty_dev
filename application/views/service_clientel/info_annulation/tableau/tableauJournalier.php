<div class="row">
    <div class="responsive w-100" style="height: 460px; overflow: scroll;">
        <table class="table table-striped mt-4 table-bordered dataTable w-100 text-center" >
            <thead class="bg-primary text-white" id="headTable">
                <tr>
                    <th>Client</th> 
                    <th>Photo</th> 
                    <th>Somme</th>
                    <th>Code d'annulation</th>
                    <th>Motif</th>
                    <th>Remarque</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($datas as $datas):?>
                     <tr>
                    <td><?= $datas->Code_client?></td> 
                    <td>
                      <img class="photosclient avatar-img rounded" src="<?=code_client_img_link($datas->Code_client)?>"style="width:50px;height:50px;">
                    </td> 
                    <td></td>
                    <td><?= $datas->code_annul?></td>
                    <td><?= $datas->contenu?></td>
                    <td><?= $datas->remarque_livreur?></td>
                </tr>
                 <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>    