<div class="collapse date_select"><?= $date ?></div>
  <div>
      <a href="<?=base_url('service_clientel/calendrier/detail_livraison/'.$date)?>" class="btn btn-primary btn-lg">Livraison facebook</a>
  </div>
  <hr class="">
  <h1 style="font-size: 16px;" class="ml-3"> Livraison Facebook</h1>
  <div class="row ml-3">
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="Previ" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#5bc0de;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">Livraisons Previsionnelles <br>
                      <?= number_format($Previsionnelle, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="livre" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#5cb85c;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">Livraisons Réalisées <br>
                      <?= number_format($Realisees, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="annule" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#d9534f;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">Livraisons annulées <br>
                      <?= number_format($Annulees, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="confirmer" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#3f729b;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">Livraison Planifiées<br>
                      <?= number_format($Planifiees, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="en_attente" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:orange;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">En attende de décision<br>
                      <?= number_format($Decision, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-2 col-sm-6 col-xs-12 link" id="rep" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#6f42c1;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px">Annulé repporter<br>
                      <?= number_format($repporter, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <hr>
      <div class="row mt-5 panel w-100 p-2">

      </div>
  </div>

  </div>
  </div>
