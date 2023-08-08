
<div class="row">
    <img src="http://nambinintsoatest.combo.fun/images/operatrice/bannierevente.jpg" class="card-img-top" alt="..." width="100%" height="400px"style="object-fit: cover;margin-top:-16px;">
    <div class="bg-dark text-white col-md-12 pt-2">
        <span class="font-weight-bold ml-3">Vente Journalière du : <?=date('d-m-Y')?></p>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <div class="card mb-3 p-0" style="height:90px;background:#28b225;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-user fa-2x mt-4"></i>
                <span class="text-right">
                    <h3 class="text-white"><?=number_format($ca_du_jour, 0, ',', ' ')?> Ar</h3>
                    <p class="text-white font-weight-bold">Chiffre d'affaire du jour</p>
                </span>
            </div>
            <div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div>
        </div>
    </div>
   
   <div class="col-md-4">
       <div class="card mb-3 p-0 bg-info" style="height:90px;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-cubes fa-2x mt-4"></i>
                <span class="text-right">
                    <h3 class="text-white"><?=$produit?> Produits</h3>
                    <p class="text-white font-weight-bold">Produits Vendus</p>
                </span>
            </div>
            <a href="<?=base_url("$type_user/Etat_de_ventes/Produit")?>" style="text-decoration:none;color:#2E2E2E"><div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div></a>
        </div>
   </div>
    
    <div class="col-md-4">
       <div class="card mb-3 p-0 bg-danger" style="height:90px;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-calendar fa-2x mt-4"></i>
                <span class="text-right">
                    <h3 class="text-white"><br></h3>
                    <p class="text-white font-weight-bold">Calendrier de vente</p>
                </span>
            </div>
            <a href="<?=base_url("$type_user/Etat_de_ventes/calendrier_de_livraison")?>"  style="text-decoration:none;color:#2E2E2E"><div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info<i class="fa fa-arrow-circle-right ml-2"></i></div></a>
        </div>
</div>


