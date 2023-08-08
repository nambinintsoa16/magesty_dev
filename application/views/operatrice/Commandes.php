<div class="container col-md-12" style="background-color:white;padding:2%;">
<span class="collapse users"><?=$this->session->userdata('matricule')?></span>
  <div id="vente" class="tab-pane" style="margin-left:0px">   
    <div class="form">
      <form class="form-validate form-horizontal" id="feedback_form" >
        <fieldset class="border p-2">
          <legend  class="w-auto">Client <a href="#" class="btn btn-primary pull-right new_client m-3"><i class="fa fa-plus">&nbsp;Nouveau client</i></a></legend> 
          <div class="form-group">
            <label class="control-label col-lg-2" for="inputSuccess" style="margin-top:16px; ">Nom du client <span class="required">*</span></label><br>
            <div class="col-lg-10">
              <div class="row">
                <div class="col-lg-7">
                  <input type="text" class="form-control cherche client select-client" onKeyUp="javascript:this.value=this.value.toUpperCase();" id="client" style="width: 350px;">
                </div>
                  
                <div class="col-lg-7">
                  <label class="control-label contact"  style="margin-top:7px;border: solid 1px; width: 350px;background: white;border-radius: 5px;text-align: center;padding: 3px;"><span class="required">---</span></label>
                </div>

                <div class="col-lg-2 collapse danger" style="text-align: right;">
                  <div class="img-thumbnail" style="width: 150px;height: 150px;text-align:center;padding: auto auto;margin-top: -50px;">
                    <img src="<?=base_url('images/danger.png')?>">
                  </div>
                  <span class="idclient"></span>
                </div>

                <div class="col-lg-2 collapse ok" style="text-align: right;">
                  <div class="img-thumbnail" style="width: 150px;height: 150px;text-align:center;padding: auto auto;margin-top: -50px;">
                    <img src="<?=base_url('images/ok.png')?>">
                  </div>
                  <span class="idclient"></span>
                </div>

                <div class="col-lg-2 " style="text-align: right;margin-top: -50px;">
                  <div class="image img-thumbnail" style="width: 150px;height: 150px;text-align:center;padding: auto auto;">
                    <h5 style="margin-top:45%; ">Photo client</h5> 
                  </div>
                  <span class="idclient"></span>
                </div>

                <div class="col-lg-3" style="position: absolute;margin-top: 80px;margin-left: -135px;">
                  <div>
                    <label class="control-label col-lg-2" for="inputSuccess">Statut
                      <div class="progress" style="margin-top: -24px;margin-left:120px;width: 350px; position: absolute;">
                        <div class="progress-bar progress-bar-primary" role="progressbar" style="width:40%">Blue</div>
                        <div class="progress-bar progress-bar" role="progressbar" style="width:30%;background-color: orange;">Orange</div>
                        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">Gold</div>
                      </div>
                    </label>
                  </div>
                  <span class="idclient"></span>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
        <fieldset class="border p-2">
          <legend  class="w-auto">Produit</legend>   
            <div class="form-group">
              <div class="col-lg-3">
                <select class="form-control famille" name="famille" placeholder="Cathegory" >
                  <?php foreach ($famille as $famille):?>    
                    <option value="<?=$famille->Id?>"><?=$famille->famille?></option>   
                  <?php endforeach;?>
                </select> 
              </div>

              <div class="col-lg-3 ">
                <select name="codeproduit" class="form-control groupe"></select>
              </div>

              <div class="col-lg-3">
                <select name="" class="produitname form-control" id="recherche"></select>
              </div>

              <div class="col-lg-2">
                <select class="form-control zone" name="zone" placeholder="Prix appliquer" >
                  <?php foreach($mission as $zone):?>
                    <option value="<?=$zone->Id?>"><?=$zone->Zone?></option>
                  <?php endforeach;?>
                </select> 
              </div>

              <div class="col-lg-1">
                <button class="btn btn-primary validproduit" style="display: inline;"><i class="fa fa-plus"></i></button>
              </div>
            </div>         
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <header class="panel-heading">Détails produits </header>
                    <section class="panel">
                      <div class="table-responsive">
                        <table class="table table_commande">
                          <thead>
                            <tr>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px;">Code produit</th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:400px;">Désignation</th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px; ">Prix Unitaire</th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:80px;">Quantité</th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px">Total en Ar </th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px;">Aperçu</th>
                              <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:60px"></th>
                            </tr>   
                          </thead>
                          <tbody class="tbody">  
                          </tbody>
                          <tfoot>                                  
                            <th>
                              <td></td>
                              <td></td>
                            </th>
                            <th>
                              <label>Sous total :<span class="sous"></span></label>
                            </th>
                            <th>
                              <label class="total">00 MGA</label>
                            </th>
                            <th colspan="2"style="text-align: right;"></th>
                          </tfoot>
                        </table>
                      </div>
                    </section>
                </div>
              </div>
            </div>
          </fieldset> 
          <fieldset class="border p-2" style="padding-right: 20px;">
            <legend  class="w-auto">Livraison</legend> 
            <div class="form-group " >
              <label for="contact" class="control-label col-lg-2" >Contact<span class="required"> *</span></label>
              <div class="col-lg-10" style="margin-bottom: 10px!important">
                <input class="form-control contact" maxlength="10" minlength="10" id="contact" type="text" name="contact"/>
              </div>
            </div>      
            <div class="form-group" style="margin-top: 5px">
              <label class="control-label col-lg-2" for="inputSuccess">Date de livrason<span class="required"> *</span></label>
              <div class="col-lg-10" style="margin-bottom: 10px!important">
                <div class="row">
                  <div class="col-lg-3">
                    <input type="date" class="form-control datelivre"/>
                  </div>
                  <label class="control-label col-lg-2" for="inputSuccess">Début<span class="required"> *</span></label>
                  <div class="col-lg-2">
                    <input type="time" class="form-control Debut"  min="09:00" max="17:00"/>
                  </div>
                  <label class="control-label col-lg-2" for="inputSuccess">Fin<span class="required"> *</span></label>
                  <div class="col-lg-2">
                    <input type="time"  min="09:00" max="17:00" class="form-control Fin"/>
                  </div>
                </div>
              </div>
            </div>
            <div >
              <div class="form-group " >
                <label for="cemail" class="control-label col-lg-2">Quartier<span class="required"> *</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <input class="form-control quartier" onKeyUp="javascript:this.value=this.value.toUpperCase();" id="quartier" type="text" name="quartier"/>
                </div>
              </div>
              <div class="form-group " style="margin-top: 5px">
                <label for="cemail" class="control-label col-lg-2">Ville<span class="required"> *</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <input class="form-control ville" id="ville" disabled type="text" name="livraison"  />
                </div>
              </div>
              <div class="form-group " style="margin-top: 5px">
                <label for="cemail" class="control-label col-lg-2">District<span class="required"> *</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <input class="form-control District"  id="District" disabled type="text" name="livraison"  />
                </div>
              </div>
              <div class="form-group " style="margin-top: 5px">
                <label for="cname" class="control-label col-lg-2">Frais <span class="required">*</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <input class="form-control frailivre" id="frailivre" type="number" name="frailivre" />
                </div>
              </div>
              <div class="form-group " style="margin-bottom: 5px!important">
                <label for="cemail" class="control-label col-lg-2">Lieu de livraison<span class="required"> *</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <input class="form-control lieulivre" id="lieulivre" type="text" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="lieulivre"/>
                </div>
              </div>
              <div class="form-group " style="margin-bottom: : 5px">
                <label for="cname" class="control-label col-lg-2">Remarque<span class="required">*</span></label>
                <div class="col-lg-10" style="margin-bottom: 10px!important">
                  <textarea class="form-control comment" id="comment" name="comment" ></textarea>
                </div>
              </div>
            </div>    
          </fieldset>  
          <button type="submit" class="btn btn-success pull-right enregistre_commande" style="margin-top:30px;margin-right:20px">Valider la commande</button>
      </form>   
    </div>
  </div>
</div>
        
        
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouveau client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form card" >
          <form class="form-validate form-horizontal " id="register_form" method="post"  enctype="multipart/form-data">
            <div class="form-group text-center col-md-12">
              <img class="img-thumbnail img-circle w-20" id="preview"  style="width:100px;height:100px; object-fit:cover;text-align:center;" src="#" alt="PHOTO"><br>
              <div class="upload-btn-wrapper" style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                <button class="btn btn-primary" style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;">Parcourir</button>
                <input  id="image" name="image" type="file" required  style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;"/>
              </div> 
            </div>
            <div class="form-group">
              <label for="liensurfb" class="control-label col-lg-2">Type de client<span class="required">*</span></label>
              <div class="col-lg-5">
                <input class=" form-control" id="typeClient" name="typeClient" disabled type="text" required  value="Prospect"/>
              </div>
              <div class="col-lg-5">
                <input class=" form-control" id="Provenance" name="Provenance" disabled type="text" required  value="----"/>
              </div>
            </div>
            <div class="form-group">
              <label for="liensurfb" class="control-label col-lg-2">Lien sur Facebook<span class="required">*</span></label>
              <div class="col-lg-10">
                <input class=" form-control" id="liensurfb" name="liensurfb" type="text" required />
              </div>
            </div>
            <div class="form-group"> 
              <label for="identifient" class="control-label col-lg-2">Identifiant sur Facebook<span class="required">*</span></label>
              <div class="col-lg-10">
                <input class=" form-control" id="identifient" name="identifient" type="text" required />
              </div>
            </div>
            <div class="form-group ">
              <label for="Nom" class="control-label col-lg-2">Nom et Prénom <span class="required">*</span></label>
              <div class="col-lg-10">
                <input class=" form-control" id="Nom" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="Nom" type="text" required />
              </div>
            </div>  
            <div class="form">
              <div class="form-group cont-contact">
                <label for="Contact" class="control-label col-lg-2">Contact<span class="required">*</span></label>
                <div class="col-lg-1"> 
                  <button class="btn btn-primary Contact"><i class="fa fa-plus"></i></button> 
                </div>
                <div class="col-lg-3 Contactdiv">
                  <input class="form-control " id="Contact" name="Contact" type="tel" maxlength="10" minlength="10" required autofocus/>
                </div>
              </div>
              <div class="form-group ">
                <label for="idvp" class="control-label col-lg-2">Commercial</label>
                <div class="form-group  col-lg-4">
                  <input class=" form-control" id="idvp" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="idvp" type="text"/>
                </div>
                <label for="coach" class="control-label col-lg-2">Coach<span class="required">*</span></label>
                <div class="form-group col-lg-4">
                  <input class=" form-control" id="coach" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="coach" type="text" required />
                </div>
              </div>       
              <div>
                <table class="TableListe table-bordered table table-sm">
                  <thead>
                    <tr>
                      <th class="text-center">Code client</th>
                      <th class="text-center">Personnel</th>
                      <th class="text-center">Nom</th>
                      <th class="text-center">Ville</th>
                      <th class="text-center">Contact</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody class="tbody">
                          
                  </tbody>
                </table>
              </div> 
            </div>
          </form>   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary sauve_client">Enregistrer</button>
      </div>
    </div>
  </div>
</div>

