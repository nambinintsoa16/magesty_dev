<div class="row">
       <div class="form-group col-md-12">
            <div class="pull-right" id="search-nav" style="background-color: #48ABF7">
					<form class="mr-3" action="<?=base_url("$type_user/Clients/Recherche")?>" method="post">
						<div class="input-group">
                            <input type="text" name="mot" placeholder="Rechercher ..." class="form-control border-0 rounded-0">
							<div class="input-group-prepend my-auto">
								<button type="submit" class="btn btn-search" style="background-color: white">
										<i class="fa fa-search search-icon"></i>
								</button>
							</div>
								
						</div>
					</form>
			</div>
       </div> 
        <div class="form-group col-md-12">
            <div class="table-responsive pl-3" style="height: 57.5vh">
                <table class="table table-hover w-100">
                    <thead  class="bg-<?=$nav_color?> text-light sticky-top">
                        <tr>
                            <th hidden>Id</th>
                            <th>Code Client</th>
                            <th>Photo</th>
                            <th>Nom et Prénom</th>
                            <th>Contact</th>
                            <th>Identifiant sur facebook</th>
                            <th>Lien sur facebook</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($client as $client): ?>
                        <tr>
                            <td hidden><?= $client->id?></td>
                            <td><?= $client->Code_client; ?></td>
                            <td><img src="<?=code_client_img_link($client->Code_client)?>"class="avatar-img rounded-circle" style="width:50px;height: 50px;"></td>
                            <td><?= $client->Nom." ".$client->Prenom ?></td>
                            <td><?= $client->Contact; ?></td>
                            <td><?= $client->Compte_facebook; ?></td>
                            <td><?= $client->Compte_facebook; ?></td>
                            <th style="padding-top:22px;"><a href="<?=base_url("$type_user/Clients/detail_client/$client->Code_client")?>" class="btn btn-info btn-sm"><i class="fa fa-info"><i></a></th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-3">
                <p><?=$links?></p>
            </div>
        </div>
    </div>




          