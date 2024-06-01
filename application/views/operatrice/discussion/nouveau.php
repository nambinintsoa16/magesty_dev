<style>
.file-upload {
    position: relative;
    overflow: hidden;
    /* border-radius: 50% !important;*/
    background: green;
    text-transform: uppercase;
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

.file-upload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;

}

#fileuploadurl {
    display: inline-block;
    vertical-align: middle;
    background: none;
    box-shadow: none;
    margin-right: 10px;
    font-size: 13px;
    padding: 4px;
    width: 670px;

}

.cont-app {
    background-color: #fff;
    border-radius: 5px;
    padding: 10px;
}
</style>
<div class="p-auto m-0 w-100">
    <div class="row p-0 m-0 ">
        <div class="col-md-12">
            <div class="alert alert-page alert-success animated bounceInRight w-100 " role="alert">
                Page actuelle : <span class="pageNav"><?=  $this->session->userdata('pageName') ?></span>
                <span class=""></span>
                <span class=""></span>
            </div>
        </div>
    </div>
    <div class="row p-0 m-0 w-100">
        <div class="card m-3  shadow w-100 rounded">
            <div class="col-md-12 m-auto" style="background:#e0e0e0">
            <h2 class="mt-2"><b>ENREGISTREMENT TACHE</b></h2>
            <hr class="bg-primary mt-3 ">
                <div class="form-group ">
                    <label for="cemail" class="control-label"><b>Page ou compte:</b><span
                            class="requierd"></span></label>
                    <select class="form-control pageUsers form-control-sm custom-select">
                        <option hidden></option>
                        <?php foreach ($page_user as $key => $page_user) : ?>
                        <option value="<?= $page_user->id ?>">
                            <?= strtoupper($page_user->Type) ?> - <?= $page_user->Nom_page ?> -
                            <?= strtoupper($page_user->Source) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row form-group d-flex">
                    <div class="col-md-6">
                        <label for="cemail" class="control-label"><b>Code du produit:</b><span
                                class="requierd"></span></label>
                        <input class="form-control form-control-sm  codeproduit"
                            onKeyUp="javascript:this.value=this.value.toUpperCase();" type="text"
                            id="example-datetime-local-input" name="codeproduit"
                            placehoulder="entrer la code du produit">
                    </div>
                    <div class="col-md-6">
                        <label for="cemail" class="control-label"><b>Nom du produit:</b><span
                                class="requierd"></span></label>
                        <input class="form-control form-control-sm  nomproduit"
                            onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled type="text"
                            id="example-datetime" name="nomproduit">
                    </div>
                </div>
                <div class="row form-group d-flex">
                    <div class="col-md-6">
                        <label for=""><b>Tâche :</b></label>
                        <select class="form-control form-control-sm custom-select select1">
                            <option hidden></option>
                            <?php foreach ($data_type as $key => $data_type) : ?>
                            <option value="<?= $data_type->id ?>"><?= $data_type->designation ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="col-lg-2" for=""><b>Action :</b></label>
                        <select class="form-control form-control-sm custom-select select2"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cemail" class="control-label"><b>Code de la publication :</b><span
                            class="required"></span></label>
                    <input class="form-control codepublication form-control-sm"
                        onKeyUp="javascript:this.value=this.value.toUpperCase();"
                        placehoulder="entrer la code de publication" type="text" id="example-datetime-local-input"
                        name="codepublication">
                </div>
                <div class="row form-group d-flex">
                    <div class="col-md-6">
                        <label for="cemail" class="control-label"><b>Code groupe/page/compte:</b><span
                                class="requierd"></span></label>
                        <input class="form-control codegroupe form-control-sm"
                            onKeyUp="javascript:this.value=this.value.toUpperCase();" type="text" name="codegroupe">
                    </div>
                    <div class="col-md-6">
                        <label for="cemail" class="control-label"><b>Nom groupe/page/compte:</b><span
                                class="requierd"></span></label>
                        <input class="form-control nomgroupe form-control-sm" disabled type="text" id="example-datetime"
                            name="nomgroupe">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cemail" class="control-label col-lg-2"><b>Lien du support :</b><span
                            class="required"></span></label>
                    <input class="form-control Lien_support form-control-sm" id="Lien" disabled type="text"
                        name="Lien" />
                </div>
                <div class="form-group collapse">
                    <label for="example-datetime-local-input" class="control-label col-lg-2"><b>Date :</b><span
                            class="requierd"></span></label>
                    <div class="col-lg-10" style="margin-bottom: 10px!important">
                        <div class="row">
                            <div class="col-lg-3">
                                <input class="form-control date form-control-sm" type="date"
                                    id="example-datetime-local-input" name="date">
                            </div>
                            <label for="example-datetime" style="margin-left:75px"
                                class="control-label col-lg-2"><b>Heure :</b><span class="requierd"></span></label>
                            <div class="col-lg-3">
                                <input class="form-control time form-control-sm" type="time" id="example-datetime"
                                    name="heure">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right mb-5 mt-3">
                    <button type="submit" class="btn btn-success pull-right btn-test" width="50px">
                        <i class="flaticon-success"></i>&nbsp;
                        Valider</button>
                </div>
                <hr class="bg-primary mt-3 ">
                <h2><b>ACTIVITE DU JOUR</b></h2>
                <div class="col-md-12 mt-5 p-0 ">
                    <div class="table-responsive m-0 p-0">
                        <table class="dataTable table-bordered table table-sm table-striped table-hover w-100">
                            <thead class="bg-<?=$nav_color?> text-white">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Heure</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Code de la publication</th>
                                    <th scope="col">Code du produit</th>
                                    <th scope="col">Nom du produit</th>
                                    <th scope="col">Code groupe/page/compte</th>
                                    <th scope="col">Groupe/page/compte</th>                                    
                                    <th scope="col">Client</th>
                                    <th scope="col">Tâche</th>
                                </tr>
                            </thead>
                            <tbody class="tabeContect bg-white">
                                <?php foreach($dataTaches as $datas):?>
                                    <tr>
                                       <td><?=$datas->Date?></td>
                                       <td><?=$datas->Heure?></td>
                                       <td><?=$datas->Actions?></td>
                                       <td><?=$datas->Code_publication?></td>
                                       <td><?=$datas->Code_produit?></td>
                                       <td><?=$datas->Nom_produit?></td>
                                       <td><?=$datas->Code_groupe?></td>
                                       <td><a href='<?=$datas->Lien_support?>' target='_blank'><?=$datas->Nom_groupe?></a></td>
                                       <td><a href='#' class="client"><?=$datas->Client?></a></td>
                                       <td><?php if($datas->activite=='CONCLUE'){echo '<i class="fa fa-check-circle text-success"></i>&nbsp CONCLUE';} else {'';} ?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade plus_client" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-<?=$nav_color?> text-white">
                <h5 class="modal-title" id="exampleModalLabel"><span class="text-danger show-message-danger"></span> </h5>
                <button type="button" class="close  text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container autreinpp bg-Light ">

                    <div class="row cont-app">
                        <div class="form-group col-md-6 m-auto text-center">
                            <img class="img-thumbnail w-20" id="preview"
                                style="width:180px;height:180px; object-fit:cover"
                                src="<?= base_url('images/default_user.png') ?>" alt="client"><br>
                            <div class="upload-btn-wrapper"
                                style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                                <button class="btn btn-primary"
                                    style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;">Parcourir</button>
                                <input id="image" name="image" type="file" required
                                    style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;" />
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input id="liensurfb" class="form-control" type="text" name="" placeholder="LIEN Facebook">
                        </div>
                        <div class="form-group col-md-12">
                            <input id="identifient" class="form-control" type="text" name="" placeholder="ID Facebook">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input id="coach_p" class="form-control coach" type="text" name=""
                                        placeholder="Coach">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="commerciale_p" class="form-control commerciale" type="text" name=""
                                        placeholder="Commerciale">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary collapse next"><i
                        class="fa fa-plus-circle bg-gray"></i>&nbsp;Suivant</a>
                <a href="#" class="btn btn-success save"><i
                        class="fa fa-plus-circle bg-gray"></i>&nbsp;Enregistrer</span></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fa fa-remove-circle bg-gray fermerModale"></i> Fermer</button>

            </div>
        </div>
    </div>
</div>
