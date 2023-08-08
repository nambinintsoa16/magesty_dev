<div class="col-md-12">
    <img src="<?= base_url('images/banniere-user-min.jpg') ?>" width="100%" height="400px" style="object-fit:cover; z-index:0;">
    <div style="z-index:0;margin-top:-370px;position:absolute;color:white;font-size:26px;padding-left:50px">
        <span style="font-size:34px;margin-top:0px"> Nos commerciaux en ligne
        </span>
    </div>
</div>
</div>
<div class="row temoignage py-3" style="margin-top:-300px">
    <div class="container">
        <div class="row content-equipe">


        </div>
    </div>
</div>
</div>

<section class="panel">
    <div id="c-slide" class="carousel slide auto panel-body">
        <ol class="carousel-indicators out">
            <?php for ($i = 0; $i < $NumbreUser; $i++) : ?>
                <li <?php if ($i == 0) : ?>class="active" <?php endif; ?> data-slide-to="<?= $i ?>" data-target="#c-slide"></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">

            <?php $i = 0;
            foreach ($user as $user) : ?>

                <div class="item text-center <?php if ($i == 0) : ?> active <?php endif;
                                                                    $i++; ?> ">
                    <h3>Item </h3>
                    <div class="col-md-4">
                        <a href="<?= base_url($type_user ."/performance/".$user->Matricule) ?>">

                            <div class="content-child py-3" style="background:#ffbb33;min-height:270px;-webkit-box-shadow: 5px 5px 6px -1px rgba(205,205,209,1);
-moz-box-shadow: 5px 5px 6px -1px rgba(205,205,209,1);
box-shadow: 5px 5px 6px -1px rgba(205,205,209,1);">
                                <div class="row" style="">
                                    <p style="text-align:left;padding-left: 25px;padding-top: 15px">
                                        <b style="font-size:16px;color:white"><br> </b>
                                        <span style="color:white">Nom</span>
                                    </p>
                                    <img src="<?= base_url('images/operatrice/PhotoUser/' . $user->Matricule) ?>.jpg" class="style-image" width="120px" height="120px" style="position:relative;left:1%;border-radius:50%;margin-top:5px;border:solid 5px #fff">
                                   

                                </div>

                                <div class="" style="background:white;width:100%;margin-top:-60px;height:170px">

                                    <br>
                                    <br>
                                    <br>

                                    <div class="row" style="font-size: 12px;padding-left: 10px;text-align: center;color:black">
                                        <div class="col-md-4" style=" border-right: solid 1px  #ccc;height: 60px;padding-top: 10px;color: #ffbb33;font-weight: bold;">Chiffre d' Affaire <br> <span style="font-weight: bold;color: #ffbb33;font-size: 16px !important">
                                                000
                                            </span>
                                        </div>

                                        <div class="col-md-4" style="border-right: solid 1px #ccc;height: 60px;padding-top: 10px;color: #ffbb33;font-weight: bold;">Transaction <br> <span style="font-weight: bold;color: #ffbb33;font-size: 16px">

                                            </span></div>

                                        <div class="col-md-4" style="padding-top: 10px;color: #ffbb33;font-weight: bold;">Produit <br><span style="font-weight: bold;color: #ffbb33;font-size: 16px">
                                                000
                                            </span></div>

                                    </div>
                                </div>

                            </div>
                        </a>
                    </div>

                    <div class="col-md-8" style="background:#ffbb33;height:300px">
                        <div class="row" style="padding-top: 20px;text-align: left;color: white">
                            <div class="col-md-6" style="border-right-width: 2px;height: 260px; border-right: solid white 2px">
                                <a class="btn btn-default" aria-label="Settings">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                </a> &nbsp; &nbsp; Vente du mois éffectuée
                                <p style="padding-left: 40px;padding-top: 20px"><i class=""></i> Recap du mois : <b>
                                        000 Ar
                                    </b></p>
                                <p style="padding-left: 40px"> <i class=""></i></span> Reccord de vente : <b> </b></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <a data-slide="prev" href="#c-slide" class="left carousel-control">
            <i class="arrow_carrot-left_alt2"></i>
        </a>
        <a data-slide="next" href="#c-slide" class="right carousel-control">
            <i class="arrow_carrot-right_alt2"></i>
        </a>