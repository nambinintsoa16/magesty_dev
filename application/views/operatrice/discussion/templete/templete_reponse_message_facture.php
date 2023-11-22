<div style="background:#e6ee9c;padding:5px 5px;border-radius:10px;margin-bottom:5px;max-width:85%;color:#000; word-break: break-all!important;min-height:50px;margin-left: 90px;;text-align:left; font-size:12px!important"><div style="padding:5px 10px;white-space: break-spaces;">
       Raha fintinina izany ny commande nao dia : <br>
       <?php $total_a_payer = 0; foreach($detail as $detail):?>
	       	<span>
	           <span><b>Vokatra :</b> <?=substr($detail->Designation, 0, 60)?> </span><br/>
	           <span><b>Miisa :</b> <?=$detail->Quantite?> </span><br/>
	           <span><b>Vidiny :</b> <?=number_format($detail->Prix_detail)?>&nbsp;Ar </span><br/>
	       </span>
       <?php $total_a_payer+=($detail->Quantite * $detail->Prix_detail);  endforeach;?>
	<span>
       <br><span><b>Localité : <b/><?=$livraison->Localite?></span>
       <br><span><b>Quartier: <b/><?=$livraison->Quartier?>&nbsp;,&nbsp;<?=$livraison->Ville?></span>
       <br><span><b>Toerana : <b/><?=$livraison->lieu_de_livraison?></span>
       <br><span><b>Contact 1 : <b/><?=$livraison->contacts ?></span>
       <br><span><b>Contact 2 : <b/><?=$livraison->Contact_livraison ?></span>
       <br><span><b>Date de livraison : <b/><?=$livraison->date_de_livraison?></span>
       <br><span><b>Frais de livraison : <b/><?=number_format($livraison->frais)?>Ar</span>
       <br><span><b>Frais de Retrait :<b/><?=$livraison->frais_de_retrait?>Ar&nbsp;<?=$livraison->heure_deb_livre ." ". $livraison->heure_fi_livre?></span>
       	<br><span><b>Total à payer : </b> <?=number_format($total_a_payer)?> Ar</span>
       </b> <div class="modify"><button class="btn btn-dark disabled text-center "  id="' . trim($livraison->Id_facture) . '" style="margin-left:400px;color:#000;border-radius:10px "><?= $text[$livraison->Status]?></b></button></div></span>'
    <span>

    	<br><span><b><?=$livraison->Matricule_personnel?></span>
        <br><span><b><?=$livraison->Code_client?></span>
</div>