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
.tablesondage{
  border:1px;
  overflow:scroll;
  background:#fff;;
}
</style>
<div class="container col-md-12" style="background-color:white;">
<fieldset>  
  <legend>Information sur le sondage</legend>    
  <div class="form-group col-md-12 form-inline">
    <label for="date_links" class="col-md-2">Date d'enregistrement :</label>
    <input class="form-control col-md-6 date" name="date" type="text" id="date_links" placeholder="<?=date('d-M-Y')?>" disabled style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;">
  </div>

  <div class="form-group col-md-12">
    <label for="sondage" class="col-md-2">Type de sondage:</label>
    <select class="form-control select1" name="sondage" required id="Type_sondage"  style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;"> 
      <option value="" disabled selected hidden>Choisir type de sondage</option>
      <option>SATISFACTION</option>
      <option>NOTORIETE</option>
    </select>  
  </div>

  <div class="form-group col-md-12">
    <label for="date_link" class="col-md-2">Nom du client:</label>
    <input class="form-control nom" name="nom" type="text" id="date_link" placeholder="Veuillez entrer le nom du répondant" value=""  style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;">    
  </div>

  <div class="form-group col-md-12">
    <label for="link_page" class="col-md-2">Lien du client : </label>
    <input class="lien form-control" name="lien" type="text" id="link_page" placeholder="Veuillez entrer le lien" style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;">
  </div>
                
  <div class="form-group col-md-12" >
    <label for="cemail" class="col-md-2">Marque:<span class="requierd"></span></label>
    <input class="mark form-control" type="text" name="mark" id="link_page" placeholder="Veuillez entrer la marque" style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;">
</div>

  <div class="form-group col-md-12">
    <label for="cemail" class="col-md-2">Produit:<span class="requierd"></span></label>
    <input class="produit form-control" type="text" name="produit" id="link_page" placeholder="Veuillez entrer la marque" style="border:1px solid gray;box-sizing: border-box;text-align:center;width:70%;">          
  </div>

  <div class="form-group col-md-12">
    <label for="cemail" class="col-md-2">Commentaire:<span class="required"></span></label>
    <textarea class="text form-control" name="text" style="border:1px solid gray;box-sizing: border-box;width:70%" ></textarea>
  </div>

  <div class="form-group col-md-12">
    <label for="interpretation"  class="col-md-2">Type d'interprétation:</label>
    <select class="form-control select2" name="interpretation" requierd id="Type_interpretation" style="border:1px solid gray; box-sizing:border-box; width:70%;">
        <option value="" disabled selected hidden>Choisir type d'interprétation</otpion>
        <option>SATISFAIT</option>
        <option>NON SATISFAIT</option>
      </select>  
  </div>

  <div class="form-group">
    <button class="btn btn-success fff" style="font-size: 13px;padding:4px;color:#fff;margin-left:75%">ENREGISTRER</button>
  </div> 
     
<div class="form-group contentTable">
  <div class="table-responsive">
    <table class="table table-light tablesondage table-hover tablesondage">
      <thead class="thead-light">
        <tr>
          <th>DATE</th>
          <th>TYPE DE SONDAGE</th>
          <th>NOM REPONDANT</th>
          <th>LIEN FACEBOOK</th>
          <th>MARQUE</th>
          <th>PRODUIT</th>
          <th>COMMENTAIRE</th>
          <th>INTERPRETATION</th>
        </tr>
      </thead>
      <tbody class="tbody">
        <?=$data?>
      </tbody>
    </table>
  </div>
</div>
</fieldset>
</div>