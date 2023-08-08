<style>
 td{
   font-size:12px;
 }
</style>
    <div class="row " style="padding:0px 18px">
      <div class="col-md-12" style="background:#fff">
         
          
          <div class="etatLivraison">
            <?php foreach($dt as $data){ ?>
              <h1 style="font-size:14px;font-weight:bold;padding-top:20px">Date d'annulation : <span style="padding:5px 10px;color:#fff; background:#FF8800; border-radius:3px" class="pull-right"> <i class="fa fa-calendar"></i> &nbsp;&nbsp;&nbsp; <?php echo($data->date_de_livraison) ;  ?> </span></h1>
                  <table class="table dataTable table-striped table-advance table-hover" id="tableau" >
                    <thead>
                      <tr style="background:#ff4444">
                          <th style="color:white;width:200px">Client</th>
                          <th style="color:white">Photos</th>
                          <th style="color:white;width:200px">Produit</th>
                          <th style="color:white;width:150px">C.A </th>
                          <th style="color:white;width:200px">Page</th>
                          <th style="color:white;width:200px">Discussion</th>
                          <th style="color:white;width:250px">Action </th>
                       
                        </tr>
                    </thead> 
                      <tbody class="listLivraisonAnnullee">  
                          <?php $listeFacture = $this->Facture_model->getListeFactureAnnuleByDate($data->date_de_livraison) ; ?>
                          <?php foreach($listeFacture as $facture){ ?>
                          <tr> 
                              <td><a href="<?php 
                                      $client = $this->Facture_model->getClientByCodeClient2($facture->Code_client)  ;  
                                      $nom = null ; 
                                      $codeCl = null ; 
                                      foreach($client as $cl) 
                                      { 
                                          echo($cl->lien_facebook);  
                                          
                                      }

                              ?>" target = "_blank"><?php 
                                      $client = $this->Facture_model->getClientByCodeClient2($facture->Code_client)  ;  
                                      $nom = null ; 
                                      $codeCl = null ; 
                                      foreach($client as $cl) 
                                      { 
                                          echo($cl->Nom);  
                                          $codeCl = $cl->Code_client ;  
                                      }
                                  ?></a>
                              </td>
                              <td>
                                <img src="<?php echo(base_url("images/client/".$this->Facture_model->verifierPdp($codeCl).".jpg")) ?>" class="img-thumbnail client_lat"  style="border-radius:50%;width:50px;height:50px;margin:10px;" >
                              </td>
                              <td style="text-align:center">
                                  <?php 
                                      $produit = $this->Facture_model->getProduitByIdFacture($facture->Id)  ; 
                                      foreach($produit as $pr) 
                                      { 
                                          echo ($pr->Designation);  
                                      }
                                  ?>
                              </td>
                              <td style="text-align:right"><b><?php echo number_format($this->Facture_model->getChiffreDaffaireByIdFacture($facture->Id)) ; ?></b></td>
                              <td><?php echo($this->Facture_model->getNomPgeByNumeroPage($facture->Page)) ; ?></td>
                              <td style="text-align:center"> <a href="http://magesty.combo.fun/service_apres_vente/afficherDiscussionInNewFenetre/<?php echo($codeCl) ;  ?>" target="_blank">
                                      <button type="button" class="btn btn-primary " >consulter discu</button>
                              </a> </td>
                              <td style="text-align:center"><button type="button" class="btn btn-primary enCharge" id="<?php echo($facture->Id); ?>">prise en charge</button></td>
                                      
                          </tr>
                          <?php } ?>    
                      </tbody>
                  </table>
                  <hr style="border:solid 2px blue">
              <?php } ?>
            </div>
      </div>
    </div>
