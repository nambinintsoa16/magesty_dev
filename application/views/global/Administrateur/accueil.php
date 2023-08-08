<div class="row mt-4">
    <img src="<?=base_url('assets/img/administrateur-système.jpg')?>" alt="" width="100%" height="400px"style="object-fit: cover;margin-top:-16px;overflow: hidden;">
    <div class="row col-md-12 ml-1">
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-sm p-1" style="margin-top:-15px;width:50px;background:#04B4AE;height:40px;"><i class="fa fa-money fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count"><?=$transaction?><br><span>Transactions</span></strong>
                </div>
                <a href="menu_livraison" class=" card-footer text-white nav-link p-1 text-center"  style="background: #04B4AE;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
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
                <a href="operatrice/calendrier_de_livraison" class="card-footer bg-danger acclink text-white nav-link p-1 text-center">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class=" card card-stats card-round">
                <div class="col-md-2">
                    <button  class="btn btn-sm" style="margin-top:-15px;width:50px;background:#0B4C5F;"><i class="fa fa-play fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count"><br><span>Autres</span></strong>
                </div>
                <a href="?page=infoetreclamation" class="card-footer text-white nav-link p-1 acclink text-center" style="background:#0B4C5F;height:40px;">Plus d'info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row col-md-12" style="margin-top:-20px;">
        <ol class="breadcrumb col-md-12 d-flex p-1 ml-3" style="height:40px;">
            <li class="ml-3 mt-2"><i class="fa fa-truck"></i></li>
            <li><a href="#" class="nav-link ml-1">Etat de vente du : <b class="text-dark">
                <?=dateDuJour()?></b></a></li>
        </ol>
    </div>

    <div class="row w-100 ml-1 mt-2" style="color:#fff">
        <div class="col-md-4" style="margin-top:-15px">
            <div class="row" style="margin-right:0px;margin-left:0px;border:solid 5px #fff">
                <div class="col-md-4" style="background:#00a65a;min-height:120px;">
                    <canvas  style="width:100%;height: 115px;" id="livre"></canvas>
                </div>
                <div class="col-md-8" style="background:#04d073;min-height:120px;">
                    <div style="padding-top:10px">
                        <span class="text-center">Vente effectuée</span><br>
                        <span class="text-center" style="font-size:30px" id="data_livre"><?=number_format($livre)?></span>%<br>
                        <div class="progress thin" style="background-color:#97a0a9;height: 2px;margin-top: 10px!important;">
                            <div class="progress-bar progress-bar-succes" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$livre?>%;background-color:#fff;"></div>
                        </div>
                        <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="margin-top:-15px">
            <div class="row" style="margin-right:0px;margin-left:0px;border:solid 5px #fff">
                <div class="col-md-4" style="background:#03a5cc;min-height:120px;">
                    <canvas style="width:100%;height: 115px;" id="att"></canvas>
                </div>
                <div class="col-md-8" style="background:#05bfec;min-height:120px;">
                    <div style="padding-top:10px">
                        <span class="text-center">Vente Confirmée</span><br>
                        <span class="text-center" style="font-size:30px" id="data_conf"><?=number_format($confirmer)?></span>%<br>
                        <div class="progress thin" style="background-color: #91b5cd;height:2px;margin-top: 10px!important;">
                            <div class="progress-bar" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$confirmer?>%;background-color:#fff;"></div>
                        </div>
                        <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" style="margin-top:-15px">
            <div class="row" style="margin-right:0px;margin-left:0px;border:solid 5px #fff">
                <div class="col-md-4" style="background:#c0062b;min-height:120px;">
                    <canvas  style="width:100%;height: 115px;" id="Annul"></canvas>
                </div>
                <div class="col-md-8" style="background:#e30832;min-height:120px;">
                    <div style="padding-top:10px">
                        <span class="text-center">Vente Annulée</span><br>
                        <span class="text-center" style="font-size:30px" id="data_annul"><?=number_format($annule)?></span>%<br>
                        <div class="progress thin" style="background-color:#e08396;height: 1px;color: white;margin-top: 10px!important;">
                            <div class="progress-bar progress-bar-succes" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$annule?>%;background-color:#fff;"></div>
                        </div>
                        <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

