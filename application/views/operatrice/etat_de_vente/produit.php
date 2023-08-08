<div class="container">
<div class="row justify-content-between">   
    <div class="card ml-5 test" style="width:18%;">
    <a href="#" id="all" class="nav-link"  data-toggle="modal" data-target="#LV">    
        <div class="row" >
            <div class="col-md-4" style="background:#03a5cc;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
               <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
             Commandés <br>
             Nombre: <?= $all->qt?><br>
            </div>
        </div>
        </a>
    </div>
    <div class="card" style="width:18%;">
    <a href="#" id="livre"  class="nav-link"  data-toggle="modal" data-target="#LV"> 
    <div class="row">
            <div class="col-md-4" style="background:#00a65a;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
                Livrés <br>
               Nombre: <?= $livre->qt?>
                         
            </div>
        </div>
        </a>
    </div>
 
    <div class="card" style="width:18%;">
    <a href="#"  class="nav-link" id="annule"  data-toggle="modal" data-target="#LV">    
    <div class="row"  >
            <div class="col-md-4" style="background:#e30832;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:25px;padding-left:0px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" >
              Non livrés<br>
             Nombre: <?= $annule->qt?> 
            </div>
        </div>
        </a>
    </div>

    <div class="card" style="width:18%;">
    <a href="#"  class="nav-link" id="confirmer"  data-toggle="modal" data-target="#LV">  
    <div class="row"  >
            <div class="col-md-4" style="background:#3578E5;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;border-top-left-radius: 5px;border-top-left-radius: 5px">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:29px;padding-left:5px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;border-top-right-radius: 5px;border-bottom-right-radius: 5px">
               Confirmés<br/>
                Nombre: <?= $confirme->qt?>

            </div>
        </div>
        </a>
    </div> 


<div class="card" style="width:18%;">
    <a href="#"  class="nav-link" id="en_attente"  data-toggle="modal" data-target="#LV">  
    <div class="row">
            <div class="col-md-4" style="background:orange;height:80px;border-top-left-radius: 5px;border-bottom-left-radius: 5px">
            <i class="fa fa-cubes" style="color:white;font-size:22px;padding-top:29px;padding-left:5px"></i>
            </div>
            <div class="col-md-8" style="background:white;height:80px;padding-top:10px;color:black;font-size: 12px!important;border-top-right-radius: 5px;border-bottom-right-radius: 5px">
              A confirmer<br/>
                Nombre :<?= $en_attente->qt?>
            </div>
        </div>
    </div> 
    </a>
    </div> 

  
<div class="row bg-white">     
   <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
        <a href="#"  data-toggle="modal" data-target="#defaultModal" id="deoparfum" style="text-decoration:none;">   
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/deo.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">DEO & PARFUM</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?= $deoParfum["all"]->qt?></b> </b>
                      <br>Livrés : <b class="pull-right"> <?= $deoParfum["livre"]->qt?></b>
                      <br>Annulés : <b class="pull-right"><?= $deoParfum["annule"]->qt?></b>
                      <br>Confirmer : <b class="pull-right"><?= $deoParfum["confirme"]->qt?></b>
                      <br>A confirmer :<b class="pull-right"><?= $deoParfum["en_attente"]->qt?></b>

                  </p>
            </div>
          </div>
        </a>
    </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
        <a href="#" id="hygienCor"  data-toggle="modal" data-target="#defaultModal" style="text-decoration:none;">    
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/hygienne.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE CORPORELLE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?= $hygienCor["all"]->qt?></b> </b>
                      <br>Livrés : <b class="pull-right"> <?= $hygienCor["livre"]->qt?></b>
                      <br>Annulés : <b class="pull-right"><?= $hygienCor["annule"]->qt?></b>
                      <br>Confirmer : <b class="pull-right"><?= $hygienCor["confirme"]->qt?></b>
                      <br>A confirmer :<b class="pull-right"><?= $hygienCor["en_attente"]->qt?></b>

                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" id="soinCap" data-target="#defaultModal" style="text-decoration:none;">     
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/capillaire.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN CAPILLAIRE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés : <b class="pull-right"><?= $soinsCap["all"]->qt?></b>
                      <br>Livrés : <b class="pull-right"><?= $soinsCap["livre"]->qt?></b>
                      <br>Annulés: <b class="pull-right"> <?= $soinsCap["annule"]->qt?></b>
                      <br>Confirmés :<b class="pull-right">  <?= $soinsCap["confirme"]->qt?></b>
                      <br>A confirmer : <b class="pull-right"><?= $soinsCap["en_attente"]->qt?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" id="hygienBuco" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/buco.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">HYGIENE BUCO-DENTAIRE </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?= $hygienBuco["all"]->qt?></b>
                      <br>Livrés:   <b class="pull-right"><?= $hygienBuco["livre"]->qt?></b>
                      <br>Annulés :  <b class="pull-right"><?= $hygienBuco["annule"]->qt?></b>
                      <br>Confirmés : <b class="pull-right"> <?= $hygienBuco["confirme"]->qt?></b>
                      <br>A confirmer : <b class="pull-right"> <?= $hygienBuco["en_attente"]->qt?></b>
                  </p>
            </div>
          </div>
        </a>
        </div> 
    </div>
    <div class="row bg-white">
        <div class="col-md-3 content" style="height:180px;padding-right:35px;padding-left:15px">
         <a href="#"  data-toggle="modal" id="beaute" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px #fff;background-image:url('<?=base_url("assets/img/beaute.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BEAUTE 
                     </h3>

                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      Commandés :  <b class="pull-right"><?= $beaute["all"]->qt?></b>
                      <br>Livrés :    <b class="pull-right"><?= $beaute["livre"]->qt?></b>
                      <br>Annulés :  <b class="pull-right"><?= $beaute["annule"]->qt?></b>
                      <br>Confirmés :  <b class="pull-right"><?= $beaute["confirme"]->qt?></b>
                      <br>A confirmer : <b class="pull-right"><?= $beaute["en_attente"]->qt; ?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
           <a href="#"  data-toggle="modal" id="lessive" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/lessive.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">LESSIVE </h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?= $lessive["all"]->qt?></b>
                      <br>Livrés :  <b class="pull-right"><?= $lessive["livre"]->qt?></b>
                      <br>Annulés : <b class="pull-right"><?= $lessive["annule"]->qt?></b>
                      <br>Confirmés : <b class="pull-right"><?= $lessive["confirme"]->qt?></b>
                      <br>A confirmer : <b class="pull-right"><?= $lessive["en_attente"]->qt?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
         <a href="#"  data-toggle="modal" id="soinsVis" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/visage.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">SOIN VISAGE</h3>
                  </p>
                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?= $soinsVis["all"]->qt?></b>
                      <br>Livrés :   <b class="pull-right"> <?= $soinsVis["livre"]->qt?></b>
                      <br>Annulés : <b class="pull-right"><?= $soinsVis["annule"]->qt?></b>
                      <br>Confirmés : <b class="pull-right"><?= $soinsVis["confirme"]->qt?></b>
                      <br>A confirmer : <b class="pull-right"><?= $soinsVis["en_attente"]->qt?></b>
                  </p>
            </div>
          </div>
        </a>
        </div>
        <div class="col-md-3 content" style="height:180px;padding-left:15px;padding-right:35px;">
          <a href="#"  data-toggle="modal" id="boisson" data-target="#defaultModal" style="text-decoration:none;">  
          <div class="row" style="border:solid 5px white;background-image:url('<?=base_url("assets/img/boisson.png")?>');height:200px;background-size:cover;overflow:hidden">
            <div class="col-md-5">
               
            </div>

            <div class="col-md-7" style="background:white;opacity:0.7;height:200px;overflow:hidden">
                <p style="z-index:2;color:white">
                     <h3 style="font-size:14px;text-align:center;color:black;font-weight:bold">BOISSON </h3>
                  </p>

                  <p style="text-align:left;z-index:2;color:black">
                      <br>Commandés : <b class="pull-right"><?= $boisson["all"]->qt?></b>
                      <br>Livrés :   <b class="pull-right"> <?= $boisson["livre"]->qt?></b>
                      <br>Annulés :  <b class="pull-right"><?= $boisson["annule"]->qt?></b>
                      <br>Confirmés : <b class="pull-right"> <?= $boisson["confirme"]->qt?></b>
                    <br>A Confirmer : <b class="pull-right"> <?= $boisson["en_attente"]->qt?></b>

                  </p>
            </div>
          </div>
        </div>  
      </a>
    </div>  
    </div>


        <div class="modal fade" id="defaultModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                       
                        <h4 class="modal-title" id="titleToggle">Liste des Produits de la famille DEO ET PARFUN<b class="alert-info">
                               </b></h4>
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="testAppend2">
                        <div class="modal-body vente">
                            <section class="listeproduitdeopar">
                              
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>

        <div class="modal fade" id="LV" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        
                        <h4 class="modal-title" id="toggle-title">Liste des Produits de la famille BOISSON<b class="alert-info">
                               </b></h4>
                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="testAppend">
                        <div class="modal-body vente">
                            <section class="LV">
                                
                            </section>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
       </div>
