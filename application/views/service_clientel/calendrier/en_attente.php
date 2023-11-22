<div class="row">
    <div class="col-xs-5 col-sm-4  text-center">
        <span class="profile-picture">

            <img alt="<?=$client->Code_client?>" class="simple img-thumbnail"
                src="<?=base_url('images/client/'.$client->Code_client)?>.jpg" style="height:160px;width:160px;">
        </span>
        <div class="space space-4"></div>
    </div>
    <div class="col-xs-3 col-sm-3">
        <h4 class="blue">
            <span class="middle"><?=$client->Nom." ".$client->Prenom?></span><br />
            <span class="middle"><?=$client->Code_client?></span>
            <span class="middle facture collapse"><?=$client->Id_facture?></span>
        </h4>

        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name" style="text-align: left;">
                    <i class="middle ace-icon fa fa-phone-square bigger-150 green"></i> Contact :
                    <b><?=$client->contacts?></b>

                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name" style="text-align: left;">Localisation : <i
                        class="fa fa-map-marker light-orange bigger-110"></i><span><?=$client->Ville.",".$client->Quartier?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">
                    <div class="profile-info-value">
                        <span><a href="<?=$client->lien_facebook?>" target="_blank"><i class="fab fa-facebook"></i>
                                facebook </span>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="col-xs-3 col-sm-3">
        <div style="overflow:hidden;width: 300px;height: 150px;"><iframe width="350" height="400"
                src="https://maps.google.com/maps?width=350&amp;height=400&amp;hl=en&amp;q=%20%09<?=$client->Quartier?>%20%2C%20<?=$client->Quartier?>%20%2C<?=$client->Ville?>%2Cmadagascar+(Titre)&amp;ie=UTF8&amp;t=k&amp;z=17&amp;iwloc=B&amp;output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            <div><small><a href="https://embedgooglemaps.com/en/">embedgooglemaps FR</a></small></div>
            <div><small><a href="https://newyorkhoponhopoffbus.nl">new york city freestyle pass: hop-on,
                        hop-off tour en ferry</a></small></div>
            <style>
                #gmap_canvas img {
                    max-width: none !important;
                    background: none !important
                }
            </style>
        </div><br />
    </div>
    <div class="confirm">
    </div>
</div>

<?php if($cadeau):?>
<div class="row">
<span class="alert alert-danger bg-success text-white">
   Cadeau pour le client: <br>
   <ul>
    <?php foreach($cadeau as $cadeau):?>
      <li>
      <?=$cadeau->cadeau?>
     </li>
    <?php endforeach;?>
   </ul>
  </span>
</div>
<?php endif;?>
<fieldset class="border p-2 w-100">
<legend class="w-auto">Détail achat</legend>
<div class="row">
    <div class="col-md-12 p-0">
        <table class="table table-stripped w-100 table-sm table-bordered" id="table">
            <thead class="text-white bg-danger">
                <tr>
                    <th class="collapse">Id</th>
                    <th class="text-center">
                        Produit</th>
                    <th class="text-center">
                        Prix en Ariary</th>
                    <th class="text-center">
                        Quantité</th>
                    <th class="text-center">
                        Total en Ariary</th>
                    <th class="text-center">
                        Statut</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <?php $total=0; foreach($commande as $commande):?>
                <tr>
                    <td class="text-center"><a href="<?=base_url('images/produit/'.$commande->Code_produit)?>.jpg"
                            data-lightbox="roadtrip"><?=$commande->Designation?></a></td>
                    <td class="text-center"><?php echo  number_format($commande->Prix_detail, 2, ',', ' ');?></td>
                    <td class="text-center"><?=$commande->Quantite?></td>
                    <td class="text-center total">
                        <?php $total+=$commande->Prix_detail*$commande->Quantite; echo number_format($commande->Prix_detail*$commande->Quantite, 2, ',', ' ');?>
                    </td>
                    <td class="text-center"> <?=strtoupper($commande->statut)?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">
                        <span style="color: #000">Emetteur :&nbsp;<span
                                style="background-color: #007bff ;padding: 5px;color:white" class="rounded">&nbsp;<?=$client->Matricule_personnel?></span>
                    </th>
                    <th>
                    </th>
                    <th class="text-center">Sous total en Ariary </th>
                    <th>
                        <span class="rounded" style="background-color: #007bff ;padding: 5px;color:white"> <?=number_format($total, 2, ',', ' ');
                             ?> Ariary
                        </span>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</fieldset>
<div class="row">
    <div class="col-md-12">
            <div class="panel-body">
                    <form class="form-horizontal" method="post">
                        <div class="row" style="background-color: #fafafa;">
                            <div class="col-md-6">
                            <fieldset class="border p-2 w-100 card">
                                <legend class="w-auto">Informations souhaitées par le client</legend>
                                <div class="form-group" style="margin-top: 20px">
                                    <label class="col-sm-2 control-label">Date de livraison</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control " class="col-md-10"
                                            value="<?=$client->date_de_livraison?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Heure de livraison</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="Time" class="form-control " class="col-md-12"
                                                value="<?=$client->heure_livre_debut?>" disabled>
                                        </div>
                                        <span class="pt-2"> &nbsp; à &nbsp;</span>

                                        <div class="col-sm-4">
                                            <input type="Time" class="form-control " class="col-md-12"
                                                value="<?=$client->heure_livre_fin?>" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">lieu de livraison</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " class="col-md-12"
                                            value="<?=$client->lieu_de_livraison?>" disabled>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Remarque</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control p-1" disabled><?=$client->Remarque?> </textarea>

                                    </div>
                                </div>

                                <div class="form-group " style="margin-bottom: 5px!important">

                                    <label class="col-sm-2 control-label text-left">Matricule vendeur secondaire</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control matricule" class="col-md-8"
                                            value="<?=$client->Ress_sec_oplg?>" style="height:60px" disabled>
                                    </div>
                                </div>
                            <div class="row">
                           
                            <div class="form-group">
                                <div class="col-md-12 text-white ">
                                    <div class="col-md-12" style="margin-top: 25px;">
                                        <a class="btn btn-success m-1 valider pull-right "
                                            href="fonction/fonctionvente.php?idfacture=0"> Valider</a>
                                        <a class="btn btn-info m-1 pull-right reporte collapse"
                                            href="<?=base_url('service_clientel/repporter/')?>"><span
                                                style="background:#2980b9;height:100%;width:150px;"></span> Reporter</a>
                                        <!--<a class="btn m-1 btn-danger pull-right" data-toggle="modal"
                                            data-target="#myModal"></span> Annuler</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                                </fieldset>
                            </div>
                            <div class="col-md-6">
                            <fieldset class="border p-2 w-100 card">
                                <legend class="w-auto" > Disponiblité du livreur</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date de livraison</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control datelivre" class="col-md-10" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Heure de livraison</label>
                                    <div class="col-sm-10">
                                        <input type="Time" class="form-control debut" class="col-md-12" value="00">
                                    </div>

                                </div>
                                <div class="form-group " style="margin-bottom: 5px!important">

                                    <label class="col-sm-2 control-label text-left">Lieu de livraison SC</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control lieulivrsc"
                                            onkeyUp="javascript:this.value=this.value.toUpperCase();" class="col-md-8"
                                            value="" style="height:60px">
                                    </div>
                                </div>
                                <div class="form-group " style="margin-bottom: 5px!important">

                                    <label class="col-sm-2 control-label text-left">Matricule vendeur secondaire</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control matrisec"
                                            onkeyUp="javascript:this.value=this.value.toUpperCase();" maxlength="7"
                                            minlength="7" class="col-md-8" value="" style="height:60px">
                                    </div>
                                </div>

                                <div class="form-group " style="margin-bottom: 5px!important">

                                    <label class="col-sm-2 control-label text-left">Contact livraison</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control cotactliv" class="col-md-8"
                                            maxlength="10" minlength="10" value="" style="height:60px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Remarque</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control remarque"
                                            onkeyUp="javascript:this.value=this.value.toUpperCase();"></textarea>
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                        </div>
                       

            </div>
            </fieldset>
    </div>
    </form>
</div>
</section>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <form action="" method="post">
                    <p class="modal-title">Annuller la commande <?=$client->Id_facture?> </p>
                   
            </div>
            <div class="modal-body">
                <div class="form-group">

                    <label for="textarea">Code d'annulation</label>
                    <select class="form-control annula" name="id_annul">
                        <?php foreach($annulation as $annulation):?>
                        <option value="<?=$annulation->code_annul?>"><?=$annulation->contenu?></option>
                        <?php endforeach;?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="textarea">Remarque</label>
                    <textarea name="" id="" cols="30" rows="5" class="form-control Remarqueannul"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" href="#" class="btn btn-success pull-right Annule">Annuler la commande</a>
                <button style="margin-right: 20px" type="button" class="btn btn-danger"
                    data-dismiss="modal">Fermer</button>
            </div>
        </div>
        </form>

    </div>
</div>