<div class="modal fade form_vente" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enregistrement commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="collapse id_facture_collapse"></span>
      <fieldset class="border p-2" style="padding:5px; ">
   <legend  class="w-auto">Produit</legend>   
      <div class="form-group" style="margin-bottom: 20px!important">
      
      <div class="col-lg-3">
        
        <select class="form-control famille" name="famille" placeholder="Cathegory" >
        <?php foreach ($famille as $famille):?>    
                 <option value="<?=$famille->Id?>"><?=$famille->famille?></option>   
            <?php endforeach;?>
          </select> 

        </div>


        <div class="col-lg-3 ">
        
       <select name="codeproduit" class="form-control groupe">
        
        </select>

        </div>

        <div class="col-lg-3">
        <select name="" class="produitname form-control" id="recherche">
          
        </select>  
        
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

<br>
<div class="row">
	<div class="col-md-12" style="margin-top: 10px!important">
			 <div class="table-responsive" style="">
      	
            <table class="table table_commande">
              <thead>
                <tr>
                      <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px;">Code produit</th>
                      <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:400px;">Désignation</th>
                      <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:100px; ">Prix Unitaire</th>
                      <th style="border-left: solid #fff 1; text-align: center; background-color: #428bac;color: #fff; border-left: 1px solid #fff;width:80px;">Quantite</th>
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
                      <th colspan="2"style="text-align: right;">
                    
                     
                      </th>
                </tr>
          </tfoot>
         </table>
        </div> 
	</div>

</div>
     
      </fieldset> 
       

        <fieldset class="border p-2" style="padding-right: 20px; ">
    <legend  class="w-auto">Livraison</legend> 
    <span class="mask">    
    <div class="form-group " >
        <label for="contact" class="control-label col-lg-2">Contact<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control contact" id="contact" type="tel" required="" minlength="10" maxlength="10" name="contact"/>
          </div>
      </div>  
        </span>       
   <div class="form-group" style="margin-top: 5px">
      <label class="control-label col-lg-2" for="inputSuccess">Date de livrason<span class="required"> *</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
            <div class="row">
                <div class="col-lg-3">
                    <input type="date" class="form-control datelivre "/>
                </div>
                <div class="col-lg-3 collapse">
                    <a href="#" class="btn btn-succes" class="updatedate"><i class="fa fa-edit"></i></a>
                </div>
                <span class="mask">   
                 <label class="control-label col-lg-2" for="inputSuccess">Début<span class="required"> *</span></label>
                <div class="col-lg-2">
                    <input type="time" class="form-control Debut"  min="09:00" max="17:00"/>
                </div>
                 <label class="control-label col-lg-2" for="inputSuccess">Fin<span class="required"> *</span></label>
                <div class="col-lg-2">
                    <input type="time"  min="09:00" max="17:00" class="form-control Fin"/>
                </div>
                </span>  
            </div>
        </div>
   </div>
  <div >
 <span class="mask">   
      <div class="form-group " >
        <label for="cemail" class="control-label col-lg-2">Quartier<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control quartier" onKeyUp="javascript:this.value=this.value.toUpperCase();" id="quartier" type="text" name="quartier"  />
          </div>
  
      </div>
      
      <div class="form-group " style="margin-top: 5px">
        <label for="cemail" class="control-label col-lg-2">Ville<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control ville" id="ville" disabled type="text" name="livraison"  />
          </div>
      </div>
      <div class="form-group " style="margin-top: 5px">
        <label for="cemail" class="control-label col-lg-2">District<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control District"  id="District" disabled type="text" name="livraison"  />
          </div>
      </div>

        <div class="form-group" style="margin-top:5px">
          <label for="cemail" class="control-label col-lg-2">Zone<span class="required"> *</span>
          </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control zone"  id="zone" disabled type="text" name="zone"  />
          </div>
        </div>
         
        <div class="form-group" style="margin-top:5px">
          <label for="cemail" class="control-label col-lg-2">Axe<span class="required"> *</span>
          </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control axe"  id="axe" disabled type="text" name="axe"  />
          </div>
        </div>

        <div class="form-group" style="margin-top:5px">
          <label for="cemail" class="control-label col-lg-2">Type de livraison<span class="required"> *</span>
          </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control axe"  id="axe" disabled type="text" name="axe"  />
          </div>
        </div>

      <div class="form-group " style="margin-top: 5px">
        <label for="cname" class="control-label col-lg-2">Frais <span class="required">*</span></label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
              <input class="form-control frailivre" type="number" id="frailivre" name="frailivre" />
          </div>
        </div>

      <div class="form-group " style="margin-bottom: 5px!important">
        <label for="cemail" class="control-label col-lg-2">Lieu de livraison<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control lieulivre" id="lieulivre" type="text" required="" onKeyUp="javascript:this.value=this.value.toUpperCase();" name="lieulivre"/>
          </div>
      </div>
      <div class="form-group " style="margin-bottom: : 5px">
        <label for="cname" class="control-label col-lg-2">Remarque *<span class="required">*</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
            <textarea class="form-control comment" id="comment" required="" onKeyUp="javasrcipt:this.value=this.value.toUpperCase();" name="comment" ></textarea>
        </div>
      </div>

      <div class="form-group " style="margin-bottom: : 5px">
        <label for="cname" class="control-label col-lg-2">Autre contact livraison<span class="required">*</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
        <input class="form-control cotactlivre" id="cotactlivre" type="text" required="" maxlength="10" minlength="10" name="cotactlivre"/>
        </div>
      </div>
      </fieldset>
<fieldset class="border p-2" style="padding-right: 20px; ">
    <legend  class="w-auto">Vendeur secondaire</legend>    
       <div class="form-group " style="margin-bottom: 5px!important">
        <label for="cemail" class="control-label col-lg-2">Vendeur Secondaire<span class="required">*</span>
        </label>
          <div class="col-lg-2" style="margin-bottom: 10px!important">
            <select class="form-control form-sm nature_sc">
                 <option class="select-default " disabled  selected hidden>*</option>
                 <option>VP</option>
                 <option>VT </option>
                 <option>PR</option>
                 <option>COTN </option>
                 <option>NONE</option>
            </select>
          </div>

          <label for="cemail" class="control-label col-lg-2 text-center">Code  Vendeur <span class="required ">*</span>
        </label>
          <div class="col-lg-2" style="margin-bottom: 10px!important">
            <input class="form-control ress_sec_oplg" required="" id="ress_sec_oplg" maxlength="5" minlength="5"  type="text" name="ress_sec_oplg"/>
          </div>

          <label for="cemail" class="control-label col-lg-3 text-center">Matricule vendeur secondaire :  <span class="required result_mattr">*</span> <span class="matrfinal"></span> </label>
      </div>

</fieldset>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary enregistre_commande">Enregistrer</button>
      </div>
    </div>
  </div>
</div>
