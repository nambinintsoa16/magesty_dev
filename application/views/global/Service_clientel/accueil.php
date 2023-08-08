
<div class="row mt-4" >
            
    <img src="<?=base_url('images/service_clientel/banniere-livraison.jpg')?>" alt="" width="100%" height="400px"
        style="object-fit: cover;margin-top:-16px; !important;overflow: hidden;">
            
        <div class="row col-md-12 ml-1">
            <div class="col-sm-6 col-md-2">

                 <a href="<?=base_url("service_clientel/etat_de_livraison")?>"> </a>
                    <div class=" card card-stats card-round ">
                        <div class="col-md-2">
                            <button  class="btn btn-sm p-1" style="margin-top:-15px;width:50px;background:#04B4AE;height:40px;"><i class="fa fa-money fa-2x text-white"></i></button>
                        </div>
                        <div class="col-md-12 text-right mb-2">
                             <strong class="font-weight-bold count"><?=$transaction?><br><span>Transactions</span></strong>
                        </div>
                        <a href="menu_livraison" class=" card-footer text-white nav-link p-1 text-center"  style="background: #04B4AE;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                </a>
                     <!--
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#03a5cc;z-index:5;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa-truck"
                            style="z-index:0;position:absolute;font-size:26px;padding-top:15px;padding-left:15px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px;border-radius:2px">
                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                        <?=$transaction?>                     
                        </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;">
                            Livraisons</div>
                        <div
                            style="height:20px;background:#038cae;margin-top:15px;padding-top:px;text-align:center;color:white;border-radius:2px">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                    -->
               
            </div>

            <div class="col-sm-6 col-md-2">
                    <div class=" card card-stats card-round ">
                        <div class="col-md-2">
                            <button  class="btn btn-sm text-center" style="margin-top:-15px;width:50px;height:40px;background:#088A4B;"><i class="fa fa-cubes fa-2x text-white"></i></button>
                        </div>
                    <div class="col-md-12 text-right mb-2">
                        <strong class="font-weight-bold count"><?=$produit?><br><span>Produits</span></strong>
                    </div>
                    <a href="service_clientel/listedesproduit" class="card-footer text-white acclink nav-link p-1 text-center" style="background: #088A4B;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
                    </div>
                    <!--
                        <a href="<?=base_url("service_clientel/listedesproduit")?>">
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#00a65a;z-index:5;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa-cubes"
                            style="z-index:1111;position:absolute;font-size:26px;padding-top:15px;padding-left:15px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px">
                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                        <?=$produit?>
                        </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;">
                            Produits</div>
                        <div
                            style="height:20px;background:#00a65a;margin-top:15px;padding-top:px;text-align:center;color:white">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                     <a>
                    -->
             </div>
            <div class="col-sm-6 col-md-2">
                <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-warning btn-sm p-1" style="margin-top:-15px;width:50px;height:40px;"><i class="fa fa-users fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count "><?=$client?><br><span>Clients</span></strong>
                </div>
                <a href="<?=base_url('service_clientel/clients/Liste_des_clients')?>" class="card-footer bg-warning acclink text-white nav-link p-1 text-center">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
                 <!--
                <a href="<?=base_url("service_clientel/clients/Liste_des_clients")?>">
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#f39c11;z-index:5;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa fa-users"
                            style="z-index:1111;position:absolute;font-size:26px;padding-top:15px;padding-left:15px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px">
                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                        <?=$client?>
                        </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;">
                            Clients</div>
                        <div
                            style="height:20px;background:#f39c11;margin-top:15px;padding-top:px;text-align:center;color:white">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                    <a>
                    -->
            </div>


            <div class="col-sm-6 col-md-2">
                <div class=" card card-stats card-round ">
                    <div class="col-md-2">
                        <button  class="btn btn-sm" style="margin-top:-15px;width:50px;height:40px;background: #86B404;"><i class="fa fa-pencil-square-o fa-2x text-white"></i></button>
                    </div>
                    <div class="col-md-12 text-right mb-2">
                        <strong class="font-weight-bold count"><br><span>Commandes</span></strong>
                    </div>
                <a href="<?=base_url('ervice_clientel/commande')?>" class="card-footer text-white nav-link p-1 text-center" style="background: #86B404;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
                <!--
                <a href="<?=base_url("service_clientel/commande")?>">
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#8fc229;z-index:5;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa-edit"
                            style="z-index:1111;position:absolute;font-size:26px;padding-top:15px;padding-left:20px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px">

                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                           
                        </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;margin-top:20px">
                            Commandes</div>
                        <div
                            style="height:20px;background:#8fc229;margin-top:15px;padding-top:px;text-align:center;color:white">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                    </a>
                .info-box-->

            </div>
            <!--/.col-->
            
            <div class="col-sm-6 col-md-2">
                 <div class=" card card-stats card-round ">
                <div class="col-md-2">
                    <button  class="btn btn-danger btn-sm" style="margin-top:-15px;width:50px;height:40px;"><i class="fa fa-calendar fa-2x text-white"></i></button>
                </div>
                <div class="col-md-12 text-right mb-2">
                    <strong class="font-weight-bold count "><br><span>Calendrier</span></strong>
                </div>
                <a href="service_clientel/Calendrierdelivraison" class="card-footer bg-danger acclink text-white nav-link p-1 text-center">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></a>
            </div>
                <!--
                <a href="<?=base_url('service_clientel/Calendrierdelivraison')?>">
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#e1321d;z-index:0;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa-calendar"
                            style="z-index:0;position:absolute;font-size:26px;padding-top:15px;padding-left:18px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px">

                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                  
                        </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;;margin-top:20px">
                            Calendriers</div>
                        <div
                            style="height:20px;background:#e1321d;margin-top:15px;padding-top:px;text-align:center;color:white">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                     </a>
                    /.info-box-->
            </div>
            <!--/.col-->
            
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
                <!--
                <a href="<?=base_url('service_clientel/livraisondujourAttent')?>">
                    <div
                        style="position:relative;border-radius:50%;margin-left:10px;margin-top:-15px;width:60px;height:60px;background:#12648a;z-index:5;border-radius:5px;box-shadow: 1px 1px #ddd;">
                        <i class="fa fa-play"
                            style="z-index:1111;position:absolute;font-size:26px;padding-top:15px;padding-left:20px;color:#fff"></i>

                    </div>
                    <div style="background-color:#fff;min-height:80px;color:#000;margin-top:-40px">

                        <div style="text-align:right;padding-top:5px;padding-right:10px">
                     </div>
                        <div class="count" style="text-align:right;padding-right:10px;font-size:16px;font-weight:bold;padding-top: 17px">
                            Autres</div>
                        <div
                            style="height:20px;background:#12648a;margin-top:15px;padding-top:px;text-align:center;color:white">
                            Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i></div>
                    </div>
                    </a>
                    /.info-box-->
            </div>
            <!--/.col-->
            
        </div> 
       
        <div  class="row col-md-12" style="margin-top:-20px;">
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
                        <canvas class="fas fa-car-side" style="width:100%;height: 115px;" id="att"></canvas>
                    </div>
                    <div class="col-md-8" style="background:#04d073;min-height:120px;">
                        <div style="padding-top:10px">
                            <span class="text-center">Livraison Confirmée</span><br>
                            <span class="text-center" style="font-size:30px" id="data_conf"><?=number_format($confirmer)?></span>%<br>

                            <div class="progress thin" style="background-color:#97a0a9;height: 2px;margin-top: 10px!important;">
                                <div  class="progress-bar progress-bar-succes" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$confirmer?>%;background-color:#fff;">
                                       
                                </div>
                            </div>
                             <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                        </div>

                    </div>
                </div>
            </div>
            <div  class="col-md-4" style="margin-top:-15px">
                <div class="row" style="margin-right:0px;margin-left:0px;border:solid 5px #fff">
                    <div class="col-md-4" style="background:#03a5cc;min-height:120px;">
                        <canvas style="width:100%;height: 115px;" id="livre"></canvas>
                    </div>

                    <div class="col-md-8" style="background:#2a80b9;min-height:120px;">
                        <div style="padding-top:10px">
                            <span  class="text-center">Livraison réalisée</span><br>
                            <span class="text-center" style="font-size:30px" id="data_livre"><?=number_format($livre)?></span>%<br>
                            <div class="progress thin" style="background-color: #91b5cd;height:2px;margin-top: 10px!important;">
                                 <div class="progress-bar" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$livre?>%;background-color:#fff;">

                                </div>
                                      
                            </div>
                                <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                        </div>
                    </div>
                </div>

            </div>
          
              
            <div class="col-md-4" style="margin-top:-15px">
                <div class="row" style="margin-right:0px;margin-left:0px;border:solid 5px #fff">
                    <div class="col-md-4" style="background:#c0062b;min-height:120px;">
                        <canvas style="width:100%;height: 115px;" id="Annul"></canvas>
                    </div>

                    <div class="col-md-8" style="background:#e30832;min-height:120px;">
                    <div style="padding-top:10px">
                      <span class="text-center">Livraison Annulée</span><br>
                      <span class="text-center" style="font-size:30px" id="data_annul"><?=number_format($annule)?></span>%<br>
                      <div class="progress thin" style="background-color:#e08396;height: 1px;color: white;margin-top: 10px!important;">
                          <div class="progress-bar progress-bar-succes" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width:<?=$annule?>%;background-color:#fff;">
                          </div>
                          
                        </div>
                           <span style="color: white;position: absolute;margin-top: -2px;">Progression</span>
                        </div>
                    </div>
                </div>
        </div>
                                      
    

    </div>
</div>
</div>
       