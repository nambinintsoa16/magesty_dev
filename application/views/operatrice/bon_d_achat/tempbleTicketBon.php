<div class="card" style="width: 25em;">
    <div class="card-header text-left">
        <div class="row">
            <div class="form-group col-md-8"> <h4>Bon d'achat </h4>Valide jusqu'au <b> <?= date("t") . "-" . date('m-Y') ?></div>
            <div class="form-group col-md-3 text-right pt-3"><b>Ref : <?=$ref?></b></div>
           
        </div>
        <hr class="w-100 bg-primary">
        <table>
            <tr>
                <th>Date du : <?= date('d-m-Y') ?></th>
            </tr>
            <tr>
                <th>Code client : <?= $infoClient->Code_client ?></th>
            </tr>
            <tr>
                <th>Compte facebook : <?= $infoClient->Compte_facebook ?></th>
            </tr>
        </table>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="m-1 w-100 text-center col-md-12 form-group">
                <h1 class="text-center w-100"><b><?= number_format($Valeur, 2, ',', ' ') ?> Ar</b> </h1>
                <?=$lettre?>
            </div>
            <hr class="w-100 bg-primary">

            <div class=" w-100 text-left col-md-12 m-1 text-center justify-content-center form-group">
                <img src="<?= base_url("images/QRCodeBon/$codeBon.png") ?>" class="rounded img-thumbnail mx-auto d-block" style="width:150px;">
            </div>
            <div class="col-md-12 form-group mt-1 text-center">
                La page <?=$page->nomPage?><br />
                vous remercie pour votre confiance.
            </div>
        </div>
    </div>
</div>
