        <div class="tabs-2">
        <hr>
            <h1 style="font-size: 16px;"> Livraison Tsena koty</h1>       
            <div class="row tabs-2">
                <div class="col-md-2 col-sm-6 col-xs-12 link1 " id="Previ" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#5bc0de;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Previsionnelles : 
                            &nbsp;  <?php foreach ($sommeprevi as  $value): ?>
                            <b><?= number_format($value->sommepreviAr)." Ar <br>(". number_format($value->sommeprevi).")";?></b>
                            <?php endforeach ?> Koty
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12  link1" id="livre" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#5cb85c;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Réalisées <br>
                            &nbsp;<?php foreach ($sommelivre as  $value): ?>
                            <b><?= number_format($value->sommelivreAr)." Ar <br>(". number_format($value->sommelivre).")";?></b>
                            <?php endforeach ?>Koty                        
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 link1" id="annule" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#d9534f;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Annulées <br> 
                            &nbsp;<?php foreach ($sommeannule as  $value): ?>
                            <b><?= number_format($value->sommeannuleAr)." Ar <br>(". number_format($value->sommeannule).")";?></b>
                            <?php endforeach ?>Koty
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 link1" id="confirmer" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#3f729b;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Planifiées<br> 
                            &nbsp; <?php foreach ($sommeconfirme as  $value): ?>
                            <b><?= number_format($value->sommeconfirmeAr)." Ar <br>(". number_format($value->sommeconfirme).")";?></b>
                            <?php endforeach ?>Koty
                           </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12  link1" id="en_attente" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:orange;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px">En attende <br> 
                            &nbsp; <?php foreach ($somme_enattente as  $value): ?>
                            <b><?= number_format($value->somme_attenteAr)." Ar <br>(". number_format($value->somme_attente).")";?></b>
                            <?php endforeach ?>Koty
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 link1" id="rep" style="padding-right:30px;cursor:pointer">
                    <div class="row">
                        <div class="col-md-4" style="background:#6f42c1;height:70px"><span class="info-box-icon">
                            <i class="fa fa-bookmark-o"
                            style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
                        </div>
                        <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                            <p class="" style="color:black;font-size:12px;padding-top:10px"> Repporter<br> 
                            &nbsp; <?php foreach ($somme_repport as  $value): ?>
                            <b><?= number_format($value->somme_repportAr)." Ar <br>(". number_format($value->somme_repport).")";?></b>
                            <?php endforeach ?> Koty
                            </p>
                        </div>
                    </div>
                </div>
                    <div class="row mt-5 panel2">    

                    </div>
            </div>
            </div>