<div class="collapse date_select"><?= $date ?></div>
  <h1 style="font-size: 16px;" class="ml-3"> Livraison Tsena koty</h1>
  <div class="row ml-3">
   
      <div class="col-md-3 col-sm-6 col-xs-12 link card " id="livre" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#39C0ED;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px"> Tsenakoty à verser au caisse<br>
                      <?= number_format($Realisees, 2, ',', ' ') ?>&nbsp;Ar

                  </p>

              </div>
          </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 link card  ml-3" id="annule" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#d9534f;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px"> Tsenakoty non  verser <br>
                      <?= number_format($Annulees, 2, ',', ' ') ?>&nbsp;Ar
                  </p>
              </div>
          </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 link card  ml-3" id="confirmer" style="padding-right:30px;cursor:pointer">
          <div class="row">
              <div class="col-md-4" style="background:#00B74A;height:70px"><span class="info-box-icon">
                      <i class="flaticon-shapes" style="color:white;font-size:34px;padding-top:20px;padding-left:3px;"></i></span>
              </div>
              <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                  <p class="" style="color:black;font-size:12px;padding-top:10px"> Tsenakoty Versé<br>
                      <?= number_format($Planifiees, 2, ',', ' ') ?>&nbsp;Ar
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
