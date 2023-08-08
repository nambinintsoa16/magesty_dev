
   <div class="container-fluid" style="background:#fff">
        <div class="row pt-2" >
            <img src="<?php echo base_url()?>images/carte-image.png" alt="" style="width: 100%; height: 350px;object-fit: cover;">            
        </div>
        <div class="row ">
            <div class="col-6 col-md-2 offset-md-1 " style="padding: 4px!important">
                    <div class="cotentp pt-2 pl-2 level" style="background: #007bff;border-radius: 7px;height: 100px;color: #fff;cursor: pointer;" id="level 1">
                           <i class="fa fa-cubes"></i>     CHAPEAU 1 <br>  
                           <ul style="list-style-type: none;padding-left: 5px;">
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Total Lots : <?php $total_lot_1 = 
                           	$total_chapeau_1->lot; echo $total_lot_1 ?></li>
                           	<li> <i class="fa fa-hand-o-right " aria-hidden="true"></i> Lots Tirés : <?php $total_lot_1_tirer= $total_chapeau_1_tirer->lot; echo $total_lot_1_tirer;  ?>  </li>
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Disponibles : <?php $lot_1_dispo = $total_lot_1-$total_lot_1_tirer; echo $lot_1_dispo   ?> </li> 
                           </ul> 
                    </div>
                    
              
               
            </div>

             <div class="col-6 col-md-2" style="padding: 4px!important">
                <div class="cotentp pt-2 pl-2 level" style="background: #28a745;border-radius: 7px;height: 100px;color: #fff;cursor: pointer;" id="level 2">
                 <i class="fa fa-cubes"></i>   CHAPEAU 2 <br>  
                 <ul style="list-style-type: none;padding-left: 5px;">
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Total Lots :  <?php $total_lot_2 = $total_chapeau_2->lot; echo $total_lot_2;?></li>
                           	<li> <i class="fa fa-hand-o-right " aria-hidden="true"></i> Lots Tirés : <?php $total_lot_2_tirer = $total_chapeau_2_tirer->lot; echo $total_lot_2_tirer;?>  </li>
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Disponibles :
                           		<?php
                           			$lot_2_dispo = $total_lot_2-$total_lot_2_tirer;
                           			echo $lot_2_dispo;
                           		 ?> </li>
                           
                           </ul>
                </div>

            </div>

             <div class="col-6 col-md-2" style="padding: 4px!important">
                <div class="cotentp pt-2 pl-2 level" style="background: #ffc107;border-radius: 7px;height: 100px; color: #fff;cursor: pointer;" id="level 3">
                   <i class="fa fa-cubes"></i> CHAPEAU 3 <br>  
                   <ul style="list-style-type: none;padding-left: 5px;">
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Total Lots :  <?php $total_lot_3= $total_chapeau_3->lot;echo$total_lot_3 ?></li>
                           	<li> <i class="fa fa-hand-o-right " aria-hidden="true"></i> Lots Tirés : <?php $total_chapeau_3_tirer= $total_chapeau_3_tirer->lot;echo $total_chapeau_3_tirer?>  </li>
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Disponibles :<?php $lot_3_dispo = $total_lot_3- $total_chapeau_3_tirer; echo $lot_3_dispo  ?> </li>
                           
                           </ul>
                </div>

            </div>

             <div class="col-6 col-md-2" style="padding: 4px!important">
                <div class="cotentp pt-2 pl-2 level" style="background: #dc3545;border-radius: 7px;height: 100px;color: #fff;cursor: pointer;" id="level 4">
                    <i class="fa fa-cubes"></i>  CHAPEAU 4 <br>  
                    <ul style="list-style-type: none;padding-left: 5px;">
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Total Lots :  <?php $total_lot_4= $total_chapeau_4->lot;echo $total_lot_4?></li>
                           	<li> <i class="fa fa-hand-o-right " aria-hidden="true"></i> Lots Tirés : <?php $total_lot_4_tirer = $total_chapeau_4_tirer->lot;echo $total_lot_4_tirer?>  </li>
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Disponibles : <?php $lot_4_dispo = $total_lot_4-$total_lot_4_tirer; echo $lot_4_dispo ?> </li>
                           </ul> 

            </div>
        </div>

             <div class="col-6 col-md-2" style="padding: 4px!important">
                <div class="cotentp pt-2 pl-2 level" style="background: #9933CC;border-radius: 7px;height: 100px;color: #fff;cursor: pointer;" id="level 5">
                    <i class="fa fa-cubes"></i>  CHAPEAU 5 <br>  
                    <ul style="list-style-type: none;padding-left: 5px;">
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Total Lots :  <?php $total_lot_5= $total_chapeau_5->lot; echo $total_lot_5;?></li>
                           	<li> <i class="fa fa-hand-o-right " aria-hidden="true"></i> Lots Tirés : <?php $total_lot_5_tirer= $total_chapeau_5_tirer->lot; echo $total_lot_5_tirer?>  </li>
                           	<li> <i class="fa fa-hand-o-right  " aria-hidden="true"></i> Disponibles :<?php $lot_5_dispo = $total_lot_5-$total_lot_5_tirer; echo $lot_5_dispo?>  </li>
                           	
                           </ul>
                </div>

            </div>



        </div>
    </div>
    <div class="container-fluid pr-2 chapeau">
    	<hr>
          <div class="row">
          	<div class="col-md-12">
          		<div class="table-responsive " id="Tabledata">
          			<table class="table table_previsionnel">
          				<thead class="bg-info" style="color: #fff;" >
          					<tr>
          						<th>Code Carte</th>
          						<th>Designation Carte</th>
                                <th>Images</th>
          						<th>Nombre Carte Totale  </th>
          						<th>Nombre de carte tirées</th>
          						<th>Nombre de carte disponible</th>
          						<th>Info</th>
          					</tr>
          				</thead>
          				<tbody>
          					<?php foreach ($liste_lot_1 as  $value): ?>
          					<tr>
          						<td><?= $value->code_carte?></td>
          						<td><?= $value->designation?></td>
                                <td><img src="<?=base_url()?>images/cartegratter/<?= $value->code_carte ?>.png" class="card-img-top" style="width: 100%;margin:auto;height:40px;" alt="<?=$value->code_carte?>">  </td>
          						<td><?php $nbr_toal = $value->Total ; echo $nbr_toal?></td>
          						<td><a href="#" class="level" id="<?= $value->code_carte ?>"><?php $nombre_tirer = $this->global_model->Retourner_nombre_lot_tirer_parproduit($value->code_carte,'level 1');
                                 $nbr_tirer = $nombre_tirer->lot_tirer; echo $nbr_tirer ?></a></td>
          						<td><?php echo $nbr_toal-$nbr_tirer?></td>
          						<td></td>
          					</tr>
          					<?php endforeach ?>
          				</tbody>
          			</table>
          		</div>
          	</div>
          </div>
    </div>
    


 
  