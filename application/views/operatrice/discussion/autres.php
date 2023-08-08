<div class="container col-md-12 shadow-sm" style="background-color:white;padding:20px;">
  <div class="row">  
    <fieldset>
    <div class="form-group border col-md-12">
      <label class="col-lg-2" for=""><b>Type :</b></label>
        <div class="col-lg-10">
          <select  class="form-control select1 ">
            <option hidden></option>
            <?php foreach($data_type as $key=>$data_type):?>
              <option value="<?=$data_type->id?>"><?=$data_type->designation?></option>
            <?php endforeach;?>
          </select>
        </div>
    </div>

    <div class="form-group border col-md-12">
      <label class="col-lg-2" for=""><b>Tâche :</b></label>
        <div class="col-lg-10">   
        <select  class="form-control select2 ">       

        </select>
        </div>
    </div>

  
      <div class="form-group col-md-12">
        <div class="disabled">
          <label for="cemail" class="control-label col-lg-2"><b>Code de la publication :</b><span class="required"></span></label>
        </div>
        <div class="col-lg-10">
          <input class="form-control codepublication" onKeyUp="javascript:this.value=this.value.toUpperCase();" placehoulder="entrer la code de publication" type="text" id="example-datetime-local-input" name="codepublication">
        </div>
      </div>

    
      <div class="form-group col-md-12" >
        <label for="cemail" class="control-label col-lg-2"><b>Page ou compte OPL:</b><span class="requierd"></span></label>
        <div class="col-lg-10">
          <select  class="form-control pageUsers ">
            <option hidden></option>
            <?php foreach($page_user as $key=>$page_user):?>
              <option value="<?=$page_user->id?>"><?=$page_user->Type?>.|.<?=$page_user->Nom_page?>.|.<?=$page_user->Source?></option>
            <?php endforeach;?>
          </select>
        </div>
      </div>

      <div class="form-group col-md-12">
        <label for="cemail" class="control-label col-lg-2"><b>Code du produit:</b><span class="requierd"></span></label>
        <div class="col-lg-10">
          <div class="row">
            <div class="col-lg-3">
              <input class="form-control codeproduit" style="width:220px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" type="text" id="example-datetime-local-input" name="codeproduit" placehoulder="entrer la code du produit">
            </div>
            <label for="cemail" style="margin-left:30px" class="control-label col-lg-2"><b>Nom du produit:</b><span class="requierd"></span></label>
            <div class="col-lg-3">
              <input class="form-control nomproduit" style="width:442px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled type="text" id="example-datetime" name="nomproduit" style="width:415px">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group col-md-12">
        <label for="cemail" class="control-label col-lg-2"><b>Code groupe/page/compte:</b><span class="requierd"></span></label>
        <div class="col-lg-10">
          <div class="row">
            <div class="col-lg-3">
              <input class="form-control codegroupe" style="width:220px;" onKeyUp="javascript:this.value=this.value.toUpperCase();" type="text" name="codegroupe">
            </div>
            <label for="cemail" style="margin-left:30px" class="control-label col-lg-2"><b>Nom groupe/page/compte:</b><span class="requierd"></span></label>
            <div class="col-lg-3">
              <input class="form-control nomgroupe" style="width:442px;" disabled type="text" id="example-datetime" name="nomgroupe" style="width:415px">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group collapse">
        <label for="example-datetime-local-input" class="control-label col-lg-2"><b>Date :</b><span class="requierd"></span></label>
        <div class="col-lg-10" style="margin-bottom: 10px!important">
          <div class="row">
            <div class="col-lg-3">
              <input class="form-control date" type="date" id="example-datetime-local-input" name="date">
            </div>
            <label for="example-datetime" style="margin-left:75px" class="control-label col-lg-2"><b>Heure :</b><span class="requierd"></span></label>
            <div class="col-lg-3">
              <input class="form-control time" type="time" id="example-datetime" name="heure">
            </div>
          </div>
        </div>
      </div>

      <div class="form-group col-md-12">
        <div class="disabled">
          <label for="cemail" class="control-label col-lg-2"><b>Lien du support :</b><span class="required"></span></label>
        </div>
        <div class="col-lg-10">
          <input class="form-control Lien_support" id="Lien" disabled type="text" name="Lien" />
        </div>
      </div>

      <div class="form-group col-md-12">
        <div class="disabled">
          <label for="cemail" class="control-label col-lg-2"><b>Code visuel :</b><span class="required"></span></label>
        </div>
        <div class="col-lg-10">
          <input class="form-control visuel" id="Lien" disabled type="text" name="Lien" />
        </div>
      </div>

      <div class="form-group col-md-12">
        <div class="col-md-12">
         <button type="submit" class="btn btn-success pull-right btn-test" style="margin-top:20px">Enregistrer</button>
        </div>
      </div>
      <div>
    </fieldset>
      <div class="container col-md-12 bg-light">
      <div class="table-responsive">
        <table class="table dataTable table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col" style="background-color:#FFFDE7 ">Date</th>
              <th scope="col" style="background-color:#FFFDE7 ">Heure</th>
              <th scope="col" style="background-color:#FFFDE7 ">Actions</th>
              <th scope="col" style="background-color:#FFFDE7 ">Types</th>
              <th scope="col" style="background-color:#FFFDE7 ">Code de la publication</th>
              <th scope="col" style="background-color:#FFFDE7 ">Code du produit</th>
              <th scope="col" style="background-color:#FFFDE7 ">Nom du produit</th>
              <th scope="col" style="background-color:#FFFDE7 ">Code groupe/page/compte</th>
              <th scope="col" style="background-color:#FFFDE7 ">Nom groupe/page/compte</th>
            </tr>
          </thead>
          <tbody class="tabeContect">
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</div>
