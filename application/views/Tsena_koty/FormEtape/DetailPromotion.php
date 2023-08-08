<div class="container">
    <div class="row">
        <?php  foreach($data as $key=>$data):?>
        <div class="form-group col-md-4">
            <div class="card" style="width: 10rem;">
                <img class="card-img-top" src="<?=base_url('assets/images/promotion/'.$data->Code_produit);?>.jpg"
                    alt="<?=$data->Designation?>">
                <div class="card-body">
                    <p class="card-title"><?php //$data->Designation?></p>
                    <a href="#" id="<?=$data->Code_produit?>" class="btn btn-primary btn-sm ajourPanier">Ajouter au panier</a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>