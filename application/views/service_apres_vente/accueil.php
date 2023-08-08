<style>
 td{
   font-size:12px;
 }
</style>
    <div class="row " style="padding:0px 18px">
    <div class="col-md-12" style="background:#fff">
        <?php foreach($datelivre as $value){?>
        <div class="row">
          <div class="col-md-4">
             <div style="height:70px;background:#ff4444;border-radius:5px">
                  <span> CHIFFRE </span>
             </div>
          </div>
          <div class="col-md-4">
             <div style="height:70px;background:#33b5e5;border-radius:5px">

             </div>
          </div>
          <div class="col-md-4">
             <div style="height:70px;background:#ffbb33;border-radius:5px">

             </div>
          </div>
        </div>
        <h1 style="font-size:14px;font-weight:bold;padding-top:20px">Date d'annulation : <span style="padding:5px 10px;color:#fff; background:#FF8800; border-radius:3px" class="pull-right"> <i class="fa fa-calendar"></i> &nbsp;&nbsp;&nbsp; <?php echo $this->Service_apres_vente_model->dateToFrench($value->date_de_livraison, 'l j F Y')  ?></span></h1>
            <table class="table dataTable table-striped table-advance table-hover" id="tableau" >
              <thead>
                <tr style="background:#ff4444">
                    <th style="color:white;width:200px">Client</th>
                    <th style="color:white">Photos</th>
                    <th style="color:white;width:200px">Produit</th>
                    <th style="color:white;width:150px">Somme (Ar)</th>
                    <th style="color:white;width:200px">Lieu de livraison</th>
                    <th style="color:white;width:250px">Remarque </th>
                    <th class="text-center" style="color:white"> Detail </th>
                  </tr>
              </thead> 
                <tbody class="listLivraisonAnnullee">  
                <?php
                $sql = $this->db->query("SELECT facture.Id, facture.`Code_client`, facture.`Id_zone`, livraison.remarque_livreur,facture.`District`, facture.`Quartier` 
                 FROM `facture`, livraison WHERE  livraison.Id_facture like facture.Id_facture AND livraison.date_de_livraison like '$value->date_de_livraison' AND facture.Status like 'annule'");
                 $result = $sql->result();

                ?>
                <?php foreach($result as $result){?>
                    <tr>
                        <td><?php
                        $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `client` WHERE `Code_client` like '$result->Code_client'");
                        $clientresult = $sql->result();
                        if(empty($clientresult)){
                          $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `clientpo` WHERE `Code_client` like '$result->Code_client'");
                          $clientresult2 = $sql->result();
                          if(empty($clientresult2)){
                            $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `client_curieux` WHERE `Code_client` like '$result->Code_client'");
                            $clientresult3 = $sql->result();
                            foreach( $clientresult3 as  $clientresult3){
                              echo   $code =  $clientresult3->Nom ." ".  $clientresult3->Prenom;
                             }
                          }else{
                            foreach( $clientresult2 as  $clientresult2){
                              echo   $code =  $clientresult2->Nom ." ".  $clientresult2->Prenom;
                             }

                          }
                         
                        }else{
                          foreach( $clientresult as  $clientresult){
                          echo   $code =  $clientresult->Nom ." ".  $clientresult->Prenom;
                          }
                       
                        }

                       
                        
                        ?></td>
                        <td><img src="<?php if(file_exists(FCPATH.'images/client/'.$result->Code_client.'.jpg')) {echo base_url()?>images/client/<?php echo $result->Code_client;}else{
              echo base_url('images/client/default');
            }?>.jpg" width="50" height="50px" style="border-radius: 50%"></td>
                        <td><?php 
                          $sql = $this->db->query("SELECT produit.Designation , detailvente.Quantite, prix.Prix_detail FROM `prix`, produit, detailvente WHERE
                           detailvente.Id_prix=prix.Id AND prix.Code_produit like produit.Code_produit AND detailvente.Facture='$result->Id'");
                           $resulproduit = $sql->result();
                           foreach($resulproduit as $resulproduit){
                             echo $resulproduit->Designation. " : ".$resulproduit->Quantite ."<br>";
                           }
                        
                        ?></td>
                        <td class="text-right"><?php
                          $sql = $this->db->query("SELECT SUM(detailvente.Quantite*prix.Prix_detail) as ca
                           FROM `prix`, detailvente WHERE detailvente.Id_prix=prix.Id AND detailvente.Facture='$result->Id'");
                           $resultca = $sql->result();
                           foreach($resultca as $resultca){
                             echo number_format($resultca->ca);
                           }
                        ?></td>
                        <td><?= $result->District ." ". $result->Quartier ?></td>
                        <td><?= $result->remarque_livreur ?></td>
                        <td class="text-center"><buttom class="btn btn-primary btn-sm traiter"> <i class="fa fa-edit"></i> </buttom></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <hr style="border:solid 2px blue">
        <?php } ?>
    </div>
    </div>
