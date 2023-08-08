
<style>
.file-upload {
    position: relative;
    overflow: hidden;
    border-radius: 50% !important;
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

}
#fileuploadurl{
    display: inline-block;
    vertical-align: middle;
    background: none;
    box-shadow: none;
    margin-right:10px;
    font-size: 13px;
    padding:4px;
    width:670px;

}
.arrow_carrot-right
{
    padding-right: 100px ;
}
</style>
<div class="container">
    <div class="row">

        <div class="card">
            <div class="card-body text-center" style="padding:10%;">

                <div class="form-group">
                    <img class="img-thumbnail img-circle w-20" id="preview"  style="width:160px;height:160px; object-fit:cover" src="<?=base_url('images/default_user.png')?>" alt="client"><br>
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
                        <input id="coach_p" class="form-control coach" type="text" name=""  placeholder="Coach">
                    </div>
                    <div class="form-group col-md-6">
                        <input id="commerciale_p" class="form-control commerciale" type="text" name=""  placeholder="Commerciale">
                    </div>
                </div>


                <div class="form-group">
                    Ajouter un nouveau client &nbsp; <a href="#" class="btn btn-default" style='border-radius:50%;'><i class="fa fa-plus bg-gray"></i></a>
                </div>
                <div>
                <a href="#" class="btn btn-primary pull-right collapse next">Suivant<span class="arrow_carrot-right"></span></a>
                    <a href="<?php echo site_url('Service_apres_vente/voirMessage')?>" class="btn btn-success pull-right save">Enregistre<span class="arrow_carrot-right"></span></a>
                </div>
            </div>
            
        </div>
    </div>
</div>