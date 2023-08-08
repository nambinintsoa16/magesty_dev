<div class="row" style="background-color:#fff;border-radius:5px;padding: 10px; ">
    <div class="form-group">
                <table class="table table-hove table-stripted table-bordered">
                    <thead style="color: #fff!important"> 
                    <tr>    
                        <th>Id</th>
                        <th>Code client </th>
                        <th>Nom et Prénom</th>
                        <th>Contact</th>
                        <th>Identifient sur facebook</th>
                        <th>Lien sur facebook</th>
                        <th>Photo</th>
                        <th></th>
                  </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client as $client): ?>
                            <tr>
                                <td><?= $client->id?></td>
                                <td><?= $client->Code_client; ?></td>
                                <td><?= $client->Nom." ".$client->Prenom ?></td>
                                <td><?= $client->Contact; ?></td>
                                <td><?= $client->Compte_facebook; ?></td>
                                <td><?= $client->Compte_facebook; ?></td>
                                <td><img src="<?=base_url('images/client/'.$client->Code_client.'.jpg');?>" class="img-thumbnail" style="width:60px;height: 60px;"></td>
                                <th><a href="<?=base_url('operatrice/clients/detail/'.$client->Code_client)?>" class="btn btn-primary"><i class="fa fa-info"><i></a></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><?=$links?></p>
            </div>
</div>            