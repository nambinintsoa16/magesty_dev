<div class="container">
    <div class="row w-100 pl-2">
        <fieldset class="border p-2 bg-white col-md-12 ml-1">
            <legend class="w-auto"><small>Détail client</small></legend>
            <div class="row">
                <div class="form-group col-md-2">
                    <img src="<?= base_url('images/default_user.png') ?>" class="rounded float-left " alt="..." width="120">
                </div>
                <div class="form-group col-md-8">
                    <?php if ($infoclient != null) : ?>
                        <small><span id="code_client"><?= $infoclient->Code_client ?></span></small><br />
                        <a href="<?= $infoclient->lien_facebook ?>" target="_blank"><?= $infoclient->Compte_facebook ?></a><br />
                        <small>Enregistre le : <?= $infoclient->datedenregistrement ?></small>
                    <?php endif; ?>
                </div>
            </div>
        </fieldset>
    </div>

    <fieldset class="border p-2 bg-white ">
        <legend class="w-auto"><small>Détail achat</small></legend>
        <div class="row">
            <table class="table table-sm">
                <thead>
                    <td>Operatrice</td>
                    <td>Page / compte</td>
                    <td>Produit</td>
                    <td>PU</td>
                    <td>Quantité</td>
                    <td>check</td>
                </thead>
                <tbody class="tbody" id="table-produit">
                    <?php $p = 1;
                    foreach ($detail_facture as $detail_facture) : ?>
                        <tr>
                            <td><?= $detail_facture->Matricule_personnel ?></td>
                            <td><?= $detail_facture->Nom_page ?></td>
                            <td><?= $detail_facture->Designation ?></td>
                            <td><?= $detail_facture->Prix_detail ?></td>
                            <td><?= $detail_facture->Quantite ?></td>
                            <td><input type="radio" class="input_chose_produit" refnum_facture ="<?= $detail_facture->refnum_facture ?>" page="<?= $detail_facture->page ?>" id="<?= $detail_facture->Code_produit ?>" name="produit_" .<?= $p ?>></td>
                        </tr>
                    <?php $p++;
                    endforeach; ?>
                </tbody>
            </table>

        </div>
    </fieldset>

    <fieldset class="border p-2 bg-white">
        <legend class="w-auto"><small>Formulaire</small></legend>
        <div class="row">
            <?php $i = 1;
            foreach ($question as $question) : ?>
                <div class="col-md-12 question_reponse_containt mt-2" >
                    <div class="row">
                        <div class="form-group col-md-12 text-white bg-info ml-2 ">
                            <b class="question"><?= $question->question ?></b>
                        </div>
                        <div class="form-group col-md-12">
                            <label for=""><u>Choix</u></label>
                            <div class="row col-md-12 m-auto">
                                <?php
                                $array_option = explode(";", $question->option_containt);
                                foreach ($array_option as  $array_option) : ?>
                                    <div class="col-md-3 ml-2">
                                        <input type="radio" class="reponse_input" reponse="<?=$array_option?>" name="reponse_<?= $i ?>">&nbsp;<small><?= $array_option ?></small><br />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <label for="" class="col-md-12"><small><b><u>Note :</u></b> </small></label>
                        <div class="col-md-12">
                            <textarea name="" id="" cols="30" rows="2" class="note form-control"></textarea>
                        </div>
                    </div>
                </div>
            <?php $i++;
            endforeach; ?>
        </div>
    </fieldset>
    <div class="form-group w-100 text-right">
        <a href="#" class="btn btn-success btn-sm w-25" id="save_data">Enregsitre</a>
    </div>
</div>


<div class="modal fade" id="modal_history_client" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Show a second modal and hide this one with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>