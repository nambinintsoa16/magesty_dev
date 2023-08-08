<div class="row p-2">
       <div class="form-group col-md-12 m-0">
       <div class="pull-right card p-2 m-0" id="search-nav">
						<form class="navbar-right navbar-form nav-search mr-md-3" action="<?=base_url("$type_user/Clients/Recherche")?>" method="post">
							<div class="input-group">
                            <input type="text" name="mot" placeholder="Rechercher ..." class="form-control">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search ">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								
							</div>
						</form>
					</div>
       </div> 
        <div class="form-group col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered tableClient table-hover table-striped w-100">
                    <thead  class="bg-<?=$nav_color?> text-light">
                        <tr>
                            <th>Id</th>
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
                            <td><?= $client->id?></td>
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
                <p><?=$links?></p>
            </div>
        </div>
    </div>




          