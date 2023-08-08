

<div class="panel-body">
                <div class="row">
                        <div class="col-xs-5 col-sm-4 center">
                            <span class="profile-picture">
                              <img alt="<?=$client->Code_client?>" class="simple" src="<?=base_url('images/client/'.$client->Code_client)?>.jpg"class="img-thumbnail" style="height:160px;width:160px;">
                            </span>

                            <div class="space space-4" ></div>
                            </a>

                        </div>

                        <div class="col-xs-3 col-sm-3">
                            <h4 class="blue">
                                <span class="middle"><?=$client->Nom." ".$client->Prenom?></span>
                            </h4>
                            <div class="profile-user-info">
                                <h5 class="blue">                              
                                    <span class="middle" ><?=$client->Code_client?></span>
                                </h5>    
                            </div>

                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name" style="text-align: left;">
                                        <i class="middle ace-icon fa fa-phone-square bigger-150 green"></i> Contact :<?=$client->contacts?></b>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name" style="text-align: left;">Localisation : <i class="fa fa-map-marker light-orange bigger-110"></i>
                                        <span><?=$client->Ville.",".$client->Quartier?></span>
                                  </div>
                                </div>

                                 <div class="profile-info-row">
                                    <div class="profile-info-name" style="text-align: left;"><i class="fa fa-facebook light-blue bigger-110"></i>  
                                        <span><a href="<?=$client->lien_facebook?>" target_=blank>Facebook </a></span>
                                  </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> </div>

                                    <div class="profile-info-value">
                                        <span></span>
                                    </div>
                                </div>
                               
                             </div>
               
                             </div>   <div class="col-xs-3 col-sm-3">
                             <div style="overflow:hidden;width: 350px;height: 400px;"><iframe width="350" height="400" src="https://maps.google.com/maps?width=350&amp;height=400&amp;hl=en&amp;q=%20%09<?=$client->Quartier?>%20%2C%20<?=$client->Quartier?>%20%2C<?=$client->Ville?>%2Cmadagascar+(Titre)&amp;ie=UTF8&amp;t=k&amp;z=17&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div><small><a href="https://embedgooglemaps.com/en/">embedgooglemaps FR</a></small></div><div><small><a href="https://newyorkhoponhopoffbus.nl">new york city freestyle pass: hop-on, hop-off tour en ferry</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />

                        </div ><!-- /.col -->
                    <div class="confirm">
                      
                    </div>
              
                        </div><!-- /.col -->
                    </div><!-- /.row -->

<table class="table table-striped table-advance table-hover" style="margin-top: 60px;">
                <tbody>
                  <tr>
                    <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;width: 250px;"> Nom du livreur</th>
                    <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff; width: 200px"> Date de livraison</th>
                    <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;width: 267px;"> Heure de livraison </th>
                    <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;"> Lieu de livraison</th>
                    <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;width: 142px;"> Statut</th>
                
                  </tr>
                  <tr>
                    <td style="text-align: center;">
                    <?=$client->idlivreur?>
                    </td>
                    <td style="text-align: center;">
                    
                    <?=$client->date_de_livraison?>
                    </td>
                    <td style="text-align: center;">
                     <?php 
                        if($client->heure_deb_livre == ""){
                        echo  "Entre &nbsp;".$client->heure_livre_debut." et ".$client->heure_livre_fin;
                       }else{
                         echo  "Entre &nbsp;".$client->heure_deb_livre." et ".$client->heure_fi_livre;

                       }
                    ?>
                    </td>
                    
                   
                    <td style="text-align: center;">
                    <?=$client->Quartier?>
                    </td>
                    <td style="text-align: center;">
                      <?=$client->Status?>
                        
                      </td>
                  </tr>
                 
                  
                </tbody>
              </table>

  <table class="table"  style="border-top:solid 1px #dbdbdb;border-bottom:solid 1px #dbdbdb; margin-top: 10px;">
                  <thead >


                    <tr>
                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;width: 250px;">Produit</th>
                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;">Prix en Ariary</th>
                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;">Quantite</th>
                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;">Total en Ariary</th>
                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;">Statut</th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                <?php $total=0; foreach($commande as $commande):?>
                    <tr>
                      <td style="text-align: center;">
                      <a href="<?=base_url('images/produit/'.$commande->Code_produit)?>.jpg" data-lightbox="roadtrip"><?=$commande->Designation?></a>    
                      </td>
                      <td style="text-align: center;"><?= number_format($commande->Prix_detail, 2, ',', ' ');?></td>
                      <td style="text-align: center;"><?=$commande->Quantite?></td>
                      <td  style="text-align: center;" class="total"><?php $total+=$commande->Prix_detail*$commande->Quantite; echo number_format($commande->Prix_detail*$commande->Quantite, 2, ',', ' ');?></td>
                      <td style="text-align: center;">
                      <?=strtoupper($commande->statut)?>
                       <!--<img src="../img/produit/" class="img-thumbnail" style="width:60px;">-->
                     </td>
                
                    </tr>
                <?php endforeach;?>

                   <tr style="text-align: center; background-color: #ddd;color: #fff;">
                      <th style="text-align: center; background-color: #ddd;color:#000; border-left: 1px solid #fff;">Emetteur :</th>
                      <th style="background: #007bff; text-align: center;;color: #fff; border-left: 1px solid #fff;">
                      &nbsp;<?=$client->Matricule_personnel?>
                      </th>
                      <th style="text-align: center;color: #000; border-left: 1px solid #fff;">Sous total en Ariary</th>
                      <th style="background: #007bff;text-align: center; color: #fff; border-left: 1px solid #fff;" class="contTotal">
                        <?php
                        echo number_format($total, 2, ',', ' ');
                         ?>
                      </th>
                      <th style="text-align: center;color: #fff; border-left: 1px solid #fff;"></th>
                    </tr>                    
                  </tbody>
                </table>
      </div>
    </div>

</div>
        </div>


