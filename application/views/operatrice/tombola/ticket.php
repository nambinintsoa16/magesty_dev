<div class="row">
<div class="form-group col-md-6">
        <label for="">Code client : </label>
        <input type="text" class="form-control form-control-sm codeClient" disabled value="<?=$client?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">facture : </label>
        <input type="text" class="form-control form-control-sm factureContent" disabled value="<?=$facture?>">
    </div>

    <div class="form-group col-md-6">
        <label for="">Nom : </label>
        <input type="text" class="form-control form-control-sm nom">
    </div>
    <div class="form-group col-md-6">
        <label for="">Prénom : </label>
        <input type="text" class="form-control form-control-sm prenom">
    </div>
  
    <div class="form-group col-md-6">
        <label for="">Date de naissance : </label>
        <input type="date" class="form-control form-control-sm dateNaiss">
    </div>
    <div class="form-group col-md-6">
        <label for="">Contacte : </label>
        <input type="text" class="form-control form-control-sm contact" placeholder="+261 33 32 123 12" pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" required maxlength="10" minlength="10">
    </div>
</div>

