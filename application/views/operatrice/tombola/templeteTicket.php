<div class="card" style="width: 25em;">
    <div class="card-header text-left">
        <h4>Tombola 26 Juin 2022</h4>
        <table>
      
            <tr>
                <th>Date :<?= date('d-m-Y') ?></th>
                <th style="text-align:right;"><a href="<?=base_url("operatrice/genereticketPdf/$facture")?>"> <i class="flaticon-inbox"></i> </a></th>
            </tr>
            <tr>
                <th>Code client : <?= $codeclient ?></th>

            </tr>
            <tr>
                <th>Nom : <?= $Nom ?></th>

            </tr>

            <tr>
                <th>Prénom : <?= $Prenom ?></th>
            </tr>
            <tr>
                <th>Tél : <?= $Contact ?></th>
            </tr>
            <tr>
                <th>N°Facture : <?= $facture ?></th>
            </tr>

        </table>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="m-1 w-100 text-left col-md-12 form-group">
                <span><b>Détails de vos achats</b></span>
            </div>
            <div class="col-md-12 form-group">
                <table style="border: solid 1px  #000;">
                    <thead>
                        <tr style="border: solid 1px  #000; padding:2px;">
                            <td style="border: solid 1px  #000; padding:2px;">Code Produit</td>
                            <td style="border: solid 1px  #000; padding:2px;">Quantite</td>
                            <td style="border: solid 1px  #000; padding:2px;">Montant</td>
                            <td style="border: solid 1px  #000; padding:2px;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detailFacture as $detailFacture) : ?>
                            <tr style="border: solid 1px  #000;">
                                <td style="border: solid 1px  #000; padding:2px;"><?= $detailFacture->Code_produit ?></td>
                                <td style="border: solid 1px  #000; padding:2px;"><?= $detailFacture->Quantite ?></td>
                                <td style="border: solid 1px  #000; padding:2px;"><?= number_format($detailFacture->Prix_detail, 2, ',', ' ') ?></td>
                                <td style="border: solid 1px  #000; padding:2px;"><?= number_format($detailFacture->Quantite * $detailFacture->Prix_detail, 2, ',', ' ') ?>Ar</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12 form-group mt-1">
                La page <?=$pagefb->Nom_page?><br/>
                vous remercie pour votre confiance.
            </div>
            <hr class="w-100 bg-primary">
            <div class="col-md-12 form-group mt-1 text-left w-100">
                Ci-dessous vos numéros : 
            </div>
       
            <div class="w-100 text-left col-md-12 form-group">
                <table style="border: solid 1px  #000;" class="w-100 rounded">
                    <tr style="border: solid 1px  #000; padding:2px;">
                        <?php
                    $i = 0;
                    foreach ($detailTicket as $detailTicket) :
                        $i++;
                        $numero = $detailTicket->id_Tombola;
                        while (strlen($numero) < 5) {
                            $numero = "0" . $numero;
                        }
                    ?>
                      <td style="border: solid 1px  #000; padding:2px;text-align:center;"> <?= $numero ?></sapn><br /></td>
                    <?php endforeach ?>
                </tr>
                  
                  
               </table>    
            </div>
            <div class="form-group col-md-12 text-left w-100 form-group">
                  Arrêter à <?=$i?> tickets tombola
            </div>
           
            <div class=" w-100 text-left col-md-12 m-1 text-center justify-content-center form-group">
                <img src="<?= base_url("images/QRCode/$facture.png") ?>" class="rounded img-thumbnail mx-auto d-block" style="width:150px;">
            </div>
        </div>
    </div>
</div>