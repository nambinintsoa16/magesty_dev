<div class="panel-body card">
                <div class="row">
                        <div class="col-xs-5 col-sm-4 ml-4 center">
                            <span class="profile-picture">
                              <img alt="<?=$client->Code_client?>" class="img-thumbnail" src="<?=code_client_img_link($client->Code_client)?>"class="img-thumbnail" style="height:160px;width:160px;">
                            </span>

                            <div class="space space-4" ></div>
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
                                        <i class="middle ace-icon fa fa-phone-square bigger-150 text-warning"></i> Contact :<?=$client->contacts?></b>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name" style="text-align: left;">Localisation : <i class="fa fa-map-marker text-success light-orange bigger-110"></i>
                                        <span><?=$client->Ville.",".$client->Quartier?></span>
                                  </div>
                                </div>

                                 <div class="profile-info-row">
                                    <div class="profile-info-name" style="text-align: left;"><i class="fab fa-facebook text-primary bigger-110"></i>  
                                        <span><a href="<?=$client->lien_facebook?>" target='_blank'>Facebook </a></span>
                                  </div>
                                </div>

                               
                      
                             </div>
													
														 </div>   
														 <div class="col-xs-3 col-sm-3 ">
                             <div  class="card" style="overflow:hidden;width: 350px;height: 400px;"><iframe width="350" height="400" src="https://maps.google.com/maps?width=350&amp;height=400&amp;hl=en&amp;q=%20%09<?=$client->Quartier?>%20%2C%20<?=$client->Ville?>%20%2C<?=$client->District?>%2Cmadagascar+(Titre)&amp;ie=UTF8&amp;t=k&amp;z=17&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div><small><a href="https://embedgooglemaps.com/en/">embedgooglemaps FR</a></small></div><div><small><a href="https://newyorkhoponhopoffbus.nl">new york city freestyle pass: hop-on, hop-off tour en ferry</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />

												</div >
													
               

                    <div class="confirm">
                      
                    </div>
              
												</div>
									<div class="container text-center m-0">			
												<div class="row m-0 justify-content-center" style="font-size:12px;">	  
                                    <div class="col-md-4 card" style="border:solid 1px gray;"> 
																		 <h4>Operatrice <?php if($client->Status== "en_attente"): ?>
                                        <a href="#" class="editRemarqueOperatrice float-left "><i class="fa fa-edit"></i></a>
                                      <?php endif;?></h4><hr/>
                                      

                                     
																		 <span>
																					<?php 
																					if(empty($client->Remarque)){
																						echo  "---";
																					}else{
																							echo $client->Remarque;
																					}
																				
																					?></span>
                                    
                                
																		 		
																		</div>

																		<div class="col-md-3 card ml-1 mr-1"  style="border:solid 1px gray;">
																		<h4>Service client</h4><hr/>
                                        <span>
																				<?php 
																					if(empty($client->remarque_service_clientel)){
																						echo  "---";
																					}else{
																						echo $client->remarque_service_clientel;
																					}
																						?>
																				</span>
																		</div>
																		
																		<div class="col-md-4 card"  style="border:solid 1px gray;">
																		<h4>Livreur</h4><hr/>
                                        <span>
																				<?php 
																					if(empty($client->remarque_livreur)){
																						echo  "---";
																					}else{
																						echo $client->remarque_livreur;
																					}	
																						?>
																				</span>
                                    </div> 

                                </div>								
												</div>		
                    </div>

<table class="table table-striped table-advance table-hover" >
                <tbody>
                  <tr>
                    <th class="text-center bg-info text-white" style=" border-left: 1px solid #fff;width: 250px;"> Nom du livreur</th>
                    <th class="text-center bg-info text-white" style=" border-left: 1px solid #fff; width: 200px"> Date de livraison</th>
                    <th class="text-center bg-info text-white" style=" border-left: 1px solid #fff;width: 267px;"> Heure de livraison </th>
                    <th class="text-center bg-info text-white" style=" border-left: 1px solid #fff;"> Lieu de livraison</th>
                    <th class="text-center bg-info text-white" style=" border-left: 1px solid #fff;width: 142px;"> Statut</th>
                
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
                      <th class="text-white bg-info" style=" border-left: 1px solid #fff;width: 250px;">Produit</th>
                      <th class="text-white bg-info" style=" border-left: 1px solid #fff;">Prix en Ariary</th>
                      <th class="text-white bg-info" style=" border-left: 1px solid #fff;">Quantite</th>
                      <th class="text-white bg-info" style=" border-left: 1px solid #fff;">Total en Ariary</th>
                      <th class="text-white bg-info" style=" border-left: 1px solid #fff;">Statut</th>
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
                      <td style="text-align: center; background-color: #ddd;color:#000; border-left: 1px solid #fff;">Emetteur :</td>
                      <td style="background: #007bff; text-align: center;;color: #fff; border-left: 1px solid #fff;">
                      &nbsp;<?=$client->Matricule_personnel?>
                      </td>
                      <td style="text-align: center;color: #000; border-left: 1px solid #fff;">Sous total en Ariary</td>
                      <td style="background: #007bff;text-align: center; color: #fff; border-left: 1px solid #fff;" class="contTotal">
                        <?php
                        echo number_format($total, 2, ',', ' ');
                         ?>
                      </d>
                      <td style="text-align: center;color: #fff; border-left: 1px solid #fff;"></td>
                    </tr>                    
                  </tbody>
                </table>
      </div>
    </div>

</div>
        </div>
		

<div class="modal fade" id="remarqueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Remarque opératrice</h5>
      
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="remarque-text" class="col-form-label">Remarque:</label>
            <textarea class="form-control" id="remarque-text"><?=$client->Remarque?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="<?=$client->Id?>" class="btn btn-success enregistreRemarque">Modifier</button>
      </div>
    </div>
  </div>
</div>


	
