
<div class="row">
    <img src="<?=base_url("images/service_clientel/bannierevente.jpg")?>" class="card-img-top" alt="..." width="100%" height="400px"style="object-fit: cover;margin-top:-16px;">
    <div class="bg-dark text-white col-md-12 pt-2">
        <span class="font-weight-bold ml-3">Vente Journalière du : <?=date('d-m-Y')?></p>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-3">
        <div class="card mb-3 p-0" style="height:90px;background:#28b225;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-user fa-2x mt-4"></i>
                <a href="<?=base_url('operatrice/LivraisonEffectuee')?>">
                    <span class="text-right">
                        <h3 class="text-white"><?=number_format($ca_du_jour, 2, ',', ' ')?> Ar</h3>
                        <p class="text-white font-weight-bold">Chiffre d'affaire livré du jour</p>
                    </span>
                </a>
            </div>
            <div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div>
        </div>
    </div>
   
   <div class="col-md-3">
       <div class="card mb-3 p-0 bg-info" style="height:90px;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-cubes fa-2x mt-4"></i>
                <a href="<?=base_url('operatrice/produit')?>">
                    <span class="text-right">
                        <h3 class="text-white"><?=$produit?> Produits</h3>
                        <p class="text-white font-weight-bold">Produits Vendus</p>
                    </span> 
                </a>
            </div>
            <div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div>
        </div>
   </div>

   <div class="col-md-3">
        <div class="card mb-3 p-0 bg-warning" style="height:90px;">
            <div class="card-body d-flex justify-content-between text-white">
                <i class="fa fa-user fa-2x mt-4"></i>
                <a href="<?=base_url('operatrice/LivraisonEffectuee')?>">
                    <span class="text-right">
                        <h3 class="text-white"><?=number_format($ca_la_veille->CA, 2, ',', ' ')?> Ar</h3>
                        <p class="text-white font-weight-bold">Chiffre d'affaire livré de la veille</p>
                    </span>
                </a>
            </div>
            <div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card mb-3 p-0 bg-danger" style="height:90px;">
            <div class="card-body d-flex justify-content-between text-white"> 
              
                <i class="fa fa-calendar fa-2x mt-4"></i>
                     
                    <span class="text-right">
                        <h3 class="text-white"><br></h3>
                        <p class="text-white font-weight-bold">Calendrier de vente</p>
                    </span>
         
            </div>  <a href="<?=base_url('operatrice/Livraison_du_jour')?>"> 
           <div class="card-footer p-1 text-center bg-white" style="margin-top:-30px;box-shadow:1px 1px 1px #b9bdb9;">Plus d'info <i class="fa fa-arrow-circle-right ml-2"></i></div>
         </a>
     </div>
</div>
