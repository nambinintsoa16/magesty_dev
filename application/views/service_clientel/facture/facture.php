<!DOCTYPE html>
<html lang="en">
<head>
    <title>Facture</title>
</head>
<body style="font-size:12px;">
<?php foreach($facture as $value):?>
    <div style="border-top:solid 3px black;border-bottom:solid 3px black;margin:auto;height:30%;width:90%;margin-bottom:25px;">
        <div class="logo">
            <img src="images/facture/logo.PNG" style="padding:20px 0 0 0;">
            <div style="float:right;line-height:2px; padding:20px 80px 0 0;">
                <p>Numero vert: 032 32 036 69</p>
                <p>Date de livraison:&nbsp;<?=$value->date_de_livraison;?></p>
            </div>
        </div>
        <div style="height:30px;">
            <div style="width:50%;float:left">Projet Facebook</div>
            <div style="width:50%;float:right; text-align:center;">Frais de livraison:&nbsp;<?=$value->frais;?>&nbsp;Ar</div>
        </div>
        <div style="height:30px;">
            <div style="width:35%;float:left;">Prenom Commerciale:&nbsp;<?=$value->Nom;?></div>
            <div style="width:30%;float:right;">Localisation:&nbsp;<?=$value->Quartier;?></div>
            <div style="width:35%;float:right;">Matricule:&nbsp;<?=$value->Matricule;?></div>
        </div>
        <table border="1" style="border-collapse: collapse;width: 100%; text-align:center;">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Designation</th>
                    <th>PU(Ar)</th>
                    <th>Qtt</th>
                    <th>Total(Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $idFacture=$value->Id; 
                    $grandTotal=0;
                    $resultat_detail=$this->Facture_modele->returnDetailFacture($idFacture);
                    foreach($resultat_detail as $resultat_produit)
                    {?>
                <tr>
                    <td><?=$resultat_produit->Code_produit;?></td>
                    <td><?=$resultat_produit->Designation;?></td>
                    <td><?=$resultat_produit->Prix_detail;?></td>
                    <td><?=$resultat_produit->Quantite;?></td>
                    <td>
                        <?php 
                            $prix=$resultat_produit->Prix_detail;
                            $quantite=$resultat_produit->Quantite;
                            $total=$prix*$quantite;
                            $grandTotal+= $total;
                            echo $total;
                        ?>
                    </td>       
                </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align:right;">Total Achat</td>
                    <td style="font-weight:bolder;text-align:center;"><?=$grandTotal;?></td>
                </tr>
            </tfoot>
        </table>
        <div style="height:40px;padding-top:45px;">
            <div style="float:left; width:25%;">
                <div>Client:&nbsp;<?=$value->Compte_facebook;?></div>    
                <div>Signiature Client</div>
            </div>
            <div style="float:left; width:25%;">
                <div>FB:&nbsp;<?=$value->Compte_facebook;?></div>
                <div>Signature Responsable</div>
            </div>
            <div style="float:left; width:25%;">
                <div>Contact:&nbsp;<?=$value->contacts;?></div>
                <div>Signature Magasinier</div>
            </div>
            <div style="float:right;width:25%;padding-top:18px;">Prenom Livreur</div>
        </div>
    </div>
<?php endforeach;?>
</body>
</html>