<div class="card w-100">
  <div class="card-header">
    <div class="card-body">
      <div class="row">
        <div class="form-group col-lg-6">
          <div class="row">
            <div class="form-group col-lg-2">
              <input type="text" name="minute" class="minute form-control  form-control-sm timer-input" value="00" disabled>
            </div>
            <div class="form-group col-lg-2">
              <input type="text" name="seconde" class="seconde form-control form-control-sm timer-input" value="00" disabled>
            </div>
            <div class="form-group col-lg-8">
              <button type="submit" id="marche" class="btn btn-success btn-sm col-md-5"> <i class="flaticon-whatsapp "></i> Commencer </button>
              <button type="reset" id="fin" class="btn btn-danger btn-sm col-md-5"><i class="flaticon-power"></i>&nbsp; Fin d'appel</button>
            </div>
          </div>
        </div>

        <div class="form-group col-lg-2">
          <div class="input-group mb-3">
            <input type="text" class="form-control client " placeholder="Recherche client" aria-label="Username" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <a href="#"><i class="fa fa-search"></i></a>
              </span>
            </div>

          </div>
        </div>


        <div class="form-group col-lg-2">
          <a href="#" class="btn btn-warning btnSauveClient">
            <i class="fa fa-users"></i>&nbsp;Enregistre client
          </a>
        </div>

        <div class="form-group col-lg-2">
          <a href="#" class="btn btn-success sauveVente">
            <i class="fas fa-cart-plus"></i>&nbsp;

            Enregistre vente
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="card w-100">
  <div class="card-body">
    <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Recherche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Enregistre client</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Enregistre vente</a>
      </li>
    </ul>
    <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
      <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
        <div class="row">
          <div class="col-md-3 text-center">
            <img src="" width="70%" height="180px" style="object-fit: cover;">
          </div>
          <div class="col-md-8 ml-3">
            <h3 class="font-weight-bold text-primary"></h3>
            <ul class="list-group">
              <li class="list-group-item d-flex">
                <span class="col-md-4">Nom sur Facebook:</span><span class="col-md-8"></span>
              </li>
              <li class="list-group-item">
                <span class="col-md-4">Code Client:</span><span class="col-md-8 codeClient"></span>
              </li>
              <li class="list-group-item">
                <span class="col-md-4">Enregistré le:</span><span class="col-md-8"></span>
              </li>

              <li class="list-group-item">
                <span class="col-md-4"><i class="text-success fa fa-phone-square"></i> Contact :</span><span class="col-md-8"></span>
              </li>

              <li class="list-group-item">
                <span class="col-md-4"> Compte facebook : </span><span class="col-md-8">
                  <a href="" target="_blank">
                    <i class="text-primary fab fa-facebook fa-2x m-0"></i></span>
                </a>
              </li>

            </ul>
          </div>
        </div>
        <table class="table table-hover table-striped dataTables w-100">
          <thead class="bg-<?= $nav_color ?> text-white text-center">
            <tr>
              <th>Aperçu</th>
              <th>Produit</th>
              <th>Quantité</th>
              <th>Total</th>
              <th>Date de Commande</th>
              <th>Statut</th>
              <th>Info</th>

            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
        <div class="container autreinpp bg-Light ">

          <div class="row cont-app">
            <div class="form-group col-md-4">
              <img class="img-thumbnail w-20" id="preview" style="width:180px;height:180px; object-fit:cover" src="<?= base_url('images/default_user.png') ?>" alt="client"><br>
              <div class="upload-btn-wrapper" style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                <button class="btn btn-primary" style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;width: 150px;">Parcourir</button>
                <input id="image" name="image" type="file" required style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;" />
              </div>
            </div>
            <div class="form-group col-md-8">
              <div class="row">
                <div class="form-group col-md-6">
                  <input id="liensurfb" class="form-control" type="text" name="" placeholder="LIEN Facebook">
                </div>
                <div class="form-group col-md-6">
                  <input id="identifient" class="form-control" type="text" name="" placeholder="ID Facebook">
                </div>
                <div class="form-group col-md-6">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input id="coach_p" class="form-control coach" type="text" name="" placeholder="Coach">
                    </div>
                    <div class="form-group col-md-6">
                      <input id="commerciale_p" class="form-control commerciale" type="text" name="" placeholder="Commerciale">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
        <fieldset class="border p-2" style="padding:2px; border: solid #424242 1px!important;">
          <legend class="w-auto">Produit</legend>
          <div class="form-group d-flex" style="margin-bottom: 20px!important">
            <div class="col-lg-3">
              <select class="form-control form-control-sm famille custom-select" name="famille" placeholder="Cathegory">

              </select>
            </div>
            <div class="col-lg-3 ">
              <select name="codeproduit" class="form-control form-control-sm groupe custom-select"></select>
            </div>
            <div class="col-lg-3">
              <select name="" class="produitname form-control custom-select form-control-sm" id="recherche"></select>
            </div>
            <div class="col-lg-2">
              <select class="form-control zone form-control-sm custom-select" name="zone" placeholder="Prix appliquer">

              </select>
            </div>
            <div class="col-lg-1">
              <button class="btn btn-primary btn-sm validproduit" style="display: inline;"><i class="flaticon-add"></i></button>
            </div>
          </div>
          <hr />
          <div class="row mt-2 p-0 ">
            <div class="col-md-12">
              <div class="table-responsive p-0 m-0">
                <table class="table table-striped table_commande table-bordered border-dark table-sm">
                  <thead class="text-white bg-<?= $nav_color ?>">
                    <tr>
                      <th>Code produit</th>
                      <th>Désignation</th>
                      <th>Prix Unitaire</th>
                      <th>Quantite</th>
                      <th>Total (Ar)</th>
                      <th>Aperçu</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                  </tbody>

                  <tfoot style="border:1px solid rgba(0,0,0,.1)">
                    <tr>
                      <td></td>

                      <td></td>
                      <td></td>
                      <td colspan="3" class="font-weight-bold">
                        Sous total : &nbsp; &nbsp;<b><label class="total">00 MGA</label></b>
                      </td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </fieldset>

        <fieldset class="border p-2" style="padding:2px; border: solid #424242 1px!important;">
          <legend class="w-auto">Promotion tsena koty</legend>
          <div class="row">
            <div class="form-group col-md-4">
              <label for="type">Achat (avec)</label>
              <select class="form-control custom-select form-control-sm type-facture" id="type-facture">
                <option hidden></option>
                <option>Simple</option>
                <option>Promotion</option>
              </select>
            </div>
            <div class="form-group col-md-8 collapse  type-promo">
              <div class="row m-0 p-0">
                <div class="form-group col-md-6 p-0">
                  <label for="type">Code Promo</label>
                  <select class="form-control custom-select form-control-sm codePromo" id="type">
                    <option hidden></option>


                  </select>
                </div>
                <div class="form-group col-md-4 p-0">
                  <label class="form-check-label w-100" for="exampleCheck1">Bonus</label>
                  <input type="checkbox" class="form-check-input bonus mt-2 ml-1" name="bonus"> <label class="form-check-label">(Checker si valider)</label>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="border p-2 pr-4" style="padding:2px; border: solid #424242 1px!important;">
          <legend class="w-auto">Livraison</legend>
          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">
              <div class="form-group col-md-4">
                <label for="contact" class="control-label col-lg-2">Contact<span class="required"> *</span></label>
                <input class="form-control contact form-control-sm" type="tel" id="phone" name="phone" placeholder="+261 33 32 123 12" pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" required="" maxlength="10" minlength="10">
              </div>
              <div class="form-group col-md-4" style="margin-bottom:5px;">
                <label for="cname" class="control-label col-lg-2">Autre contact livraison<span class="required">*</span></label>
                <input class="form-control cotactlivre form-control-sm" type="tel" id="phone" name="phone" placeholder="+261 33 32 123 12" pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" required="" maxlength="10" minlength="10">
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Localité<span class="required">*</span></label>
                <select class="form-control form-sm Localite form-control-sm custom-select">
                  <option class="select-default " disabled selected hidden></option>
                  <option>ANTANANARIVO RENIVOHITRA</option>
                  <option>GRAND TANA</option>
                  <option>PROVINCE</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">
              <div class="col-md-4 form-group">
                <label class="control-label col-md-2" for="inputSuccess">Date de livrason<span class="required"> *</span></label>
                <input type="date" class="form-control datelivre form-control-sm" />
              </div>
              <div class="col-md-4 form-group">
                <label class="control-label" for="inputSuccess">Début<span class="required"> *</span></label>
                <input type="time" class="form-control Debut form-control-sm" min="09:00" max="17:00" />
              </div>
              <div class="col-md-4 form-group">
                <label class="control-label" for="inputSuccess">Fin<span class="required"> *</span></label>
                <input type="time" min="09:00" max="17:00" class="form-control Fin form-control-sm" />
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Quartier<span class="required"> *</span></label>
                <input class="form-control quartier form-control-sm" onKeyUp="javascript:this.value=this.value.toUpperCase();" id="quartier" type="text" name="quartier" />
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Ville<span class="required"> *</span></label>
                <input class="form-control ville form-control-sm" id="ville" disabled type="text" name="livraison" />
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">District<span class="required">*</span></label>
                <input class="form-control District form-control-sm" id="District" disabled type="text" name="livraison" />
              </div>
            </div>
          </div>


          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Zone<span class="required"> *</span></label>
                <input class="form-control zone form-control-sm" id="zone" disabled type="text" name="zone" />
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Axe<span class="required"> *</span>
                </label>
                <input class="form-control axe form-control-sm" id="axe" disabled type="text" name="axe" />
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">Type de livraison<span class="required"> *</span></label>
                <input class="form-control axe form-control-sm" id="axe" disabled type="text" name="axe" />
              </div>
            </div>
          </div>



          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">
              <div class="form-group col-md-3">
                <label for="cname" class="control-label col-lg-2">Frais <span class="required">*</span></label>
                <input class="form-control frailivre form-control-sm" type="number" value="0" id="frailivre" name="frailivre" />
              </div>
              <div class="form-group col-md-5">
                <label for="cemail" class="control-label col-lg-2">Lieu de livraison<span class="required"> *</span></label>
                <input class="form-control lieulivre form-control-sm" id="lieulivre" type="text" required="" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="lieulivre" />
              </div>
              <div class="form-group col-md-4">
                <label for="cemail" class="control-label col-lg-2">frais de retrait<span class="required"> *</span></label>
                <input class="form-control fraisderetrait form-control-sm" value="0" id="fraisderetrait" type="number" required="" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="fraisderetrait" />
              </div>
            </div>
          </div>

          <div class="form-group col-md-12 w-100" style="margin-bottom: 5px;">
            <label for="cname" class="control-label col-lg-2">Remarque *<span class="required">*</span></label>
            <textarea class="form-control comment w-100" id="comment" required="" onKeyUp="javasrcipt:this.value=this.value.toUpperCase();" name="comment"></textarea>
          </div>

          </span>
        </fieldset>
        <fieldset class="border p-2" style="padding:2px; border: solid #424242 1px!important;">
          <legend class="w-auto">Vendeur secondaire</legend>

          <div class="col-md-12 mt-1 w-100 p-0">
            <div class="row col-md-12 m-auto p-0 border">

              <div class="form-group col-md-4" style="margin-bottom: 5px!important">
                <label for="cemail" class="control-label col-lg-2">Vendeur Secondaire<span class="required">*</span></label>
                <select class="form-control form-control-sm nature_sc custom-select">
                  <option class="select-default " disabled selected hidden>*</option>
                  <option>VP</option>
                  <option>VT </option>
                  <option>PR</option>
                  <option>COTN </option>
                  <option>NONE</option>
                </select>
              </div>

              <div class="form-group col-md-8" style="margin-bottom: 5px!important">
                <div class="row col-md-12 m-auto p-0 ">
                  <div class="col-lg-4">
                    <label for="cemail" class="control-label col-lg-2 text-center">Code Vendeur <span class="required ">*</span></label>
                    <input class="form-control ress_sec_oplg w-100 form-control-sm" required="" id="ress_sec_oplg" maxlength="5" minlength="5" type="text" name="ress_sec_oplg" />
                  </div>
                  <div class="col-lg-8 pt-3">
                    <label for="cemail" class="control-label col-lg-4 text-center mt-3">Matricule vendeur secondaire : <span class="required result_mattr">*</span> <span class="matrfinal"></span> </label>
                  </div>
                </div>
              </div>
        </fieldset>




      </div>
    </div>
  </div>
</div>
</div>




<div class="modal fade" id="modaleFinDAppel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
          Durée dappel : <span class="message"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="">STATUT D'APPEL</label>
              <select name="" id="" class="custom-select form-control form-control-sm">
                <option hidden></option>
                <option>APPEL ABOUTI</option>
                <option>APPEL ECHOUE</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="">CODE APPEL</label>
              <select name="" id="" class="custom-select form-control form-control-sm">

              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="">OBSERVATION</label>
              <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>