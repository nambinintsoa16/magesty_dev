<?php if (!empty($client)) : ?>
    <fieldset class="w-100 border p-0 ">
        <legend class="w-auto">Modification</legend>
        <div class="panel-body m-2">
            <div class="row p-3 bg-white m-auto shadow-sm rounded">
                <div class="col-xs-5 col-sm-4  w-100">
                    <span class="profile-picture">
                        <img alt="<?= $client->Code_client ?>" src="<?= code_client_img_link($client->Code_client) ?>" class="img-thumbnail simple" style="height:160px;width:160px;">
                    </span>
                    <div class="space space-4"></div>
                    </a>
                    <span class="collapse idfactureId">
                        <?= $client->Id ?>
                    </span>
                </div>
                <div class="col-xs-3 col-sm-3">
                    <h4 class="blue">
                        <span class="middle"><?= $client->Nom . " " . $client->Prenom ?></span>
                    </h4>
                    <div class="profile-user-info">
                        <h5 class="blue">
                            <span class="middle"><?= $client->Code_client ?></span><br/>
                            <a href="#" id="<?= $client->Id ?>" class="btn btn-warning btn-sm change_client p-1"> <i class="fa fa-edit"></i>&nbsp; Changer client</a>
                        </h5>
                    </div>
                    <div class="profile-user-info">
                        <div class="profile-info-row">
                            <div class="profile-info-name" style="text-align: left;">
                              <i class="middle ace-icon fa fa-phone-square bigger-150 green"></i> Contact 
                                : <?= $client->contacts ?></b>&nbsp;<a href="#" class="btn btn-sm btn-warning p-1 update-contact" id="<?= $client->Code_client ?>"><i class="fa fa-edit"></i> Modifier contact</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-4 center ">
                    <div class="row">
                        <div class="form-groupe  col-md-8">
                            <select class="custom-select statut custom-select-sm">
                                <option>confirmer</option>
                                <option>annule</option>
                                <option>en_attente</option>
                                <option>livre</option>
                            </select>
                        </div>
                        <div class="form-groupe  col-md-4 p-0">
                            <a href="#" class="btn btn-warning btn-statut btn-sm w-100 p-1"><i class="fa fa-edit"></i>&nbsp;
                                Statut de livraison</a>
                        </div>
                        <div class="form-groupe  col-md-8 mt-2">
                            <select class="custom-select statut-koty custom-select-sm">
                                <option>FACEBOOK</option>
                                <option>TSENA_KOTY</option>
                            </select>
                        </div>
                        <div class="form-groupe  col-md-4 mt-2 p-0">
                            <a href="#" class="btn btn-warning btn-statut-koty btn-sm w-100 p-1"><i class="fa fa-edit"></i>&nbsp; Origin</a>
                        </div>

                        <div class="form-groupe  col-md-8 mt-2">
                            <input type="text" class="form-control form-control-sm frais" disabled value="<?= ($client->frais_de_retrait == " ") ? 0 : $client->frais_de_retrait ?>">
                        </div>
                        <div class="form-groupe  col-md-4 mt-2 p-0">
                            <a href="#" class="btn btn-warning btn-statut-retrait btn-sm w-100 p-1" id="<?= $client->id ?>"><i class="fa fa-edit"></i>&nbsp; Frais de retrait</a>
                        </div>
                        <div class="form-groupe  col-md-12 mt-2 p-0 text-right">
                            <a href="#" class="btn btn-warning btn-statut-add-prod btn-sm w-50 p-1" id="<?= $client->id ?>"><i class="fa fa-edit"></i>&nbsp; Nouveau produit</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <table class="table table-striped table-advance table-hover bg-white" style="margin-top: 60px;">
            <thead class="bg-success">

                 <tr class="border">
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 250px;" > 
                        Opératrice
                    </th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff; width: 200px" colspan="2">
                        <?=$client->Matricule_personnel?><br/>
                         <a href="#" class="btn btn-sm btn-warning p-1 update-operatrice" id="<?= $client->Id ?>"><i class="fa fa-edit"></i>&nbsp;Modifier opèratrice</a>
                    </th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 267px;">
                        Compte / Page facebook 
                     </th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;" colspan="2"> 
                        <?php  
                             $this->load->model('administrateur_model');
                             $compte = $this->administrateur_model->getComptefb(['id'=>$client->Page]);
                             echo $compte ? $compte->Nom_page : "";
                             
                        ?><br/>
                        <a href="#" class="btn btn-sm btn-warning p-1 update-page" id="<?= $client->Id ?>"><i class="fa fa-edit"></i>&nbsp;Modifier page</a>
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 250px;"> Nom du livreur
                    </th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff; width: 200px"> Date de
                        livraison</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 267px;"> Heure de
                        livraison </th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;"> Lieu de livraison</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;">Frais</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 142px;"> Statut</th>
                </tr>

            </thead>
            <tbody>

                <tr>
                    <td style="text-align: center;">
                        <?= $client->idlivreur ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $client->date_de_livraison ?>
                        &nbsp;<a href="#" id="<?= $client->id ?>" class="btn btn-warning btn-sm edit_date_livraison"> <i class="fa fa-edit"></i> </a>

                    </td>
                    <td style="text-align: center;">
                        <?php
                        if ($client->heure_deb_livre == "") {
                            echo  "Entre &nbsp;" . $client->heure_livre_debut . " et " . $client->heure_livre_fin;
                        } else {
                            echo  "Entre &nbsp;" . $client->heure_deb_livre . " et " . $client->heure_fi_livre;
                        }
                        ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $client->Quartier ?>
                        &nbsp;<a href="#" id="<?= $client->id ?>" class="btn btn-warning btn-sm edit_lieu_livraison"> <i class="fa fa-edit"></i> </a>
                    </td>
                    <td style="text-align: center;">
                        <?= $client->frais ?> &nbsp; Ariary &nbsp;
                        &nbsp;<a href="#" id="<?= $client->id ?>" class="btn btn-warning btn-sm modifrais"> <i class="fa fa-edit"></i> </a>
                    </td>
                    <td style="text-align: center;">
                        <?= $client->Status ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table" style="border-top:solid 1px #dbdbdb;border-bottom:solid 1px #dbdbdb; margin-top: 10px;">
            <thead class="bg-success">
                <tr>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;width: 250px;">Produit</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;">Prix en Ariary</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;">Quantite</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;">Total en Ariary</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;">Statut</th>
                    <th style="text-align: center; color: #fff; border-left: 1px solid #fff;"></th>
                </tr>
            </thead>
            <tbody class="tbody tbody-data">
                <?php $total = 0;
                $nbtab = count($commande);
                foreach ($commande as $commande) : ?>

                    <tr>
                        <td style="text-align: center;" class="collapse Id"><?= $commande->Id ?></td>
                        <td style="text-align: center;" class="collapse Id_prix"><?= $commande->Id_prix ?></td>
                        <td style="text-align: center;">
                            <a href="<?= base_url('images/produit/' . $commande->Code_produit) ?>.jpg" data-lightbox="roadtrip"><?= $commande->Designation ?></a>
                        </td>
                        <td style="text-align: center;"><?= number_format($commande->Prix_detail, 2, ',', ' '); ?></td>
                        <td style="text-align: center;"><?= $commande->Quantite ?></td>
                        <td style="text-align: center;" class="total">
                            <?php $total += $commande->Prix_detail * $commande->Quantite;
                            echo number_format($commande->Prix_detail * $commande->Quantite, 2, ',', ' '); ?>
                        </td>
                        <td style="text-align: center;">
                            <?= strtoupper($commande->statut) ?>
                            <!--<img src="../img/produit/" class="img-thumbnail" style="width:60px;">-->
                        </td>
                        <td style="text-align: center;">
                            <a href="#" class="btn btn-warning modifiDetail btn-sm"><i class="fa fa-edit"></i></a>
                            <?php if ($nbtab > 1) : ?>
                                <a href="#" class="btn btn-danger modifiDelete btn-sm"><i class="fa fa-times"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr style="text-align: center; background-color: #ddd;color: #fff;">
                    <th style="text-align: center; background-color: #ddd;color:#000; border-left: 1px solid #fff;">Emetteur
                        :</th>
                    <th style="background: #007bff; text-align: center;;color: #fff; border-left: 1px solid #fff;">
                        &nbsp;<?= $client->Matricule_personnel ?>
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
    </fieldset>
  
<?php else : ?>

    <div class="panel-body m-2">
        <fieldset class="w-100 border p-0 ">
            <div class="w-100 text-center">
                <p>Facture non trouvé</p>
            </div>

        </fieldset>
    </div>
<?php endif ?>

<div class="modal fade" id="modateQuartier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modifier lieu de livraison</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row col-md-12 m-auto p-0 border text-left">
     
                <div class="form-group col-md-4">
                  <label for="cemail" class="control-label col-lg-4">Quartier<span class="required"> *</span></label>
                  <input class="form-control quartier form-control-sm" onKeyUp="javascript:this.value=this.value.toUpperCase();" id="quartier" type="text" name="quartier" />
                </div>
                <div class="form-group col-md-4">
                  <label for="cemail" class="control-label col-lg-4">Ville<span class="required"> *</span></label>
                  <input class="form-control ville form-control-sm" id="ville" disabled type="text" name="livraison" />
                </div>
                <div class="form-group col-md-4">
                  <label for="cemail" class="control-label col-lg-4">District<span class="required">*</span></label>
                  <input class="form-control District form-control-sm" id="District" disabled type="text" name="livraison" />
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-success enregistre_quartier">Enregistre</button>
      </div>
    </div>
  </div>
</div>