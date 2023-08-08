<div class="row">
<form class="form-validate form-horizontal " id="register_form" method="post" action="fonction/fonctionAjoutClient.php" enctype="multipart/form-data">
                  
                  <div class="form-group text-center col-md-12">
                          <img class="img-thumbnail img-circle w-20" id="preview"  style="width:100px;height:100px; object-fit:cover" src="../img/Profil/OTO189.jpg" alt="client"><br>
                    
                  <div class="upload-btn-wrapper" style=" position: relative;overflow: hidden;display: inline-block; margin-top:10px;">
                     <button class="btn btn-primary" style="padding: 8px 20px;border-radius: 5px;font-size: 11px;font-weight: bold;">Parcourir</button>
                     <input  id="image" name="image" type="file" required  style="font-size: 100px;position: absolute;left: 0;top: 0;opacity: 0;"/>
                   </div> 
                   </div>

                   <div class="form-group col-md-12 w-100">
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
                     <label for="identifient" class="control-label col-lg-2">Identifient sur Facebook<span class="required">*</span></label>
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
                     <div class="col-lg-1"> <button class="btn btn-primary Contact"><i class="fa fa-plus"></i></button> </div>
                     <div class="col-lg-3 Contactdiv">
                       <input class="form-control " id="Contact" name="Contact" type="tel" required max="13" min="13" />
                     </div>
                   </div>

                   <div class="form-group ">
                     <label for="idvp" class="control-label col-lg-2" >Commercial</label>
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
                       <th class="text-center">Code clinet</th>
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
             </div>
             </div>             