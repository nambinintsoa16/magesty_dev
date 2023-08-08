<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12" >
                <ol class="breadcrumb" style="height:50px;">
                    <li><i class="fa fa-home"></i><a href="?page=">Accueil</a></li>
                       <li><i class="fa fa-home"></i>Livraison</li>
                   </li>
                   
                </ol>
                
            </div>
        </div>
        <div class="row banniere_livraison">
            <div class="col-md-12">
                <img src="../img/livraison910.jpg" alt="" height="400" width="100%"
                    class="bann_image">
            </div>
            <<div class="col-md-12" style=";margin-top: -50px;margin-right:0px;">
              <div style="background: black;height: 50px;">
                  <span class="pull-left" style="font-size:20px;color:white;padding-left:15px;padding-top: 10px"> Livraison du <?=date("d-m-Y")?>  à <?php
                  $sql2 = "SELECT CURRENT_TIME ";
                  $result2=$main->fetch($sql2);
                  echo  $result2->CURRENT_TIME;
                  
?> </span>
              </div>
            </div>
        </div>
        <div class="row menulivraison" >
           
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="<?=base_url('service_clientel/listeruser')?>">
                    <div class="bloc_menu1">
                        <div class="icon_block1" style="margin-top: 40px!important">
                           <i class="fa fa-money"></i> 
                        </div>
                        
                        <div class="block_nombre1">
                          <?= number_format($main->ca_par_type_clientel('livre',date('Y-m-d')), 2, ',', ' ')?>
                        </div>
                        <div class="block_titre1" style="padding-top:5px"> Chiffre d'Affaires du jour</div>
                        <div class="plus_info1">
                          Plus  d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                    <a>

            </div>

 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="<?=base_url('service_clientel/produit')?>">

                    <div class="bloc_menu">
                        <div class="icon_block" style="margin-top: 40px!important">
                             <i class="fa fa-cubes"></i>
                        </div>
                       
                        <div class="block_nombre">
                            <?=$main->nombre_de_Produit_clientel(date('Y-m-d'),'livre')?>
                        </div>
                        <div class="block_titre"> Produits livrés </div>
                        
                        <div class="plus_info">
                           Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <a href="<?=base_url('service_clientel/Livraison_du_jour')?>"> 

                    <div class="bloc_menu">
                        <div class="icon_block" style="margin-top: 40px!important">
                             <i class="fa fa-calendar"></i>
                        </div>
                       
                        <div class="block_nombre">
                        <?=number_format($main->ca_par_type_clientel('En_attente',date('Y-m-d')), 2, ',', ' ')?>
                        </div>
                        <div class="block_titre">Calendrier de livraison </div>
                        
                        <div class="plus_info">
                           Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </a>
            </div>


               
 </div>
