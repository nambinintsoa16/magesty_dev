<?php if(!empty($client)):?>
     <fieldset class="border p-2 w-100 "> <legend class="w-auto">Information</legend> 
     <div class="row pb-0 bg-white">
     <div class="col-xs-5 col-sm-4 text-center">
         <a href="#"  href="<?=code_client_img_link($client->Code_client)?>" data-lightbox="roadtrip">
             <span class="profile-picture"> 
                 <img alt="<?=$client->Code_client?>"  class="simple img-thumbnail mx-auto"
                     src="<?=code_client_img_link($client->Code_client)?>" 
                     style="height:160px;width:160px;">
             </span></a>

             <div class="space space-4"></div>
         </a>
     </div>
     <div class="col-xs-3 col-sm-3">
         <h4 class="blue">
             <span class="middle"><?=$client->Nom." ".$client->Prenom?></span><br />
             <span class="middle code_client"><?=$client->Code_client?></span>
             <span class="middle facture collapse"><?=$client->Id_facture?></span>
         </h4>
         <div class="profile-user-info p-0 m-0">
             <div class="profile-info-row  p-0 m-0">
                 <div class="profile-info-name" style="text-align: left;margin:0px;">
                     <i class="middle ace-icon fa fa-phone-square bigger-150 green"></i>
                     Contact:&nbsp;<b><?=$client->contacts?></b>
                 </div>
             </div>
             <div class="profile-info-row">
                 <div class="profile-info-name" style="text-align: left;">Localisation : <i
                         class="fa fa-map-marker light-orange bigger-110"></i>
                     <span><?=$client->Ville.",".$client->Quartier?></span>
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
     <div class="col-xs-3 col-sm-3 card">
         <div style="overflow:hidden;width: 500px;height: 200px;"><iframe width="350" height="400"
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
         </div><br/>
     </div>
     <div class="confirm">
     </div>
    
 
</fieldset>
<fieldset class="border p-2 w-100"> <legend class="w-auto">Détail</legend> 
 <table class="table tables-sm table-bordered " style="border-top:solid 1px #dbdbdb;border-bottom:solid 1px #dbdbdb; margin-top: 10px; font-size:9px;">
     <thead class="bg-success">
         <tr>
             <th style="text-align: center;color: #fff; border-left: 1px solid #fff;">
                 Produit</th>
             <th style="text-align: center;color: #fff; border-left: 1px solid #fff;">
                 Prix en Ariary</th>
             <th style="text-align: center;color: #fff; border-left: 1px solid #fff;">
                 Quantite</th>
             <th style="text-align: center;color: #fff; border-left: 1px solid #fff;">
                 Total en Ariary</th>
             <th style="text-align: center;color: #fff; border-left: 1px solid #fff;">
                 Aperçu</th>
         </tr>
     </thead>
     <tbody class="tbody">
         <?php $total=0; foreach($commande as $commande):?>
         <tr>
             <td style="text-align: center;"> <a href="<?=base_url('images/produit/'.$commande->Code_produit)?>.jpg"
                     data-lightbox="roadtrip"><?=$commande->Designation?></a> </td>
             <td style="text-align: center;"><?= number_format($commande->Prix_detail, 2, ',', ' ');?></td>
             <td style="text-align: center;"><?=$commande->Quantite?></td>
             <td style="text-align: center;" class="total">
                 <?php $total+=$commande->Prix_detail*$commande->Quantite; echo number_format($commande->Prix_detail*$commande->Quantite, 2, ',', ' ');?>
             </td>
             <td style="text-align: center;">
                 <?=strtoupper($commande->statut)?>
             </td>
         </tr>
         <?php endforeach;?>

         <tr>
             <td class="text-left" colspan="1"><span style="color: #000">Emetteur : </span> &nbsp;<span
                     class="p-2 bg-primary text-white rounded">&nbsp;<?=$client->Matricule_personnel?></span></td>
             <td colspan="5" class="text-center">Sous total en Ariary &nbsp;
                 <span class="p-2 bg-primary text-white rounded">
                     <?=number_format($total, 2, ',', ' ')?> Ariary
                 </span>
             </td>

         </tr>
     </tbody>
 </table>



 <div class="form-group confirmform">
     <div class="col-md-12">
         <div class="col-md-12 text-white">
        <!--     <a class="btn btn-success m-1 pull-right " data-toggle="modal" data-target="#myModallivre"> <span
                     style="background:green;height:100%;width:150px;"></span>Livrer </a>
             <a class="btn btn-warning m-1 pull-right " data-toggle="modal" data-target="#myModalrepporter"> <span
                     style="background:#2980b9;height:100%;width:150px;"></span>
                 Reporter</a>-->

             <a class="btn btn-danger m-1 pull-right " data-toggle="modal" data-target="#myModal"><span></span>
                 Annuler</a>
             <a href="fonction/class/dompdf/factureone.php?NumFact=<?=$client->Code_client?>" class="btn btn-primary m-1 pull-left ">
               <i class="fa fa-print"></i>  Imprimer facture</a>

         </div>
     </div>
 </div>
 </fieldset>
 </div>
 </div>
 </div>
 </div>
 </div> 
 </section>
 <div id="myModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success">
                 <h5 class="modal-title">Annuler la commande de <?=$client->Nom." ".$client->Prenom?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
             </div>
             <div class="modal-body">
                 <form action="" method="post">
                     <div class="form-group">
                         <label>Nom livreur</label>
                         <select name="Nomlivreur" class="form-control nomlivre">
                             <option value="Vonjy">Vonjy</option>
                             <option value="Donné">Donné</option>
                             <option value="Lucienne">Lucienne</option>
                             <option value="Patrick">Patrick</option>
                             <option value="Autre">Autre</option>
                             <option value="Sans livreur">Sans livreur</option>
                             <option value="Le client">Le client</option>
                             <option value="Le client">Nantenaina </option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="textarea">Code d'annulation</label>
                         <select class="form-control annula" name="id_annul">
                             <?php foreach($annulation as $annulation):?>
                             <option value="<?= $annulation->code_annul?>"><?= $annulation->contenu?></option>
                             <?php endforeach;?>
                         </select>

                     </div>
                     <div class="form-group">
                         <label for="textarea">Remarque</label>
                         <textarea name="" id="" cols="30" rows="5" class="form-control Remarqueannul"></textarea>
                     </div>

                 </form>
             </div>
             <div class="modal-footer">
                 <a data-dismiss="modal" href="fonction/fonctionAnnul.php?idfacture="
                     class="btn btn-success pull-right Annule">Enregistrer</a>
                 <button type="button" class="btn btn-danger" data-dismiss="modal"
                     style="margin-right: 10px">Fermer</button>
             </div>
         </div>

     </div>
 </div>

 <div id="myModalrepporter" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success">
                 <h5 class="modal-title">Repporté la commande de <?=$client->Nom." ".$client->Prenom?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>

             </div>
             <div class="modal-body">
                 <form action="" method="post">
                     <div class="form-group">
                         <label for="date">Date de repport</label>
                         <input type="date" name="" id="" class="form-control Repportdate">
                     </div>
                     <div class="form-group">
                         <label for="date">Heure de Repport</label>
                         <div class="row">
                             <div class="col-md-6">
                                 <input type="time" name="" id="" class="form-control Repportdebut">

                             </div>
                             <div class="col-md-1">
                                 <p class="text-center">à</p>
                             </div>
                             <div class="col-md-5">
                                 <input type="time" name="" id="" class="form-control Repportfin">

                             </div>

                         </div>

                     </div>
                     <div class="form-group">
                         <label for="textarea">Remarque</label>
                         <textarea name="" id="" cols="30" rows="5" class="form-control Remarquerapporer"></textarea>
                     </div>

                 </form>
             </div>
             <div class="modal-footer">

                 <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>&nbsp;&nbsp;
                 <a href="<?=base_url('service_clientel/repporter/')?>"
                     class="btn btn-success pull-right repporer">Enregistrer</a>
             </div>
         </div>

     </div>
 </div>
 <div id="myModallivre" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-success">
                 <h5 class="modal-title">Livrer la commande de <?=$client->Nom." ".$client->Prenom?></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
             </div>
             <div class="modal-body">
                 <form action="" method="post">
                     <div class="form-group">
                         <label>Nom livreur</label>
                         <input list="ice-cream-flavors" id="ice-cream-choice" class="form-control livreur"
                             name="Nomlivreur" />

                         <datalist id="ice-cream-flavors">
                             <option value="DONNE">
                             <option value="PIERROT">
                             <option value="LUCIENNE">
                             <option value="PRINCY">
                             <option value="PATRICK">
                             <option value="ONY">
                             <option value="ROJO">
                             <option value="STEPHANIE">
                             <option value="RIJA ANTONIO">
                             <option value="LE CLIENT">
                                 <?php foreach($liste_personel as $key=>$liste_personel):?>
                             <option value="<?=$liste_personel->Matricule?>">
                                 <?php endforeach;?>
                         </datalist>

                     </div>

                     <div class="form-group">
                         <label for="textarea">Remarque</label>
                         <textarea name="" id="" cols="30" rows="5" class="form-control Remarquelivre"></textarea>
                     </div>

                     <div class="form-group">
                         <label class=" control-label" style="text-align: left">Colis</label>
                         <div class="">
                             <input id="chkPassport" type="checkbox" name="colis" class="colis"
                                 style="width: 25px;height: 25px">
                         </div>

                         <div class="form-group" id="dvPassport" style="display: none; margin: 20px 0;padding-top: 0px">

                             <label class="Control-label" style="text-align: left">Modalité d'envoie
                             </label>
                             <div class="">
                                 <select name="" class="form-control type_colis" style="margin-bottom: 20px">
                                     <option></option>
                                     <option value="P A">Payé à l'arrivé (P.A)</option>
                                     <option value="P au D">Payé au depart</option>
                                 </select>
                             </div>
                             <label class="Control-label" style="text-align: left">Frais d'envoie
                             </label>
                             <div class="">
                                 <input type="text" name="frais-colis" class="form-control frais_colis">
                             </div>
                         </div>
                     </div>

                 </form>
             </div>
             <div class="modal-footer">

                 <a data-dismiss="modal" href="#" class="btn btn-success pull-right valider">valider</a>
                 <button style="margin-right: 20px" type="button" class="btn btn-danger"
                     data-dismiss="modal">Fermer</button>
             </div>
         </div>

     </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 <?php else : ?>
<div class="panel-body m-2">
    <fieldset class="w-100 border p-0 ">
        <div class="w-100 text-center">
            <p>Facture non trouvé</p>
        </div>

    </fieldset>
</div>
<?php endif ?>