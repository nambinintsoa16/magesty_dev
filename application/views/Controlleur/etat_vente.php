
        <div class="container p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-md-3 col-sm-6 col-xs-12 link" id="Previ" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#007bff;height:70px"><span class="info-box-icon">
                                <i class="fa fa-bookmark-o"
                                    style="color:white;font-size:24px;padding-top:20px;padding-left:0px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Prévisionnelles <br>
                            <?=number_format($entete['totaLsom'])?>&nbspAr
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 link" id="livre" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#5cb85c;height:70px"><span class="info-box-icon">
                                <i class="fa fa-bookmark-o"
                                    style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Réalisées <br>
                            <?=number_format($livre, 2, ',', ' ');?>&nbspAr
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 link"  id="annule" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#d9534f;height:70px"><span class="info-box-icon">
                                <i class="fa fa-bookmark-o"
                                    style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Annulées <br>
                            <?=number_format($annule, 2, ',', ' ');?>&nbspAr

                            </p>
                        </div>
                    </div>


                </div>

                <div class="col-md-2 col-sm-6 col-xs-12 link" id="confirmer" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#aa66cc;height:70px"><span class="info-box-icon">
                                <i class="fa fa-bookmark-o"
                                    style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Confirmées <br>
                            <?=number_format($confirmer, 2, ',', ' ');?>&nbspAr
                            </p>
                        </div>
                    </div>


                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 link" id="en_attente" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:orange;height:70px"><span class="info-box-icon">
                                <i class="fa fa-bookmark-o"
                                    style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Ventes à confirmer <br>
                            <?=number_format($en_attente, 2, ',', ' ');?>&nbspAr
                            </p>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>    
          
<span class="date_collapse collapse"> <?php echo $date;?></span>
<div class="container" style="margin-top:20px;">
             <table class="table table-striped table-advance table-hover" id="tableau" >
              <thead>
                <tr style="background:#33b5e5">
                    <th class='text-center' style="color:white">Date</th>
                    <th class='text-center' style="color:white">Vendeur Principal </th>
                    <th class='text-center' style="color:white">Vendeur Secondaire </th>
                    <th class='text-center' style="color:white">Produit</th>
                    <th class='text-center' style="color:white;width: 120px;">Prix</th>
                    <th class='text-center' style="color:white">Equipe</th>
                    <th class='text-center' style="color:white">Lieu</th>
                    <th class='text-center' style="color:white">Etat</th>
                    <th class='text-center' style="color:white">Somme</th>
                  </tr>
              </thead>
              <tbody class="listLivraisonAnnullee">  
                     <?=$data?>
                </tbody>
                
              </table>  
            
  </div>

  
            