<style>
    .ui-menu-item{
      border-bottom: 1px solid gray;
      background:#e6ee9c;
      /*font-size:12px;*/
      padding:3px;
    }

    .scrolling-wrapper {
      overflow-x: hidden;
      overflow-y: scroll;
      white-space: nowrap;
      display:block;
      height:480px;
      .card {
        display: inline-block;
      }
    }
     .panel-body{
       height:600px;
     }
     .ui-autocomplete{
       height:300px!important;
       overflow:scroll;
       width:600px!important;
     }
     .input-file {
      position:relative;
      overflow:hidden;
      margin-top:-45px;
      padding:0;
      display:block;
      max-width:100%;
      cursor:pointer;
    }
    .input-file i{
      font-size:30px;

    }
    .input-file .btn {
      white-space:nowrap;
      display:inline-block;
      margin-right:1em;
      vertical-align:top;
    }

    .input-file .material-icons {
      float:left;
      font-size:16px;
      line-height:inherit;
      margin-right:4px;
    }

    .input-file ins {
      white-space:nowrap;
      display: block;
      max-width:100%;
      overflow:hidden;
      text-overflow:ellipsis;
      font-size:12px;
    }

    .input-file:after {
      content:"";
      display:block; clear:both;
    }
    .input-file input {
      width:0.1px;
      height:0.1px;
      opacity:0;
      overflow:hidden;
      position:absolute;
      top:-100px;
      z-index:-1;
    }
    hr{
        color:#000;
    }
    .image_choise,.client_lat{
        cursor:pointer;

    }

    .jconfirm-title-c{

      text-align:center;
    }
    .loading {
        font-size: 36px;
        font-family: sans-serif;
    }

    .loading:after {
      display: inline-block;
      animation: dotty steps(1,end) 1s infinite;
      content: '';
    }
    .right_bull{
      margin:0;
      padding-bottom:30px!important;
      background-image:url("https://magesty.mg/images/bulle.png");
      background-repeat: no-repeat;
      background-size:65px;
      background-position: center;
      min-height: 30px;
    }

    .left_bull{
      margin:0;
      padding-bottom:30px!important;
      background-image:url("https://magesty.mg/images/bulle.png");
      background-repeat: no-repeat;
      background-size:65px;
      background-position: center;
       min-height: 30px;
    }
    @keyframes dotty {
      0%   { content: ''; }
      25%  { content: '.'; }
      50%  { content: '..'; }
      75%  { content: '...'; }
      100% { content: ''; }
    }
    ::-webkit-scrollbar {
      width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 7px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #33b5e5;
      border-radius: 7px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #00C851;
    }

    /* Track */
    ::scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 7px;
    }

    /* Handle */
    ::scrollbar-thumb {
      background: #33b5e5;
      border-radius: 7px;
    }

    /* Handle on hover */
    ::scrollbar-thumb:hover {
      background: #00C851;
    }
     p.a{
        word-break: break-all!important;
        padding-left: 10px;
        white-space:normal;
        padding-right: 10px
     }





     .container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

/* Darker chat container */
.darker {
  border-color: #ccc;
  background-color: #ddd;
}

/* Clear floats */
.container::after {
  content: "";
  clear: both;
  display: table;
}

/* Style images */
.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

/* Style the right image */
.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

/* Style time text */
.time-right {
  float: right;
  color: #aaa;
}

/* Style time text */
.time-left {
  float: left;
  color: #999;
}

</style>

<div class="text-center col-md-3">
  <strong style="color:#000;font-size:11px;">ENREGISTREMENT DES DISCUSSIONS</strong>
</div>
<div class="text-center col-md-12">
  <strong style="color:#000;font-size:18px;">VOUS ETEZ SUR LA PAGE <span class="pageusers"></span></strong>
</div>
<hr style="margin-bottom: 0px!important">
<div class="container">
  <div class="row"> 
    <div class="col-md-3 bg-red" style="padding-right: 0px!important">
    <div class="card pull-left text-center" style="border-right:solid #0099CC 2px;height:600px;background:#fff;padding:10px;">
  Ajouter  client <br/><a href="#" class="btn btn-primary new_client" style="border-radius:50%;"><i class="fa fa-plus"></i></a>   
    <div class="card-body" style="padding-top:50px;">  
      <form  id="prefetch">
         
      <div class="form-group" >
        <select  class="form-control page">
        <?php foreach($page as $page):?>
             <option  value="<?=$page->id?>"><?=$page->Nom_page?></option>
        <?php endforeach;?>
        </select>
       </div>  

       <div class="form-group" >
        <select  class="form-control type_discussion">
             <option value="message">Message</option>
             <option value="commentaire">Commentaire</option>
        </select>
       </div>  

        <div class="form-group" >
        <select  class="form-control  codeProduit">
           <?php foreach($produit_user as $key=>$produit_user):?>
             <option value="<?=$produit_user->CodePoduit?>"><?=$produit_user->CodePoduit?>|<?=$produit_user->Designation?></option>
           <?php endforeach;?>
        </select>
       </div>  
      
       <div class="form-row">
            <label for="" style="color:#0099CC;margin:30px;font-size:16px;"><strong>CHOIX DE L'INTERVENANT</strong></label><br/>
           
            <div class="col-md-6" style="min-height: 40px" > 
            <img class="img-thumbnail image_choise Client clientzoom" id = "cl" onclick=changeToClient() src="" alt="Client " style="border-radius:50%;width:60px;height:60px;margin:10px;">
            </div>
            <div class="col-md-6" style="min-height: 40px"> 
            <img class="img-thumbnail image_choise user userzoom" id = "us" onclick=changeToUser() src="<?=base_url("images/operatrice/PhotoUser/".$this->session->userdata('matricule'))?>.jpg" alt="user " style="border-radius:50%;width:60px;height:60px;margin:10px;object-fit:cover;">
            </div>
      </div> 

       <div class="form-row">
            <textarea id="message" class="form-control clientMessage" name="" rows="2" placeholder="colle la discussion ici ..."></textarea>
            <input type="text" id="reponse_client" class="form-control collapse typeahead">
            <input type="file" id="CLT" class="btn btn-sm btn-secondary pull-right PJ">
      </div>
      <hr>
      <button class="btn btn-sm btn-primary pull-right valide_content">Valider</button>
       </form>
    </div>  
</div>
       
<script>
function changeClt() {
  var nomClient = document.getElementById("clientListe") ; 
  document.getElementById("nmCl").innerHTML = nomClient.innerHTML;
  document.getElementById("discu").style.borderColor = "blue" ;
  }
  function changeToClient() {
      var cl = document.getElementById("cl") ; 
      cl.style.borderColor = "blue" ; 
      document.getElementById("us").style.borderColor = "grey" ; 
  }
  function changeToUser() {
      var us = document.getElementById("us") ; 
      us.style.borderColor = "blue" ; 
      document.getElementById("cl").style.borderColor = "grey" ; 
  }

</script>
    </div>
    <div class="col-md-9" style="height:500px;padding-left: 10px!important">
         <div class="row" style="padding-left: 10px;">
            <div class="col-md-12" style="padding: 0px 5px;">
              <div class="entetebadge" style="background:#33b5e5;border-radius: 5px;min-height: 50px;padding: 3px 0px;">

                <img class="img-thumbnail Client" id  = "cl" src="<?=base_url("images/profil_vide.jpg")?>" alt="client"  style="border-radius: 50%;width:50px;height:50px;margin-left:20px; ">&nbsp;<span class="code_client_ban" style="color:#000"></span> <span style="color: #000;">GDGDGDGD</span> <span class="nom_client_ban " style="color:#000;margin:auto"><p id="nmCl">NOM DU CLIENT</p></span> 
               
              </div>
            
            </div>
         </div>
         <div class="row">
         	
            <div class="col-md-10" style="height:500px;;padding-right: 5px!important">
            	
            	<div style="background: #eceff1" style="padding-left:10px; padding-right:  20px; padding-top: 20px!important">
                  



              <div class="conten-message scrolling-wrapper mb-2" style="height:490px;overflow:scroll-Y;padding-top: 10px;background: #fff;
                border-radius: 5px;
                padding-left: 20px;padding-right: 20px;margin-top: 10px"> 
                



                <div class="container">
                    <img src="/w3images/bandmember.jpg" alt="Avatar">
                    <p>Hello. How are you today?</p>
                    <span class="time-right">11:00</span>
                  </div>

                  <div class="container darker">
                    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                    <p>Hey! I'm fine. Thanks for asking!</p>
                    <span class="time-left">11:01</span>
                  </div>

                  <div class="container">
                    <img src="/w3images/bandmember.jpg" alt="Avatar">
                    <p>Sweet! So, what do you wanna do today?</p>
                    <span class="time-right">11:02</span>
                  </div>

                  <div class="container darker">
                    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                    <span class="time-left">11:05</span>
                  </div> 


                  <div class="container">
                    <img src="/w3images/bandmember.jpg" alt="Avatar">
                    <p>Hello. How are you today?</p>
                    <span class="time-right">11:00</span>
                  </div>

                  <div class="container darker">
                    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                    <p>Hey! I'm fine. Thanks for asking!</p>
                    <span class="time-left">11:01</span>
                  </div>

                  <div class="container">
                    <img src="/w3images/bandmember.jpg" alt="Avatar">
                    <p>Sweet! So, what do you wanna do today?</p>
                    <span class="time-right">11:02</span>
                  </div>

                  <div class="container darker">
                    <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right">
                    <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
                    <span class="time-left">11:05</span>
                  </div> 



              </div> 

              <div class="row" style="padding-top: 10px; margin-right:30px ;"> 
                  <div class="form-group col-md-12 text-left btn-init">
                      
                            <a href="#" class="btn btn-success conclure pull-right" style="margin-left: 10px">CONCLURE</a> 
                            <a href="#" class="btn btn-danger termier pull-right">TERMINER</a> 

                  </div>
                  <div class="form-group col-md-12 text-left collapse btn-disabled">
                          <a href="#" class="btn btn-success" disabled>CONCLURE</a> 
                          <a href="#" class="btn btn-danger"  disabled >TERMINER</a>  
                  </div>
              </div>


              	</div>
            </div>
            
            <div class="col-md-2" style="height:500px;padding-top: 10px;padding-left: 0px!important;padding-right: 0px">
            	<div style="padding-left:0px; padding-right:  5px; border-radius: 5px;">
              <input type="text" class="form-control chercher">
            		  <div class="scrolling-wrapper mb-2 text-center" style="height:490px;overflow:scroll-Y;background: #fff;padding-top: 20px"> 
                  
                
								 <div class="form-group">
										<span class="client_name collapse">
                     Rakoto 
										</span>
                    <img class="img-thumbnail client_lat" onclick="changeClt();" data-toggle="tooltip" title="rasoa" alt="rokoto" id="discu" src="<?=base_url("images/profil_vide.jpg")?>" style="border-radius:50%; width:40px;height:40px ; float: left;margin-left:7px;">
                    <p id="clientListe" style="padding-top: 8px ">client 1</p>  
                  </div>
                  

                  <div class="form-group">
										<span class="client_name collapse">
                     Rakoto 
										</span>
                    <img class="img-thumbnail client_lat"  data-toggle="tooltip" title="rasoa" alt="rokoto" id="discu" src="<?=base_url("images/profil_vide.jpg")?>" style="border-radius:50%;width:40px;height:40px ; float: left;margin-left:7px;">
                    <p style="padding-top: 8px ">client 2</p>  
                  </div>

                  <div class="form-group">
										<span class="client_name collapse">
                     Rakoto 
										</span>
                    <img class="img-thumbnail client_lat"  data-toggle="tooltip" title="rasoa" alt="rokoto" id="discu" src="<?=base_url("images/profil_vide.jpg")?>" style="border-radius:50%;width:40px;height:40px ; float: left;margin-left:7px;">
                    <p style="padding-top: 8px ">client 3</p>  
                  </div>
                </div>   
            	</div>
              
            </div>

              
            <div class="col-md-10">
         		<div style="margin-top: 10px;">
   						<button class="pull-right btn btn-primary btn-sm scrolldown" style="font-size:24px;margin-right: 5px;z-index: 9999;margin-top: -480px;padding: 6px 11px;font-size: 12px;line-height: 1.5;border-radius: 25px;border:solid 2px #33b5e5"> <i class="fa fa-angle-double-down"></i></button>
   					</div>
         	</div>
         </div>
        
         
    </div>
  </div>

</div>
        

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
            <input class="form-control contact" id="contact" type="text" name="contact"/>
          </div>
      </div>  
        </span>       
   <div class="form-group" style="margin-top: 5px">
      <label class="control-label col-lg-2" for="inputSuccess">Dade de livrason<span class="required"> *</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
            <div class="row">
                <div class="col-lg-3">
                    <input type="date" class="form-control datelivre "/>
                </div>
                <div class="col-lg-3 collapse">
                    <a href="#" class="btn btn-succes" class="updatedate"><i class="fa fa-edit"></i></a>
                </div>
                <span class="mask">   
                 <label class="control-label col-lg-2" for="inputSuccess">Debut<span class="required"> *</span></label>
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
            <input class="form-control quartier" id="quartier" type="text" name="quartier"  />
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



      <div class="form-group " style="margin-top: 5px">
                         <label for="cname" class="control-label col-lg-2">Frais <span class="required">*</span></label>
                      <div class="col-lg-10" style="margin-bottom: 10px!important">
                             <input class="form-control frailivre" id="frailivre" name="frailivre" />
                         </div>
                    </div>


      <div class="form-group " style="margin-bottom: 5px!important">
        <label for="cemail" class="control-label col-lg-2">Lieu de livraison<span class="required"> *</span>
        </label>
          <div class="col-lg-10" style="margin-bottom: 10px!important">
            <input class="form-control lieulivre" id="lieulivre" type="text" name="lieulivre"/>
          </div>
      </div>
      <div class="form-group " style="margin-bottom: : 5px">
        <label for="cname" class="control-label col-lg-2">Remarque sur lieu de livraison<span class="required">*</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
            <textarea class="form-control comment" id="comment" name="comment" ></textarea>
        </div>
      </div>

      <div class="form-group " style="margin-bottom: : 5px">
        <label for="cname" class="control-label col-lg-2">Matricule Vendeur secondaire<span class="">*</span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
         <input class="form-control matrvp" id="matrvp" type="text" name="matrvp" min="7" max="7"/>
        </div>
      </div>
</div>   
        </span>
</fieldset>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary enregistre_commande">Enregistre</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade plus_client" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
  <div class="row">
    <div class="card">
      <div class="card-body text-center" style="padding:10%;">
    
      <div class="form-group">
      <img class="img-thumbnail img-circle w-20" id="preview"  style="width:160px;height:160px; object-fit:cover" src="../img/Profil/OTO189.jpg" alt="client"><br>      
                <div class="upload-btn-wrapper" style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                       <button class="btn btn-primary" style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;">Parcourir</button>
                       <input  id="image" name="image" type="file" required  style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;"/>
                </div> 
        </div> 
        <div class="form-group">
          <input id="liensurfb" class="form-control" type="text" name="" placeholder="LIEN Facebook">
        </div>
        <div class="form-group">
          <input id="identifient" class="form-control" type="text" name=""  placeholder="ID Facebook">
        </div> 
        <div class="row">
        <div class="form-group col-md-6">
          <input id="identifient" class="form-control coach" type="text" name=""  placeholder="Coach">
        </div>
        <div class="form-group col-md-6">
          <input id="identifient" class="form-control commerciale" type="text" name=""  placeholder="Commerciale">
        </div>
     </div>  
     <div class="form-group">
           Ajouter un nouveau client &nbsp; <a href="#" class="btn btn-default" style='border-radius:50%;'><i class="fa fa-plus bg-gray"></i></a>      
        </div>  

  </div>
</div> 
      </div>
      <div class="modal-footer">
           <a href="#" class="btn btn-primary pull-right collapse next">Suivant<span class="arrow_carrot-right"></span></a>
           <a href="#" class="btn btn-success pull-right save">Enregistre<span class="arrow_carrot-right"></span></a>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade localisations" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleM" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleM">Ajout client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body localisation_content">
  
      </div>
      <div class="modal-footer">
           <a href="#" class="btn btn-primary pull-right collapse next">Suivant<span class="arrow_carrot-right"></span></a>
           <a href="#" class="btn btn-success pull-right save">Enregistre<span class="arrow_carrot-right"></span></a>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
  </div>
</div>




        </div>
