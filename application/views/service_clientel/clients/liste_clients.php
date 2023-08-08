<div class="column">
                <table class="table table-hove datatable">
                    <thead class="bg-danger"> 
                    <tr>    <th>Id</th>
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
                                <td><?= $client->Id; ?></td>
                                <td><?= $client->Code_client; ?></td>
                                <td><?= $client->Nom." ".$client->Prenom ?></td>
                                <td><?= $client->Contact; ?></td>
                                <td><?= $client->Compte_facebook; ?></td>
                                <td><?= $client->Compte_facebook; ?></td>
                                <td><?= $client->Code_client ;?></td>
                                <th><a href="<?=base_url('operatrice/clients/detail/'.$client->Code_client)?>" class="btn btn-primary"><i class="fa fa-info"><i></a></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><?=$links?></p>
            </div>