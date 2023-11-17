<style type="text/css">
.donut-inner {
   margin-top: -100px;
   margin-bottom: 100px;
   margin-left: 185px;
}
.donut-inner h5 {
   margin-left: 20%;
   margin-top: -5;
}
.donut-inner span {
   font-size: 12px;

}
</style>
<div class="row">
    <div class="user-profile w-100"  id="user-profile-2" >
        <div class="card col-md-12 tabbable">
            <ul class="nav nav-tabs ml-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-info" data-toggle="tab" href="#home"><i class="fa fa-user text-success mr-2"></i>Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" data-toggle="tab" href="#feed"><i class="fa fa-info text-info mr-2"></i> Détail</a>
                </li>
            </ul> 
            <div class="tab-content">
                <div id="home" class="container tab-pane active pt-4">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="<?=code_client_img_link($infoclient->Code_client)?>" width="70%" height="180px"style="object-fit: cover;">
                        </div>
                        <div class="col-md-8 ml-3">
                            <h3 class="font-weight-bold text-primary"></h3>
                            <ul class="list-group">
                                <li class="list-group-item d-flex">
                                    <span class="col-md-4">Nom sur Facebook:</span><span class="col-md-8"><?= $infoclient->Compte_facebook; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <span class="col-md-4">Code Client:</span><span class="col-md-8 codeClient"><?= $infoclient->Code_client; ?></span>
                                </li>
                                <li class="list-group-item">
                                    <span class="col-md-4">Enregistré le:</span><span class="col-md-8"><?= $infoclient->datedenregistrement; ?></span>
                                </li>

                                <li class="list-group-item">
                                    <span class="col-md-4"><i class="text-success fa fa-phone-square"></i> Contact :</span><span class="col-md-8"><?= $infoclient->Contact; ?></span>
                                </li>
                                
                                <li class="list-group-item">
                                    <span class="col-md-4"> Compte facebook : </span><span class="col-md-8">
                                      <a href="<?=$infoclient->lien_facebook?>" target="_blank">    
                                        <i class="text-primary fab fa-facebook fa-2x m-0"></i></span>
                                      </a>        
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="feed" class="container tab-pane pt-4">
                    
                    <div class="row">

                    
                        <div class="col-md-6">
                            <div>
                            <h4><i class="fa fa-map-marker text-success"></i><u class="ml-2"><strong class="ml-3">Fiabilité du Client</strong></u></h4>
                                <canvas class="doughnut mt-2"  id="doughnut">
                                    
                                </canvas>
                                <div class="donut-inner" >         
                                     <b> <h5 class="data" style="font-size:30px;"> </h5></b>
                                </div>
                            </div>

                        </div>     
                    <div class="col-md-6">   
                        <div>
                        <h4><i class="fa fa-map-marker text-success"></i><u class="ml-2"><strong class="ml-3">Tendances d'achat</strong></u></h4>
                            <canvas class="doughnut mt-2"  id="singelBarChart"></canvas>
                        </div> 
                    </div>
                    
                    <div class="col-md-12">
                            <div class="panel panel-default" >
                                <div class="panel-heading">
                                    <h4><i class="fa fa-map-marker red text-success"></i><u class="ml-2"><strong class="ml-3">Statistique</strong></u></h4>
                                </div>
                                <div class="panel-body-map">
                                    <canvas class="lineChart "  id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="container col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><i class="fa fa-cart-arrow-down"></i><span class="ml-2">Produits Achetés</span></li>
                            </ol>
                        </div>
                        <div class="col-md-12 w-100">
                            <table class="table table-hover table-striped dataTables w-100">
                                <thead class="bg-<?=$nav_color?> text-white text-center">
                                    <tr>
                                        <th>Aperçu</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Date de Commande</th>
                                        <th>Date lV OPL</th>
                                        <th>Date lV SC</th>
                                        <th>Statut</th>
                                        <th>Info</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


