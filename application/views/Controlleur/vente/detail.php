<div class="panel-body">

                <div class="row">

                        <div class="col-xs-5 col-sm-4 center">

                            <span class="profile-picture">

                              <img alt="<?=$client->Code_client?>" class="simple" src="<?=base_url('images/client/'.$client->Code_client)?>.jpg"class="img-thumbnail" style="height:160px;width:160px;">

                            </span>



                            <div class="space space-4" ></div>

                            </a>

                         <span class="collapse idfactureId">

                          <?=$client->Id?>

                         </span>

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

                               

                             </div>

               

                             </div>  

               

                            <div class="col-xs-5 col-sm-4 center">

                                <div class="row">

                                   <div class="form-groupe  col-md-8">

                                       <select class="form-control statut">

                                           <option>confirmer</option> 

                                           <option>annule</option>

                                           <option>en_attente</option>

                                           <option>livre</option>

                                        </select>

                                    </div>

                                    <div class="form-groupe  col-md-4">

                                       <a  href="#" class="btn btn-warning btn-statut"><i class="fa fa-edit"></i></a>

                                    </div>

                                </div>

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

                      <th style="text-align: center; background-color: #7d8997;color: #fff; border-left: 1px solid #fff;"></th>

                    </tr>

                  </thead>

                  <tbody class="tbody tbody-data">

                <?php $total=0; $nbtab=count($commande); foreach($commande as $commande):?>

                    <tr>

                      <td style="text-align: center;" class="collapse Id"><?=$commande->Id?></td>

                      <td style="text-align: center;" class="collapse Id_prix"><?=$commande->Id_prix?></td>

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

                     <td style="text-align: center;"> 

                       <a  href="#" class="btn btn-warning modifiDetail"><i class="fa fa-edit"></i></a>

                       <?php  if($nbtab>1):?>

                        <a  href="#" class="btn btn-danger modifiDelete"><i class="fa fa-times"></i></a>

                       <?php endif;?>

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

                      <th style="text-align: center;color: #fff; border-left: 1px solid #fff;"></th>

                    </tr>                    

                  </tbody>

                </table>

      </div>

    </div>



</div>

        </div>





