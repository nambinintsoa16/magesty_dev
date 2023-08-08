<style>
.file-upload {
    position: relative;
    overflow: hidden;
    border-radius: 3px !important;
    background: green;
    text-transform: uppercase;
    font-size: 13px;
    border:none !important;
    box-shadow: none !important;
    color: #fff !important;
    text-shadow:none;
    padding: 5px 10px !important;
    font-family: Arial, sans-serif;
    display: inline-block;
    vertical-align: middle;

}
.file-upload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
#fileuploadurl{
    display: inline-block;
    border:solid 1px #000;
    vertical-align: middle;
    background: none;
    box-shadow: none;
    margin-right:10px;
    font-size: 13px;
    padding:4px;
    width:550px;
 
}
</style>
<style>
.file-upload {
    position: relative;
    overflow: hidden;
    border-radius: 3px !important;
    background: green;
    text-transform: uppercase;
    font-size: 13px;
    border:none !important;
    box-shadow: none !important;
    color: #fff !important;
    text-shadow:none;
    padding: 5px 10px !important;
    font-family: Arial, sans-serif;
    display: inline-block;
    vertical-align: middle;

}
.file-upload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
#fileuploadurl{
    display: inline-block;
    border:solid 1px #000;
    vertical-align: middle;
    background: none;
    box-shadow: none;
    margin-right:10px;
    font-size: 13px;
    padding:4px;
    width:550px;
 
}
</style>

   <div class="container col-md-12" style="background:white;padding:2%;">
      <fieldset class="shadow-sm">  
         <legend>Information sur fichier</legend>    

        <div class="form-group form-inline col-md-12">
           <label for="date_links" class="col-md-3">Date d'enregistrement :</label>
           <input type="text" id="date_links" class="form-control col-md-1" placeholder="<?=date('d')?>" disabled style="border:1px solid gray;box-sizing: border-box;text-align:center;width:50px;">
           <input type="text" id="date_links" class="form-control col-md-1 ml-5" placeholder="<?=date('M')?>" disabled style="border:1px solid gray;box-sizing: border-box;text-align:center;width: 80px;">
           <input type="text" id="date_links" class="form-control col-md-1 ml-5" placeholder="<?=date('Y')?>" disabled style="border:1px solid gray;box-sizing: border-box;text-align:center;width: 80px;">
        </div>

        <div class="form-group d-flex col-md-12">
           <label for="date_link" class="col-md-2">Groupe :</label>
           <input type="text" id="date_link" class="form-control" placeholder="<?=$groupe->Nom_page?>" value="<?=$groupe->Nom_page?>" disabled style="border:1px solid gray;box-sizing: border-box;text-align:center;width:386px;">
        </div>
         <div class="form-group d-flex col-md-12">
             <label for="link_page" class="col-md-2">Publication source : </label>
             <input type="text" class="form-control" id="link_page" style="border:1px solid gray;box-sizing: border-box;text-align:center;width:386px;" placeholder="http//facebook/onetoone?">
          </div>
          <div class="form-group d-flex col-md-12">
           <label for="reaction" class="col-md-2">Reaction :</label>
            <select id="reaction"  class="form-control"  style="border:1px solid gray;box-sizing: border-box;text-align:center;width:386px;"> 
               <option>J'aime</option>
               <option>Partager</option>
               <option>Autre</option>
               <option>Item-4</option>
            </select>  
        </div>
       </fieldset>
       <fieldset class="shadow-sm">  <legend>Fichier</legend>
         <div class="container">
            <input type="text" style="margin-left:15%;" class="form-control col-md-8" id="fileuploadurl" readonly placeholder="Maximum file size is 10Mo">
            <div class="file-upload btn btn-primary">
               <span class="">Parcourir</span>
               <input type="file" name="FileAttachment" id="FileAttachment" class="upload" />
            </div>
            <button class="btn btn-danger" style="font-size: 13px;padding:4px;color:#fff;background-color:#ff0000;">SUPPRIMER</button>
         </div>
       </fieldset><br>
       <fieldset class="shadow-sm">  <legend>Liste de mes clients potentiels:</legend >    
          <div class="table"></div>
       </fieldset>
</div>
