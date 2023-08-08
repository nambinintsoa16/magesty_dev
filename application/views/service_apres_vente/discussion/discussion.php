<style>
    .ui-menu-item{
      border-bottom: 1px solid gray;
      background:#e6ee9c;
      /*font-size:12px;*/
      padding:3px;
    }
    p {
 
  word-wrap: break-word;   
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
.champClient {
  word-wrap: break-word ; 
}
#hahaha
{
  word-wrap:break-word ; 
}
</style>

<div class="text-center col-md-3">
  <strong style="color:#000;font-size:11px;">ENREGISTREMENT DES DISCUSSIONS</strong>
</div>
<div class="text-center col-md-12">
  <strong style="color:#000;font-size:18px;">VOUS ETEZ SUR LA PAGE DE SERVICE APRES VENTE<span class="pageusers"></span></strong>
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
        <?php /*foreach($page as $page):*/ ?>
           
             <option  value="service apres vente" disabled>SERVICE APRES VENTE </option>
        <?php /*endforeach; */ ?> 
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
            <img class="img-thumbnail image_choise Client clientzoom" id = "cl" onclick=changeToClient() src="<?php echo(base_url("images/client/profil_vide.jpg")); ?>" alt="Client " style="border-radius:50%;width:60px;height:60px;margin:10px;" >
            </div>
            <div class="col-md-6" style="min-height: 40px" > 
            <img class="img-thumbnail image_choise user userzoom" id = "us" onclick=changeToUser() src="<?php echo(base_url("images/guest-user.jpg")) ?>" alt="user " style="border-radius:50%;width:60px;height:60px;margin:10px;object-fit:cover;" >
            </div>
      </div> 

       <div class="form-row">
            <textarea id="message" class="form-control clientMessage" name="message" rows="2" placeholder="colle la discussion ici ..." ></textarea>
            <input type="text" id="reponse_client"  class="form-control collapse typeahead">
            
            <input type="file" id="fileInput" class="btn btn-sm btn-secondary pull-right PJ" >
      </div>
      <hr>
      <button class="btn btn-sm btn-primary pull-right valide_content" id="validation" >Valider</button>
       </form>
    </div>  
</div>
       
<script>
 /*function changeClt(clicked_id) {
  
 var nomClient = document.getElementById("clientListe"+clicked_id) ; 
  var imgListeCl = document.getElementById(clicked_id) ; 
  document.getElementById("nmCl").inimahnerHTML = nomClient.innerHTML; 

  document.getElementById("clImg").src = imgListeCl.src;
  document.getElementById(clicked_id).style.borderColor = "blue" ;
  }
  function changeToClient() {
      var cl = document.getElementById("cl") ; 
      cl.style.borderColor = "blue" ; 
      document.getElementById("us").reset(); 
  }
  function changeToUser() {
      var us = document.getElementById("us") ; 
      us.style.borderColor = "blue" ; 
      document.getElementById("cl"); 
  }*/

</script>
    </div>
    <div class="col-md-9" style="height:500px;padding-left: 10px!important">
         <div class="row" style="padding-left: 10px;">
            <div class="col-md-12" style="padding: 0px 5px;">
              <div class="entetebadge" style="background:#33b5e5;border-radius: 5px;min-height: 50px;padding: 3px 0px;">

                <img class="img-thumbnail Client" id= "clImg" src="<?=base_url("images/client/default.jpg")?>" alt="client"  style="border-radius: 50%;width:50px;height:50px;margin-left:20px; ">&nbsp;<span class="code_client_ban" style="color:#000"></span> <span style="color: #000;"></span> <span class="nom_client_ban " style="color:#000;margin:auto"><p id="nomDuClient">NOM DU CLIENT</p></span> 
                
              </div>
            
            </div>
         </div>
         <div class="row">
         	
            <div class="col-md-9" style="height:500px;;padding-right: 5px!important">
            	
            	<!--<div style="background: #eceff1" style="padding-left:10px; padding-right:  20px; padding-top: 20px!important">-->
                  



              <div class="conten-message scrolling-wrapper mb-2" style="height:490px;overflow:scroll-Y;padding-top: 10px;background: #fff;
                border-radius: 5px;
                padding-left: 20px;padding-right: 20px;margin-top: 10px">


                        <div class = "row" style="margin-bottom:10px ; ">
                            <div class = "col-sm-12" style="word-wrap: break-word ; background:#EF5350; color: #fff ; padding:10px 5px ; border-radius:5px ; min-height:60px ; word-break: break-all ;  ">
                                
                               <h3 style="text-align: center;">veuillez selectionner un client</h3>
                                <span class="time-right"></span>
                            </div>
                        </div>
              </div> 

              <div class="row" style="padding-top: 10px; margin-right:30px ;"> 
                  <div class="form-group col-md-12 text-left btn-init">
                      
                            <!--<a href="#" class="btn btn-success conclure pull-right" style="margin-left: 10px">CONCLURE</a> -->
                            <a href="#" class="btn btn-danger termier pull-right" id= "terminerBut" style = "margin-left:10px;background-color:red;">TERMINER</a> 
                            <a href="#" class="btn btn-danger termier pull-right" id= "aSuivre"  style = "margin-left:10px;background-color:#FFFF00;color:black;">A SUIVRE</a> 
                            
                            <a class="btn btn-success conclure" id="conclusionModal">CONCLURE</a> 
                            <a href="#" class="btn btn-danger termier pull-right" id= "nouvelleDiscu" style = "margin-left:10px;background-color:green;">NOUVELLE DISCUSSION</a> 
                  </div>
                 <!-- <div class="form-group col-md-12 text-left collapse btn-disabled">
                          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" disabled>CONCLURE</a> 
                          <a href="#" class="btn btn-danger"  disabled >TERMINER</a> 
                        
                  </div>-->
              <!--</div>-->


            </div>
            </div>
            
            <div class="col-md-3" style="height:500px;padding-top: 10px;padding-left: 0px!important;padding-right: 0px">
            	<div style="padding-left:0px; padding-right:  5px; border-radius: 5px;">
              <input type="text" id="searchId" placeholder="recherche" class="form-control chercher">
              
            		  <div class="scrolling-wrapper mb-2 text-center" id="idListeClient" style="height:490px;overflow:scroll-Y;background: #fff;padding-top: 20px"> 
                  
                 <!-- <?php /* foreach ($dt as $data):?>    
                    
                    <div class="form-group">
										<span class="client_name collapse">
                    <?php /*echo($data['Id']) ; ?>    
										</span>
                    <img class="img-thumbnail client_lat" data-toggle="tooltip" id ="<?php /* echo($data['Code_client']);?>" title="rasoa" alt="rokoto"  src="<?php /*echo(base_url("images/client/".$this->Facture_model->verifierPdp($data["Code_client"]).".jpg")) ?>" style="border-radius:50%; width:40px;height:40px ; float: left;margin-left:7px;">
                    <p id="clientListe<?php echo($data['Code_client']);?>" style="padding-top: 8px "> <?php /* echo($this->Facture_model->getClientByCodeClient($data['Code_client']))->Code_client */;?> </p>  
                  
                    </div>
                   
                  <?php /*endforeach;*/?> -->
                  <?php
                      $query =$this->db->query("SELECT Code_client FROM facture where Etat_vente_annule like 'pris_en_charge' ");
                      $resultfact = $query->result();?>
                   
                      <?php 
                      foreach($resultfact as $value){?>
                 
                        <div style="padding:8px 5px" class = "classeClient" >

                      
                          <h2 class="text-left" style="margin-top:-10px; font-size:12px!important;margin-bottom:5px"> 
                            <span class="badge badge-pill " style="height:30px;width:30px; margin-bottom:5px;background:#fff"> 
                              <img src="<?php echo(base_url("images/client/".$this->Facture_model->verifierPdp($value->Code_client).".jpg")) ?>" class="img-thumbnail client_lat" id ="<?php  echo($value->Code_client);?>" style="height:30px;width:30px;cursor:pointer" >
                            </span>  <div class="nomclients" id="clientListe<?php  echo($value->Code_client);?>">&nbsp;&nbsp;&nbsp;&nbsp;
                            
                          <?php
                            $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `client` WHERE `Code_client` like '$value->Code_client'");
                            $clientresult = $sql->result();
                            if(empty($clientresult)){
                              $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `clientpo` WHERE `Code_client` like '$value->Code_client'");
                              $clientresult2 = $sql->result();
                              if(empty($clientresult2)){
                                $sql  = $this->db->query("SELECT `Nom`, `Prenom` FROM `client_curieux` WHERE `Code_client` like '$value->Code_client'");
                                $clientresult3 = $sql->result();
                                foreach( $clientresult3 as  $clientresult3){
                                  echo $code =  $clientresult3->Nom ." ".  $clientresult3->Prenom;
                                }
                              }else{
                                foreach( $clientresult2 as  $clientresult2){
                                  echo   $code =  $clientresult2->Nom ." ".  $clientresult2->Prenom;
                                }

                              }
                            
                            }else{
                              foreach( $clientresult as  $clientresult){
                              echo$code =  $clientresult->Nom ." ".  $clientresult->Prenom;
                              }
                          
                            }             
                          ?> 

                          </h2>
                        
                        </div> 
                        
                      <?php
                        } 
                      ?>
                      </div>

                      <?php  ?>
                  </ul>
                  
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
        

<div class="modal fade form_vente" id="exampleModaltoShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

