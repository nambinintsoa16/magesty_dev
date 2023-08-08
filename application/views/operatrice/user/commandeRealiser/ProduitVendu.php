<div class="row">
    <div class="responsive">
        <table class="table table-striped table-striped-bg-danger mt-4">
            <thead class="bg-info text-white">
                <tr>
                    <th>Code client</th> 
                    <th>Identifient sur facebook </th>
                    <th>Lien sur facebook </th>
                     <th>Photo</th>
                </tr>
                </thead>
                <tbody>
                        
                <?php  foreach ($client as $key => $client) : ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><img src="<?=code_client_img_link($client->Code_client)?>" class="img-thumbnail" width="50" height="50"></td>
                    </tr>
                 <?php endforeach;?>
                        
                </tbody>
        </table>
    </div>
</div>    

            