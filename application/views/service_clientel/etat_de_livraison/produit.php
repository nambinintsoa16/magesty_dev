
 <div class="container">
  <div class="row justify-content-between">
      <div class="card ml-5 test" style="width:18%;">
    <a href="#" id="all" class="nav-link"  data-toggle="modal" data-target="#LV">    
        <div class="row" >
            <div class="col-md-4" style="background:#03a5cc;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
               <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
              Commandés <br>
            Nombre: <?= $nbC ?> <br>
            CA: <?= number_format($caC, 0, 0," ") ?> Ar
            </div>
        </div>
        </a>
    </div>
    <div class="card" style="width:18%;">
    <a href="#" id="livre"  class="nav-link"  data-toggle="modal" data-target="#LV"> 
    <div class="row">
            <div class="col-md-4" style="background:#00a65a;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
                Livrés <br>
               Nombre: <?= $nbL ?> <br>
               CA: <?= number_format($caL, 0, 0," ") ?> Ar
                         
            </div>
        </div>
        </a>
    </div>
    <div class="card" style="width:18%;">
    <a href="#" id="annule"  class="nav-link"  data-toggle="modal" data-target="#LV"> 
    <div class="row">
            <div class="col-md-4 bg-danger" style="height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
               Non Livrés <br>
               Nombre: <?= $nbAn ?> <br>
               CA: <?= number_format($caAn, 0, 0," ") ?> Ar
                         
            </div>
        </div>
        </a>
    </div>
    <div class="card" style="width:18%;">
    <a href="#"  class="nav-link" id="confirmer"  data-toggle="modal" data-target="#LV">    
    <div class="row"  >
            <div class="col-md-4 bg-primary" style="height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
              Confirmés<br/>
                Nombre: <?= $nbCo ?> <br>
                CA: <?= number_format($caCo, 0, 0," ") ?> Ar
            </div>
        </div>
        </a>
    </div>
 <div class="card" style="width:18%;">
    <a href="#"  class="nav-link" id="en_attente"  data-toggle="modal" data-target="#LV">  
    <div class="row"  >
            <div class="col-md-4 bg-warning" style=";height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-top-left-radius: 5px;border-top-left-radius: 5px">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:29px;padding-left:5px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;border-top-right-radius: 5px;border-bottom-right-radius: 5px">
              A confirmer<br/>
                Nombre : <?= $nbAc ?> <br>
                CA: <?= number_format($caAc, 0, 0," ") ?> Ar

            </div>
        </div>
        </a>
    </div> 



   
</div> 
</div> 
<div class="row bg-white">     
   <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
        <a href="#"  data-toggle="modal" data-target="#defaultModal" id="deoparfum" style="text-decoration:none;">   
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/deo.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">DEO & PARFUM</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?php echo $deoparfum['all']->qt;?></b> </b>
                      <br>Livrés : <b class="pull-right">  <?php echo $deoparfum['livre']->qt;?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $deoparfum['annule']->qt;?></b>
                      <br>Confirmer : <b class="pull-right"> <?php echo $deoparfum['confirmer']->qt;?></b>
                      <br>A confirmer :<b class="pull-right">  <?php echo $deoparfum['en_attente']->qt;?></b>

                  </p>
            </div>
          </div>
        </a>
    </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
            <a href="#" id="hygienCor"  data-toggle="modal" data-target="#defaultModal" style="text-decoration:none;">    
              <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/hygienne.png")?>');height:200px;background-size:cover;overflow:hidden">
                <div class="col-md-5">
                   
                </div>

                <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                    <p style="z-index:2;color:white">
                         <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE CORPORELLE</h3>
                      </p>
                      <p style="text-align:left;z-index:2;color:black">
                 
                      Commandés : <b class="pull-right"><?php echo $hygienCor['all']->qt;?></b> </b>
                      <br>Livrés : <b class="pull-right">  <?php echo $hygienCor['livre']->qt;?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $hygienCor['annule']->qt;?></b>
                      <br>Confirmer : <b class="pull-right"> <?php echo $hygienCor['confirmer']->qt;?></b>
                      <br>A confirmer :<b class="pull-right">  <?php echo $hygienCor['en_attente']->qt;?></b>

                    </p>
                      
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" id="soinCap" data-target="#defaultModal" style="text-decoration:none;">     
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/capillaire.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN CAPILLAIRE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?php echo $soinCap['all']->qt;?></b>
                      <br>Livrés : <b class="pull-right">  <?php echo $soinCap['livre']->qt;?></b>
                      <br>Annulés: <b class="pull-right"> <?php echo $soinCap['annule']->qt;?></b>
                      <br>Confirmés :<b class="pull-right">   <?php echo $soinCap['confirmer']->qt;?></b>
                      <br>A confirmer : <b class="pull-right">  <?php echo $soinCap['en_attente']->qt;?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" id="hygienBuco" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/buco.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE BUCO-DENTAIRE </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?php echo $hygienBuco['all']->qt;?></b>
                      <br>Livrés:   <b class="pull-right">  <?php echo $hygienBuco['livre']->qt;?></b>
                      <br>Annulés :  <b class="pull-right"> <?php echo $hygienBuco['annule']->qt;?></b>
                      <br>Confirmés : <b class="pull-right">  <?php echo $hygienBuco['confirmer']->qt;?></b>
                      <br>A confirmer : <b class="pull-right">  <?php echo $thygienBucodc['en_attente']->qt;?></b>
                  </p>
            </div>
          </div>
        </a>
        </div> 
    </div>
    <div class="row bg-white">
        <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
         <a href="#"  data-toggle="modal" id="beaute" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px #fff;background-image:url('<?=base_url("assets/img/beaute.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BEAUTE 
                     </h3>

                  </p>
                   <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?php echo $beaute['all']->qt;?></b>
                      <br>Livrés :    <b class="pull-right"> <?php echo $beaute['livre']->qt;?></b>
                      <br>Annulés :  <b class="pull-right"><?php echo $beaute['annule']->qt;?></b>
                      <br>Confirmés :  <b class="pull-right"><?php echo $beaute['confirmer']->qt;?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $beaute['en_attente']->qt;?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
           <a href="#"  data-toggle="modal" id="lessive" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/lessive.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">LESSIVE </h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?php echo $lessive['all']->qt;?></b>
                      <br>Livrés :  <b class="pull-right">  <?php echo $lessive['livre']->qt;?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $lessive['annule']->qt;?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $lessive['confirmer']->qt;?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $lessive['en_attente']->qt;?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" id="soinsVis" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/visage.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN VISAGE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right">   <?php echo $soinsVis['all']->qt;?></b>
                      <br>Livrés :   <b class="pull-right">    <?php echo $soinsVis['livre']->qt;?></b>
                      <br>Annulés : <b class="pull-right"> <?php echo $soinsVis['annule']->qt;?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $soinsVis['confirmer']->qt;?></b>
                      <br>A confirmer : <b class="pull-right"> <?php echo $soinsVis['en_attente']->qt;?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" id="boisson" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/boisson.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BOISSON </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?php echo $boisson['all']->qt;?></b>
                      <br>Livrés :   <b class="pull-right"> <?php echo  $boisson['livre']->qt;?></b>
                      <br>Annulés :  <b class="pull-right"><?php echo $boisson['annule']->qt;?></b>
                      <br>Confirmés : <b class="pull-right"> <?php echo $boisson['confirmer']->qt;?></b>
                       <br>A Confirmer : <b class="pull-right"> <?php echo $boisson['en_attente']->qt;?></b>

                  </p>
            </div>
          </div>
        </div>  
      </a>
    </div>  
    </div>




    <div class="row" style="height: 20px">
      

    </div>
  <section class="panel" style="margin-top: 20px !important">
         <!--     <div id="c-slide" class="carousel slide auto panel-body" style="padding-left:15px;padding-right:20px; margin-top: 10px;height: 300px;">
                <ol class="carousel-indicators out">
                  <li class="active" data-slide-to="0" data-target="#c-slide"></li>
                  <li class="" data-slide-to="1" data-target="#c-slide"></li>
                  <li class="" data-slide-to="2" data-target="#c-slide"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item text-center active">   
                  <div class="col-lg-6 text-center">
                  <canvas id="fammile" class="text-center"></canvas>
                  </div>  
                  </div>
                  <div class="item text-center">
                    <div class="col-lg-6">
                  <canvas id="zone"></canvas>
                  </div>  
                  </div>
                  <div class="item text-center">
                   <div class="col-lg-6">
                  <canvas id="ca"></canvas>
                  </div>  
                  </div>
                </div>
                <a data-slide="prev" href="#c-slide" class="left carousel-control">
                                  <i class="arrow_carrot-left_alt2"></i>
                              </a>
                <a data-slide="next" href="#c-slide" class="right carousel-control">
                                  <i class="arrow_carrot-right_alt2"></i>
                              </a>
              </div>
    </section> -->
   

 <!-- Modal -->
        <div class="modal fade" id="deoparfun" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille DEO ET PARFUM<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitdeopar">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


        <!-- Modal -->
        <div class="modal fade" id="soincapilaire" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille SOIN CAPILLAIRE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitsoincapilaire">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
   
        <!-- Modal -->
        <div class="modal fade" id="hygiennebucodentaire" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille HYGIENE BUCO DENTAIRE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduithygiennebucodentaire">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
    <!-- Modal -->
        <div class="modal fade" id="hygiennecorporelle" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille HYGIENE CORPORELLE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduithygiennecorporelle">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


        <!-- Modal -->
        <div class="modal fade" id="beaute" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BEAUTE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitbeaute">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>

        <!-- Modal -->
        <div class="modal fade" id="lessive" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille LESSIVE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeproduitlessive">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>

          <!-- Modal -->
        <div class="modal fade" id="soinvisage" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille SOIN DE VISAGE<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listesoinvisage">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>


           <!-- Modal -->
        <div class="modal fade" id="boisson" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="listeboisson">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
<!--***********************************************************************************************************-->
       <!-- Modal -->
        <div class="modal fade" id="PRV" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="PRV">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="LV" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="toggle-title">Liste des Produits de la famille BOISSON</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="LV" id="testAppend">
                              
                            </section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="AN" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="ann">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="PL" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body vente">
                            <section class="PL">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="defaultModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="titleToggle">Liste des Produits de la famille BOISSON</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <section class="ETDC" id="testAppend2">
                              
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
 <!-- Modal -->
 

<section class="panel">
              <header class="panel-heading">
         <h3>STATISTIQUE PAR FAMILLE DES PRODUITS COMMANDES </h3> 
              </header>
              <div class="panel-body">
             <div class="col-md-6">  
              <p style="font-size: 18px;">Par Nombre de Produits </p>
               
          

  <div class="progress progress-striped progress-sm" style="height: 15px;">
  <div class="progress-bar" role="progressbar" style="width:background-color:" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    
  </div>
</div>     
                
          </div> 

<div class="col-md-6">
  <p style="font-size: 18px;">Par Chiffre d'affaire </p>
  

          
  <div class="progress progress-striped active progress-sm" style="height: 15px;">
  <div class="progress-bar" role="progressbar" style="width:background-color:" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
    
  </div>
</div>     
               

</div>



              </div>
            </section>

            
            <!--progress bar end-->

<script type="text/javascript">
  
</script>



