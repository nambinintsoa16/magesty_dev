<div class="container col-md-12">
    <div class="row">
        <div class="col-md-12">
            <img src="<?=base_url('images/banniere-user-min.jpg')?>" width="100%" height="400px"
                style="object-fit:cover; z-index:0;">
            <div style="z-index:0;margin-top:-330px;position:absolute;color:white;font-size:26px;padding-left:50px;">
                <img src="<?=PhotoUser_img_link($this->session->userdata('matricule'))?>"
                    class="style-image"
                    style="position:relative;border-radius:50%;margin-top:20px;border:solid 5px #fff;width:150px;height:150px;">
                <a href="#" class="image-change text-white" style="margin-top: 30px; position:absolute;"><i
                        class="flaticon-photo-camera"></i></a>
                <br>

                <br>
            </div>
            <div class="row" style="margin-top:-50px;">
                <div class="col-md-3 col-sm-6 col-xs-12 link"
                    style="padding-left:30px; padding-right:30px;border-radius: 5px !important;" id="vente">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-md-4" style="height:80px;background:#01aad3  !important">
                                <div class="info-box-icon"
                                    style="background:#0180a9;border-radius:50%;width:50px;height:50px;margin-top:15px;">
                                    <i class="fa fa-shopping-cart"
                                        style="font-size:22px;color:white;padding-top:15px;padding-left:15px;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 bleu" id="bleue"
                                style="height:80px;background:#01aad3 !important;padding-top:10px;color:white;">
                                <span class="info-box-text m-0">Commande réalisée</span><br>
                                <span class="info-box-number"><?=$data->vente_du_jour?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 link" style="padding-right:30px;" id="produit">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-md-4 " style="height:80px;background:#fc7184 !important;">
                                <div class="info-box-icon"
                                    style="background:#ce5866;border-radius:50%;width:50px;height:50px;margin-top:15px;">
                                    <i class="fa fa-edit"
                                        style="font-size:22px;color:white;padding-top:15px;padding-left:15px;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 orange" id="orangee"
                                style="height:80px;background:#fc7184 !important;padding-top:20px;color:white;">
                                <span class="info-box-text">Produit vendu</span><br>
                                <span
                                    class="info-box-number"><?= is_null($data->Produit_vendue) ? 0 : $data->Produit_vendue ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 link" style=" padding-right:30px;" id="client">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-md-4" style="height:80px;background:#feab41 !important">
                                <div class="info-box-icon"
                                    style="background:#d2762d;border-radius:50%;width:50px;height:50px;margin-top:15px;">
                                    <i class="fa fa-users"
                                        style="font-size:22px;color:white;padding-top:13px;padding-left:13px;"></i>
                                </div>
                            </div>
                            <div class="col-md-8 jaune" id="jaunee"
                                style="height:80px;background:#feab41 !important;padding-top:20px;color:white;">
                                <span class="info-box-text">Nouveau Client </span><br>
                                <span class="info-box-number"><?=$data->Nouveau_client?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 link" style=" padding-right:30px;" id="jours">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-md-4" style="height:80px;background:#28af6a  !important">
                                <div class="info-box-icon"
                                    style="background:#209761;border-radius:50%;width:50px;height:50px;margin-top:15px">
                                    <i class="fa fa-cubes"
                                        style="font-size:22px;color:white;padding-top:13px;padding-left:13px"></i>
                                </div>
                            </div>
                            <div class="col-md-8 vert" id="verte"
                                style="height:80px;background:#28af6a  !important;padding-top:20px;color:white">
                                <span class="info-box-text">Vente du jour</span><br>
                                <span class="info-box-number"><?=number_format($data->ventedujou, 2, ',', ' ');?> Ar
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="background:white;margin:15px 0px;">
        <div class="row" style="margin-top:10px;">
            <div class="col-md-8">
                <a href="fonction/class/dompdf/venteconfirmerexporte.php" class="btn btn-success print"><i
                        class="fa fa-download"></i>&nbsp;Exporter</a>
            </div>
            <div class="col-md-4 form-group">
                <select class="form-control famille">
                    <option>AUTRES</option>
                    <option>BEAUTE</option>
                    <option>BOISSON</option>
                    <option>DEO & PARFUM</option>
                    <option>HYGIENE BUCO-DENTAIRE</option>
                    <option>HYGIENE CORPORELLE</option>
                    <option>LESSIVE</option>
                    <option>SOINS CAPILLAIRE</option>
                    <option>SOINS VISAGE</option>
                </select>
            </div>
        </div>
        <div class="row" style="padding:5px;">
            <div class="form-group col-md-6">
                <div class="col-md-12" style=" height:100px;">
                    <h4><b>Courbe de Vente</b></h4>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="form-group col-md-6" style="text-align:right;">
                <div class="col-md-12" style=" height:300px;">
                    <h4><b>Statistique Produit vendu</b></h4>
                    <canvas id="singelBarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3">
                <div class="text-white p-4 text-center" style="height:80px;background:#01aad3 !important;">
                    <span class="info-box-text">Nombre de discussion :<br><b><?=$data->discussion?></b></span><br>
                    <span class="info-box-number"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-white p-4 text-center" style=" height:80px;background:#fc7184!important;">
                    <span class="info-box-text">Nombre de clients: <br><b><?=$data->NBCLINE?></b></span><br>
                    <span class="info-box-number"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-white p-4 text-center" style="height:80px;background:#feab41 !important;">
                    <span class="info-box-text">Nombre de tâche : <br><b>0</b><br>
                        <span class="info-box-number"></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-white p-4 text-center" style="height:80px;background:#28af6a !important;">
                    <span class="info-box-number">Recap du mois vente:<br></span>
                    <span><?=number_format($data->CAMOIS, 2, ',', ' ');?> Ar </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modalPerf" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="entetet">
                <h4 class="modal-title test2">Commande Réalisée</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body modalPerfVente">

                <div class="row">
                    <div class="responsive w-100">
                        <table class="table table-bordered table-bordered-bd-info" id="table">
                            <thead class="bg-info  text-white" id="headTable">
                                <tr>
                                    <th>Code client</th>
                                    <th>Identifient sur facebook </th>
                                    <th>Lien sur facebook </th>
                                    <th>Photo</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php  foreach ($client as $key => $client) : ?>
                                <tr>
                                    <td><?=$client->Code_client?></td>
                                    <td><?=$client->Compte_facebook?></td>
                                    <td><a href="<?=$client->lien_facebook?>" target="_blank"><i
                                                class="fa fa-facebook"></i></a></td>
                                    <td><img src="<?=code_client_img_link($client->Code_client)?>" class="img-thumbnail"
                                            width="50" height="50"></td>
                                </tr>
                                <?php endforeach;?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary exportPdf">Imprimer</a>
                <a href="#" class="btn btn-success printExcel">Exporter</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalImage" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="Title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?>">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="container p-2" style="background:#F7F3F3;">
                        <div class="row">
                            <div class="form-group m-auto col-md-5">
                                <img src="<?=PhotoUser_img_link($this->session->userdata('matricule'))?>" id="preview"
                                    class="img img-thumbnail" style="width: 150px; height: 150px;" /><br />
                                <div class="fileUpload btn btn-primary mr-2">
                                    <span>Choisir images</span>
                                    <input id="image" type="file" class="upload" name="image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success saveImage">Enregistrer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>