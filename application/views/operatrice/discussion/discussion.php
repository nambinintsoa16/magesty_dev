<style>
  .file-upload {
    position: relative;
    overflow: hidden;
    border-radius: 3px !important;
    font-size: 13px;
    border: none !important;
    box-shadow: none !important;
    color: #fff !important;
    text-shadow: none;
    padding: 5px 10px !important;
    font-family: Arial, sans-serif;
    display: inline-block;
    vertical-align: middle;

  }

  .valide_content {
    padding: 0px;
    width: 90px;
    height: 30px;
  }

  .file-upload input.PJ {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
  }

  .scrolling-wrapper {
    overflow-x: hidden;
    overflow-y: scroll;
    scrollbar-color: #0099cc #fff;
    scrollbar-width: thin;
    white-space: nowrap;
    display: block;
    height: 480px;

  }

  .card {
    display: inline-block;
  }

  .panel-body {
    height: 600px;
  }

  .input-file {
    position: relative;
    overflow: hidden;
    margin-top: -45px;
    padding: 0;
    display: block;
    max-width: 100%;
    cursor: pointer;
  }

  .input-file i {
    font-size: 30px;

  }

  .input-file .btn {
    white-space: nowrap;
    display: inline-block;
    margin-right: 1em;
    vertical-align: top;
  }

  .input-file .material-icons {
    float: left;
    font-size: 16px;
    line-height: inherit;
    margin-right: 4px;
  }

  .custom-input {
    height: 2.3rem !important;
  }

  .input-file ins {
    white-space: nowrap;
    display: block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 12px;
  }

  .input-file:after {
    content: "";
    display: block;
    clear: both;
  }

  .input-file input {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    top: -100px;

  }

  hr {
    color: #000;
  }

  .image_choise,
  .client_lat {
    cursor: pointer;
  }

  .jconfirm-title-c {
    text-align: center;
  }

  .loading {
    font-size: 36px;
    font-family: sans-serif;
  }

  .loading:after {
    display: inline-block;
    animation: dotty steps(1, end) 1s infinite;
    content: '';
  }

  .right_bull {
    margin: 0;
    padding-bottom: 30px !important;
    background-image: url("https://magesty.mg/images/bulle.png");
    background-repeat: no-repeat;
    background-size: 65px;
    background-position: center;
    min-height: 30px;
  }

  /*.PJ{
      width: 80px;
      margin-left:65% !important;
      text-decoration:none
    }*/

  .left_bull {
    margin: 0;
    padding-bottom: 30px !important;
    background-image: url("https://magesty.mg/images/bulle.png");
    background-repeat: no-repeat;
    background-size: 65px;
    background-position: center;
    min-height: 30px;
  }

  @keyframes dotty {
    0% {
      content: '';
    }

    25% {
      content: '.';
    }

    50% {
      content: '..';
    }

    75% {
      content: '...';
    }

    100% {
      content: '';
    }
  }

  ::-webkit-scrollbar {
    width: 7px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 7px;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #33b5e5;
    border-radius: 7px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #00C851;
  }

  /* Track */
  ::scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 7px;
  }

  /* Handle */
  ::scrollbar-thumb {
    background: #33b5e5;
    border-radius: 7px;
  }

  /* Handle on hover */
  ::scrollbar-thumb:hover {
    background: #00C851;
  }

  p.a {
    word-break: break-all !important;
    padding-left: 10px;
    white-space: normal;
    padding-right: 10px
  }
</style>
<div class="container w-100" style="max-width: 100%!important;">
  <div class="row m-1">
    <div class="col-md-12">
      <div class="row text-white p-1" style="background-color:#81DAF5;">
        <div class="col-md-4">
          <strong style="font-size:12px;">ENREGISTREMENT DES DISCUSSIONS</strong>
        </div>
        <div class="col-md-8">
          <strong style="font-size:17px;">VOUS ETES SUR LA PAGE <span class="pageusers"></span></strong>
        </div>
      </div>
    </div>
    <div class="bg-red mt-2" style="width:25%;">
      <div class="card text-center" style="height:745px;width: 100%;">
        <div class="card-header" style="background:#33b5e5;">
          <strong class="text-white">CHOIX DE L'INTERVENANT</strong>
        </div>
        <div class="card-body">
          <div class="row justify-content-between mt-5 p-3 m-2">
            <div class=" avatar avatar-lg">
              <img class="avatar-img rounded-circle image_choise Client clientzoom" src="" alt="Client">
            </div>
            <div class="avatar avatar-lg">
              <img class="avatar-img rounded-circle image_choise user userzoom" src="<?= PhotoUser_img_link($this->session->userdata('matricule')) ?>" alt="user " style="object-fit:cover;">
            </div>
          </div>
          <div class="row mt-5">
            <div class="form-group col-md-12 p-0">
              <textarea id="message" class="form-control clientMessage w-100" name="" rows="5" placeholder="colle la discussion ici ..."></textarea>
            </div>
            <div class="form-group col-md-12 p-auto">
              <input type="text" id="reponse_client" class="form-control collapse typeahead" disabled placeholder="Code discussion">
              <div class="file-upload btn-sm btn-info mt-2">
                <span class="">Pièce jointe</span>
                <input type="file" id="CLT" class="PJ form-control-file" />
              </div>
              <button class="btn-sm btn  btn-success pull-right valide_content blockerSiNouveau mt-2 p-0">Valider</button>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="mt-2 ml-1" style="width:74%;">
      <div class="card" style="height:745px;width:100%">
        <div class="card-header entetebadge text-white p-1" style="background:#33b5e5;">
          <img class="avatar-img rounded-circle Client" style="width:46px;height:46px;" src="" alt="client">
          <a href="#" class="historique"><span class="code_client_ban ml-3"></span></a>
          <span>||</span><a href="#" class="historiques"><span class="nom_client_ban text-center"></span></a><span>||</span><span><a href="#" class="relance">Historique des relances</a></span>
        </div>
        <div class="card-body">
          <div class="row justify-content-between">
            <div class="col-md-12 p-3 badge rounded-0" style="overflow:scroll-Y;width: 650px;">
              <div class="conten-message scrolling-wrapper mb-2 p-2"> </div>
            </div>
            <div class="col-md-2 collapse">
              <div>
                <input type="text" class="form-control chercher blockerSiNouveau" placeholder="Chercher">
                <div class="listeclients scrolling-wrapper mb-2 text-center p-2" style="overflow:scroll-Y;"></div>
              </div>
            </div>
            <div class="col-md-10">
              <div style="margin-top: 10px;">
                <button class="pull-right btn btn-primary btn-sm scrolldown blockerSiNouveau" style="font-size:24px;margin-right: 5px;z-index: 9999;margin-top: -480px;padding: 6px 11px;font-size: 12px;line-height: 1.5;border-radius: 25px;border:solid 2px #33b5e5"> <i class="fa fa-angle-double-down"></i></button>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <?php
            /*  $code = '<span class="code_client_ban"></span>';
               $codeexacte = substr($code,28);
              $result = $this->global_model->Bloc_Rafitinina($code);
              if($result){
                $var_raftina = "none";
              }else{
                $var_raftina = "block";
              }*/

            ?>
            <div class="form-group col-md-12 row text-left btn-init blockerSiNouveau bg-white" style="margin-left:15px!important;">
              <a href="#" class="btn btn-secondary pull-left observation blockerSiNouveau m-1" style="margin-left: 10px;" disabled>OBSERVATION</a>
              <a href="#" class="btn btn-success pull-left conclure blockerSiNouveau m-1" disabled>CONCLURE</a>
              <a href="#" class="btn btn-primary pull-left rendezvous blockerSiNouveau m-1" style="margin-left: 10px;" disabled>RENDEZ-VOUS</a>
              <a href="#" class="btn btn-warning check pull-right blockerSiNouveau mr-2 m-1" style="margin-left: 5px;" disabled>CHECK CTL007</a>
              <a href="#" class="btn btn-danger termier pull-right blockerSiNouveau m-1" style="margin-left: 10px;" disabled>TERMINER</a>
              <a href="#" class="btn btn-info asuivre pull-right blockerSiNouveau m-1" style="margin-left: 10px" disabled>A SUIVRE</a>
              <a href="#" class="btn btn-primary firstcontaact collapse pull-right m-1 blockerSiNouveau" disabled>PREMIER CONTACT</a>
              <a href="#" class="btn btn-primary nouveauDiscussion pull-right collapse m-1" style="margin-left: 10px">NOUVELLE DISCUSSION</a>
            </div>
            <div class="form-group col-md-12 text-left collapse btn-disabled">
              <a href="#" class="btn btn-success blockerSiNouveau" disabled>CONCLURE</a>
              <a href="#" class="btn btn-danger blockerSiNouveau" disabled>TERMINER</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade form_observation" id="observationModal" tabindex="-1" role="dialog" aria-labelledby="observationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title text-uppercase" style="text-align:center;width:100%;" id="exampleModalLabel"><b>Observation</b></h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body shadow" style="background:#EEEEEE!important">
          <fieldset class="border p-1" style="padding:2px; border: solid #424242 1px!important;">
            <legend class="w-auto">A propos</legend>
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="account" class="form-label">Comptes</label>
                  <select class="form-select form-select-sm custom-select account" name="account" id="account">
                    <option selected value="compte personnel">COMPTE PERSONNEL</option>
                    <option value="compte professionnel">COMPTE PROFESSIONNEL</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
              <div class="mb-3">
                  <label for="sexe" class="form-label">Sexe</label>
                  <select class="form-select form-select-sm custom-select sexe" name="sexe" id="sexe">
                    <option selected value="femme">FEMME</option>
                    <option value="homme">HOMME</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="approximateAge" class="form-label">Age approximatif</label>
                  <select class="form-select form-select-sm custom-select approximateAge" name="approximateAge" id="approximateAge">
                    <?php $first = true; ?>
                    <?php foreach ($age_range as $item) : ?>
                        <option value="<?= $item->id ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                            <?= $item->range ?>
                        </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="fbAge" class="form-label">Age sur Facebook</label>
                  <select class="form-select form-select-sm custom-select fbAge" name="fbAge" id="fbAge">
                    <?php $first = true; ?>
                    <?php foreach ($age_range as $item) : ?>
                        <option value="<?= $item->id ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                            <?= $item->range ?>
                        </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="clientLocalisation" class="form-label">Localisation du client</label>
                  <select class="form-select form-select-sm custom-select clientLocalisation" name="clientLocalisation" id="clientLocalisation">
                    <?php $first = true; ?>
                    <?php foreach ($districts as $item) : ?>
                      <option value="<?= $item->District ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                              <?= $item->District ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="deliveryArea" class="form-label">Axe de livraison</label>
                  <select class="form-select form-select-sm custom-select deliveryArea" name="deliveryArea" id="deliveryArea">
                    <?php $first = true; ?>
                    <?php foreach ($delivery_area as $item) : ?>
                      <option value="<?= $item->id_delivery_area ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                              <?= $item->axe ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </fieldset>
          
          <fieldset class="border p-1" style="padding:2px; border: solid #424242 1px!important;">
            <legend class="w-auto">Fil d'actualité</legend>
            <div class="row mx-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="displayOptions" id="displayActu" value="withActu" checked>
                <label class="form-check-label" for="displayActu">
                  Avec fil d'actualité
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="displayOptions" id="NotDisplayActu" value="withoutActu">
                <label class="form-check-label" for="NotDisplayActu">
                  Sans fil d'actualité
                </label>
              </div>
            </div>
            <div id="actu">
              <div class="row mb-1">
                <div class="col-3">
                  <label for="wellHealth" class="form-label">Bien etre</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[0]">
                            -
                        </button>
                    </span>
                    <input type="number" id="wellHealth" disabled name="quant[0]" class="form-control form-control-sm text-center wellHealth" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[0]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="restaurant" class="form-label">Restaurant et nourriture</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[1]">
                            -
                        </button>
                    </span>
                    <input type="number" id="restaurant" disabled name="quant[1]" class="form-control form-control-sm text-center restaurant" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[1]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="shopping" class="form-label">Shopping</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[2]">
                            -
                        </button>
                    </span>
                    <input type="number" id="shopping" disabled name="quant[2]" class="form-control form-control-sm text-center shopping" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[2]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="travel" class="form-label">Voyage</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[3]">
                            -
                        </button>
                    </span>
                    <input type="number" id="travel" disabled name="quant[3]" class="form-control form-control-sm text-center travel" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[3]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row mb-1">
                <div class="col-3">
                  <label for="politic" class="form-label">Politique</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[4]">
                            -
                        </button>
                    </span>
                    <input type="number" id="politic" disabled name="quant[4]" class="form-control form-control-sm text-center politic" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[4]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="social" class="form-label">Social</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[5]">
                            -
                        </button>
                    </span>
                    <input type="number" id="social" disabled name="quant[5]" class="form-control form-control-sm text-center social" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[5]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="newsPeople" class="form-label">Actu people</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[6]">
                            -
                        </button>
                    </span>
                    <input type="number" id="newsPeople" disabled name="quant[6]" class="form-control form-control-sm text-center newsPeople" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[6]">
                            +
                        </button>
                    </span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="sport" class="form-label">Sport</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[7]">
                            -
                        </button>
                    </span>
                    <input type="number" id="sport" disabled name="quant[7]" class="form-control form-control-sm text-center sport" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[7]">
                            +
                        </button>
                    </span>
                  </div>
                </div> 
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="cosmetique" class="form-label">Cosmetique</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[8]">
                            -
                        </button>
                    </span>
                    <input type="number" id="cosmetique" disabled name="quant[8]" class="form-control form-control-sm text-center cosmetique" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[8]">
                            +
                        </button>
                    </span>
                  </div>
                </div>   
                <div class="col-3">
                  <label for="mode" class="form-label">Mode</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[9]">
                            -
                        </button>
                    </span>
                    <input type="number" id="mode" disabled name="quant[9]" class="form-control form-control-sm text-center mode" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[9]">
                            +
                        </button>
                    </span>
                  </div>
                </div>   
                <div class="col-3">
                  <label for="other" class="form-label">Autre</label>
                  <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="minus" data-field="quant[10]">
                            -
                        </button>
                    </span>
                    <input type="number" id="other" disabled name="quant[10]" class="form-control form-control-sm text-center other" value="0" min="1" max="20">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-info btn-number" data-type="plus" data-field="quant[10]">
                            +
                        </button>
                    </span>
                  </div>
                </div>         
              </div>
            </div>
          </fieldset>

          <fieldset class="border p-1" style="padding:2px; border: solid #424242 1px!important;" id="monitoring-fieldset">
            <legend class="w-auto">Monitoring</legend>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">A propos</th>
                  <th scope="col">Produits</th>
                  <th scope="col">Contraintes</th>
                  <th scope="col">Appreciation de l'OPLG</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody id="observation-table">
              </tbody>
            </table>
          </fieldset>

          <fieldset class="border p-1" style="padding:2px; border: solid #424242 1px!important;">
            <legend class="w-auto">Conclusion de la discussion</legend>
            <div class="row mb-3">
              <div class="col-6">
                <label for="productName" class="form-label">Nom du produit</label>
                <div id="product-container">
                  <div class="product-row">
                    <select class="form-select form-select-sm custom-select productName" name="productName[]" id="productName">
                        <?php foreach ($data_type as $key => $item) : ?>
                            <option value="<?= $item->Code_produit ?>">
                                <?= $item->Designation ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-sm btn-primary add-product"><b>+</b></button>
                    <button type="button" class="btn btn-sm btn-danger remove-product"><b>-</b></button>
                  </div>
                </div>
                
              </div>
              <div class="col-6">
                <label for="constraint" class="form-label">Contraintes</label>
                <select class="form-select form-select-sm custom-select constraint" name="constraint" id="constraint">
                    <?php $first = true; ?>
                    <?php foreach ($constraint as $item) : ?>
                        <option value="<?= $item->id_constraint ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                            <?= $item->description_customer ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <label for="appreciation" class="form-label">Appreciation de l'OPLG</label>
                <select class="form-select form-select-sm custom-select appreciation" name="appreciation" id="appreciation">
                    <?php $first = true; ?>
                    <?php foreach ($appreciation_oplg as $item) : ?>
                        <option value="<?= $item->id_appreciation_oplg ?>" <?php if ($first) { echo 'selected'; $first = false; } ?>>
                            <?= $item->description_appreciation ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="col-6">
                <label for="priceWishes" class="form-label">Prix souhaite par le client</label>
                <input type="number" class="form-control custom-input" value="0" id="priceWishes" name="priceWishes" min="0">
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success save_observation">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>

  <!-------------------------------------------------------------------------------------------------------------------->
  <div class="modal fade form_vente" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title text-uppercase" style="text-align:center;width:100%;" id="exampleModalLabel"><b>Enregistrement commande</b></h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body shadow" style="background:#EEEEEE!important">
          <span class="collapse id_facture_collapse"></span>
          <fieldset class="border p-2" style="padding:2px; border: solid #424242 1px!important;">
            <legend class="w-auto">Produit</legend>
            <div class="form-group d-flex" style="margin-bottom: 20px!important">
              <div class="col-lg-3">
                <select class="form-control form-control-sm famille custom-select" name="famille" placeholder="Cathegory">
                  <?php foreach ($famille as $famille) : ?>
                    <option value="<?= $famille->Id ?>"><?= $famille->famille ?></option>
                  <?php endforeach; ?>
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
                  <?php foreach ($mission as $zone) : ?>
                    <option value="<?= $zone->Id ?>"><?= $zone->Zone ?></option>
                  <?php endforeach; ?>
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
                    <thead class="text-white" style="background-color: #428bac;">
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
            <legend class="w-auto">Bon d'achat</legend>
            <div class="row">
            <div class="form-group col-md-12 bon-Achat-Alert ">
            
            </div>
              <div class="form-group col-md-4">
                <select class="form-control custom-select form-control-sm bon-achat" id="bon-achat">
                  <option id="0"></option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control bon-achat-input form-control-sm border-1 w-75" name="bon-achat-input" disabled value="0" style="background: white!important">
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
                      <?php
                      foreach ($promotion as $promotion) : ?>
                        <option><?= $promotion->Pr_Code_Promo ?></option>
                      <?php endforeach; ?>
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
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-success enregistre_commande">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>

  <!-------------------------------------------------------------------------------------------------------------------->
  <div class="modal fade bd-example-modal-xs RDV" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleM" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <fieldset>
          <div class="modal-header bg-info">
            <h2 class="modal-title" id="exampleModalLongTitle">Enregistrement d'un rendez-Vous</h2>
          </div>
        </fieldset>
        <fieldset>
          <div class="modal-body">
            <div class="row">

              <div class="col-md-4 form-group">
                <label class="control-label" for="inputSuccess">Date: <span class="required"> *</span></label>
                <input type="date" class="form-control form-control-sm daterdv " />
              </div>

              <div class="form-group col-md-4">
                <label class="control-label" for="inputSuccess">Heure: <span class="required"> *</span></label>
                <input type="time" class="form-control form-control-sm heurervd" min="08:00" max="16:00" />
              </div>
              <div class="form-group col-md-4">
                <label>Contact :</label>
                <input type="tel" id="contact" name="contact" class="form-control form-control-sm contactRvd" placeholder="+261 33 32 123 12" pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" minlength="10" maxlength="10">
              </div>
              <hr />

              <div class="form-group col-md-12 text-rigth">

                <select class="form-control form-control-sm custom-select produiRV w-100">
                  <option hidden></option>
                  <?php foreach ($data_type as $key => $data_type) : ?>
                    <option value="<?= $data_type->Code_produit ?>"><?= $data_type->Designation ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-12">

                <textarea class="form-control produiRV w-100" placeholder="OBSERVATION"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success saveContact">Enregistrer</button>
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
  <!-------------------------------------------------------------------------------------------------------------------->



  <div class="modal fade plus_client" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ajout client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container autreinpp">
            <div class="row">
              <div class="card">
                <div class="card-body text-center" style="padding:10%;">

                  <div class="form-group">
                    <img class="img-thumbnail  w-20" id="preview" style="width:180px;height:180px; object-fit:cover" src="<?= base_url('images/default_user.png') ?>" alt="client"><br>
                    <div class="upload-btn-wrapper" style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                      <button class="btn btn-primary" style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;">Parcourir</button>
                      <input id="image" name="image" type="file" required style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;" />
                    </div>
                  </div>
                  <div class="form-group">
                    <input id="liensurfb" class="form-control" type="text" name="" placeholder="LIEN Facebook">
                  </div>
                  <div class="form-group">
                    <input id="identifient" class="form-control" type="text" name="" placeholder="ID Facebook">
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input id="identifient" class="form-control coach" type="text" name="" placeholder="Coach">
                    </div>
                    <div class="form-group col-md-6">
                      <input id="identifient" class="form-control commerciale" type="text" name="" placeholder="Commerciale">
                    </div>
                  </div>
                  <div class="form-group">
                    Ajouter un nouveau client &nbsp; <a href="#" class="btn btn-default" style='border-radius:50%;'><i class="fa fa-plus bg-gray"></i></a>
                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-primary pull-right collapse testPo"><i class="fa fa-plus-circle bg-gray"></i> Suivant</a>
              <a href="#" class="btn btn-success pull-right save"><i class="fa fa-plus-circle bg-gray"></i> Enregistrer</a>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove-circle bg-gray"></i> Fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade localisations" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleM" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleM">Ajout client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body localisation_content"></div>
          <div class="modal-footer">
            <a href="#" class="btn btn-primary pull-right collapse testPo">Suivant<span class="arrow_carrot-right"></span></a>
            <a href="#" class="btn btn-success pull-right save">Enregistrer<span class="arrow_carrot-right"></span></a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>