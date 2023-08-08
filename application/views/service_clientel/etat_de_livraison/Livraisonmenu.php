<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="?page=">Accueil</a></li>
                    <li><i class="fa fa-cube"></i><a href="#">Livraison Journalière</a></li>
                </ol>
            </div>
        </div>
        <div class="row banniere_livraison">
            <div class="col-md-12">
                <img src="../img/livraison910.jpg" alt="" height="400" width="100%"
                    class="bann_image">
            </div>
            <div class="row" >
               <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-8 col-md-offset-8" style="margin-top: -300px;background-image: url('../img/note.jpg');background-size: cover;height: 248px">
                <a href="?page=AjoutClient"> 
                    <div class="bloc_menu5" style="background: none!important">
                       
                        <div class="block_nombre5" style="font-size: 54px;color: black;padding-top: 80px;text-align: center!important">
                        <?=$main->transaction_livraison(date('Y-m-d'),'En_attente')?>
                        </div>
                      
                        <div class="block_titre5" style="margin-right: 0px;padding-top: 0px;text-align: center;color: black"> Livraisons à confirmer</div>
                       
                    </div></a>  
            </div>
            </div>

        </div>
        <div class="row menulivraison" >

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="?page=livraisonprevlist">

                    <div class="bloc_menu" style="background: #007aff!important">
                        <div class="icon_block p-auto"  style="background: #007aff!important">
                             <i class="fa fa-info"></i>
                        </div>
                       
                        <div class="block_nombre">
                          <?=$main->transaction_livraison(date('Y-m-d'))?>
                        </div>
                        <div class="block_titre"> Livraisons Previsionnelles </div>
                        <div class="plus_info">
                           Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </a>
            </div>   
          


          
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="?page=LivraisonEffectuee">

                    <div class="bloc_menu" style="background: #00a65a!important">
                        <div class="icon_block"  style="background: #00a65a!important">
                             <i class="fa fa-info" ></i>
                        </div>
                       
                        <div class="block_nombre">
                        <?=$main->transaction_livraison(date('Y-m-d'),'livre')?>
                        </div>
                        <div class="block_titre"> Livraisons Effectuées </div>
                        <div class="plus_info">
                           Plus d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="?page=livraison">
                    <div class="bloc_menu1" style="background: #03a5cc!important">
                        <div class="icon_block1" style="background: #03a5cc!important">
                           <i class="fa fa-info"></i> 
                        </div>
                        
                        <div class="block_nombre1">
                        <?=$main->transaction_livraison(date('Y-m-d'),'confirmer')?>
                        </div>
                        <div class="block_titre1"> Livraisons Confirmées</div>
                        <div class="plus_info1">
                          Plus  d'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                    <a>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <a href="?page=livreannul">
                    <div class="bloc_menu3">
                        <div class="icon_block3">
                            <i class="fa fa-info"></i> 
                        </div>
                        <div class="block_nombre3">
                        <?=$main->transaction_livraison(date('Y-m-d'),'annule')?>
                        </div>
                        <div class="block_titre3"> Livraisons Annulées </div>
                        <div class="plus_info3">
                            Plusd'info &nbsp; <i class="fa fa-arrow-circle-right"></i>
                        </div>

                    </div>
            </div>
            </a>
        </div>
        </div>
        