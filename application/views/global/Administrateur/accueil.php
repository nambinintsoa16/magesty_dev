<div class="row mt-4">
    <img src="<?=base_url('assets/img/administrateur-système.jpg')?>" alt="" width="100%" height="400px"style="object-fit: cover;margin-top:-16px;overflow: hidden;">
    <div class="row col-md-12 ml-1">
        <div class="col-sm-6 col-md-3">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-sm p-1" style="margin-top:-15px;width:50px;background:#04B4AE;height:40px;"><i class="fa fa-money fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count"><?=$transaction?><br><span>Génére liste enquête</span></strong>
                </div>
                <a href="#" id="update_liste_enquette" class=" card-footer text-white nav-link p-1 text-center"  style="background: #04B4AE;">Clicker ici<i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-sm text-center" style="margin-top:-15px;width:50px;height:40px;background:#088A4B;"><i class="fa fa-cubes fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count"><?=$produit?><br><span>Produits</span></strong>
                </div>
                <a href="operatrice/Produits/Liste_des_produits" class="card-footer text-white acclink nav-link p-1 text-center" style="background: #088A4B;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-warning btn-sm p-1" style="margin-top:-15px;width:50px;height:40px;"><i class="fa fa-users fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count "><?=$client?><br><span>Clients</span></strong>
                </div>
                <a href="<?=base_url('operatrice/Clients/Mes_clients')?>" class="card-footer bg-warning acclink text-white nav-link p-1 text-center">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-sm" style="margin-top:-15px;width:50px;height:40px;background: #86B404;"><i class="fa fa-pencil-square-o fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count"><br><span>Tâche</span></strong>
                </div>
                <a href="<?=base_url('operatrice/Tache')?>" class="card-footer text-white nav-link p-1 text-center" style="background: #86B404;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-danger btn-sm" style="margin-top:-15px;width:50px;height:40px;"><i class="fa fa-calendar fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count "><br><span>Calendrier</span></strong>
                </div>
                <a href="operatrice/calendrier_de_livraison" class="card-footer bg-danger acclink text-white nav-link p-1 text-center">Clicker ici<i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
    </div>
    </div>
</div>

