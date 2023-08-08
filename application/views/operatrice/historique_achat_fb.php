<div class="masquer p-2">
<fieldset class="borde w-100 m-0 p-2 shadow-sm bg-white rounded mb-2" style="border: #FF4081 solid 0.5px;">
    <div class="row contenue">
        <div class="col-md-4 ">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="<?=code_client_img_link($infoclient->Code_client)?>"
                        class="img-thumbnail avatar w-50 m-auto" style="height:150px">
                </div>
                <div class="col-md-12 m-2">
                    <div class="progress w-50 m-auto">
                        <?php 
                     switch ($infoclient->Etape) {
                         case 'etape1':
                              echo '<div class="progress-bar bg-danger" role="progressbar" style="width:25%" aria-valuenow="25" 
                            aria-valuemin="0" aria-valuemax="100">25%';
                             break;
                        case 'etape2':
                             echo '<div class="progress-bar bg-warning" role="progressbar" style="width:50%" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100">50%';
                             break;
                        case 'etape3':
                               echo '<div class="progress-bar bg-primary" role="progressbar" style="width:75%" aria-valuenow="75" 
                            aria-valuemin="0" aria-valuemax="100">75%';
                             break;          
                         case 'etape4':
                               echo '<div class="progress-bar bg-success" role="progressbar" style="width:100%" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100">100%';
                             break;
                         default:
                              echo '<div class="progress-bar bg-danger text-center" role="progressbar" style="width:0%" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"> <small class="text-center  w-100 text-danger">0% complete</small>
                            ';
                             break;
                     }
                    ?> </div>
                </div>
            </div>

            <div class="col-md-12 text-center m-1">
                <button type="button" class="btn btn-sm btn-warning majprofil w-50">Mise à jour du profil</button>
            </div>
            <div class="col-md-12 text-center m-1">
                <p class="text-center"><b>Liste promotions</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 description text-center justify-content-md-center">
        <div class="row text-center justify-content-md-center">
            <h4><a href="<?= $infoclient->lien_facebook ?>"
                    target="_blank"><b><?= $infoclient->Compte_facebook ?></b></a></h4>
        </div>
        <div class="row titre text-center col-sm-12">
            <div class="clientkoty col-md-8" id="clientkoty">
                <a href="#" class="codeclientkoty"><?= $infoclient->Code_client ?></a>
            </div>
            <div class="tana col-md-4">
                <?php if($localite=="ANTANANARIVO RENIVOHITRA" ) echo("ANTANANARIVO"); elseif($localite=="")echo("Vide"); elseif($localite=="PROVINCE") echo("PROVINCE"); 
                        elseif($localite=="ANTANANARIVO"){echo "ANTANANARIVO";} elseif($localite=="GRAND TANA"){echo "ANTANANARIVO";}?>
            </div>
        </div>
        <?php $gain = $this->Global_model->gettotalsmileskotyGlobale($infoclient->Code_client);
									foreach ($gain as $key) {
										$koty = $key->koty;
										$smiles = $key->smiles;
									}
							    ?>
        <?php $bonus = $this->Global_model->gettotalsmileskotyanneecourante($infoclient->Code_client,date('Y'));
                        foreach ($bonus as $data) {
                            $koty = $data->koty;
                            $smile = $data->smiles;
                            }
                    ?>

        <?php $monsmile = $this->Global_model->getsmileclienttrim($infoclient->Code_client);
                        foreach ($monsmile as $data) {
                            $mysmile = $data->smiles;
                            }
                    ?>
        <div class="row blue-silver">
            <div class="col-6 blues level"><?= $this->Global_model->getclientstatuttrimes($key->smiles)?>
            </div>
            <div class="col-6 silver"><?= $this->Global_model->getclientstatutAnnuel($key->smiles)?></div>
        </div>
        <div class="row koty-smile">
            <div class="col-6 koty"><i
                    class=""></i><?php if($kotydispo!=""){echo "<span class='kotyDispos'>".$kotydispo->Koty."</span>"; }else{echo 0;} ?>&nbsp Koty
            </div>
            <div class="col-6 smile"><i class=""></i><?=number_format($mysmile) ?> &nbsp Smile</div>
        </div>

        <hr>

        <!--   <?php $bon = $this->Global_model->gettotalsmileskotyanneepassee($infoclient->Code_client);
                                                    foreach ($bon as $valeur) {
                                                        $ancien = $valeur->koty;
                                                    }
                                                ?>-->
        <div class="liste">
            <p>Fonds disponibles sur bon de réduction Koty</p>
            <ul class="text-info">
                <li>A dépenser avant le : 30/06/2022 Total : <?= $ancien ?></li>
                <li>A dépenser avant le : 30/06/2023 Total :
                    <?php if($kotydispo!=""){echo $kotydispo->Koty; }else{echo 0;} ?></li>
            </ul>
            <div>
                <button type="button" class="btn btn-sm btn-primary prise_en_charge">Prise en
                    charge</button>
            </div>
        </div>
    </div>

    <!-- cote droite -->
    <div class="col-md-4 blocproduit ">
        <h4 class="text-center"> <b><u>Produits Tsena Koty</u></b></h4>
        <b class="lien">PROMOTIONS</b>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $i=0; foreach($promo as $key=>$promo):?>
                <?php if($i==0): ?>
                <div class="carousel-item active" style="height: 150px!important;">
                    <img class="d-block w-100 images img-thumbnail image-promo"
                        style="max-width: 100%;max-height: 100%;"
                        src="<?=base_url('assets/images/promotion/'.$promo->Pr_Code_Promo.'.jpg');?>"
                        alt="<?=$promo->Pr_Code_Promo?>" id="<?=$promo->Pr_Code_Promo?>">
                </div>
                <?php else:?>
                <div class=" carousel-item" style="height: 150px!important;">
                    <img class="d-block w-100 images img-thumbnail image-promo"
                        style="max-width: 100%;max-height: 100%;"
                        src="<?=base_url('assets/images/promotion/'.$promo->Pr_Code_Promo.'.jpg');?>"
                        alt="<?=$promo->Pr_Code_Promo?>" id="<?=$promo->Pr_Code_Promo?>">
                </div>
                <?php endif;?>
                <?php $i++; endforeach;?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
 
    </div>
    </fieldset>
    <div class="col-md-12 w-100">
        <div class="row">
            <div class="col-md-10" >
            <h2 class="text-left m-3"> <b>PRODUITS DISPONIBLES</b> </h2> 
                  <table class="table table-bordered table-striped tablePromo w-100">
                      <thead style="background-color: #FF4081; color:#fff" >
                             <tr>
                                 <th>Image</th>
                                 <th>Code produit</th>
                                 <th>Désignation</th>
                                 <th>Prix koty</th>
                             </tr>
                      </thead>
                      <tbody>
                     
                      </tbody>
                  </table>



            </div>
            <div class="col-md-2">
                <ul class="liste-prod list-group text-center border" >
                    <li class="list-group-item active text-center" aria-current="true"
                        style="background-color:#FF4081;"> <a href="#" class="lien text-white" data-toggle="modal"
                            data-target=".bd-example-modal-lg">SELECTIONS</a></li>
                    <?php foreach ($produit as $key => $val): ?>
                    <li class="list-group-item text-center  list-group-item-action"><a
                            href="<?=base_url('assets/images/promotion/'.$val->Code_produit.'.jpg');?>"
                            data-lightbox="roadtrip"><?= $val->Code_produit?> </a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg " id="modaltache" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Taches</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body modalkoty">
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                            <option>PROVINCE</option>
                            <option>ANTANANARIVO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                            <option hidden></option>

                        </select>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="sel1">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" id="sel1">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 ml-auto">
                                <div class="form-group">
                                    <select class="form-control" id="sel1">
                                        <option>ECRIRE</option>
                                        <option>REPONDRE</option>
                                        <option>---</option>
                                        <option>--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm valid w-25">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
</div>
<div class="discussion ">

</div>

<div class="modal fade" id="modalePromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">PROMOTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body formContaint">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        const kotyDispo = $('.kotyDispos').text();
        Table = $(".tablePromo").DataTable({
            processing: true,
            ajax: base_url + "Tsena_koty/produit_dispo_koty?koty="+kotyDispo,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            }
        });

 
    $('.validationTaches').on('click', function(e) {
        e.preventDefault();
        //$('.recherche').slideUp();
        var codeclient = $('.clientkoty').text();
        var pageUsers = $('.pageUsers option:selected').val();
        localStorage.setItem('pagetext', $('.pageUsers option:selected').text());
        localStorage.setItem('produitUsers', 'PRO021');
        localStorage.setItem('tache', $('.select1 option:selected').text());
        localStorage.setItem('codeclient', codeclient);
        localStorage.setItem('pageUsers', pageUsers);
        var koty = $('.koty').text();
        $('#modaltache').modal('toggle');
        $.post(base_url + 'Accueil/Viewdiscussion', {
            codeclient: codeclient
        }, function(data) {
            $('.discussion').empty().append(data);
            $('.masquer').addClass('collapse');
        });
        
    }); 
      });
</script>
<script src="<?=base_url('assets/js/Tsena_koty/discussion.js')?>"></script>