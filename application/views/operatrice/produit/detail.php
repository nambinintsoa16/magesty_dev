
        <div class="profill-image">
                <div class="card">
                    <form action="" method="post" style="margin-top: 20px; margin-left:90px">
                    <div class="row">
                    <div class="col-md-4 col-xs-12 p-2">
                    <img class="img-thumbnail" style="width:230px" src="<?=code_produit_img_link($produit->Code_produit)?>">
                            <div class="btn" style="background-color: #5e6164;opacity:0.8; width:230px; padding: 10px;margin-top:-65px">
                                <a href="#" style="text-decoration: none; color: #fff;"><?= $produit->Code_produit; ?></a>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top:20px; margin-left: 40px">
                            <h5><strong><?= $produit->Designation; ?></strong> <?= $produit->Quantites; ?></h5>
                            <h5><strong>prix : <?= number_format($produit->Prix_detail, 0, ',', ' '); ?> Ariary</strong></h5>
                            <h5>
                             Fabricant : <?=$produit->fabricant?> <br/>
                             Famille : <?=$produit->famille?> <br/>
                             Groupe :<?=$produit->groupe?>       
                            </h5>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="tabbable col-12 card p-2">
                    <ul class="nav nav-tabs" role="tablist" >
                        <li class="nav-item ">
                            <a class="nav-link active text-ligth" data-toggle="tab" href="#AAC7"><i class="text-success ace-icon fa fa-info bigger-120"></i>&nbsp; DESIGNATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#AAC14"><i class="text-warning ace-icon fa fa-lightbulb-o bigger-120"></i>&nbsp; CONSEIL D'UTILISATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#AAC28"><i class="text-danger ace-icon flaticon-chat-8 bigger-120 "></i>&nbsp; ARGUMENTAIRE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#AAC35"><i class="text-danger ace-icon flaticon-file-1 bigger-120 "></i>&nbsp; INGREDIENTS</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#PRES"><i class="text-danger ace-icon flaticon-pencil bigger-120 "></i>&nbsp; PRESENTATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#CAR"><i class="text-success ace-icon flaticon-interface-2 bigger-120 "></i>&nbsp; CARACTERISTIQUES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-ligth" data-toggle="tab" href="#IMAGE"><i class="text-warning ace-icon flaticon-picture bigger-120 "></i>&nbsp; VISUELS</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-light">
                        <div id="AAC7" class="tab-pane active">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->Designation; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="AAC14" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->modedutilisation; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="AAC28" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->argumentaire; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="AAC35" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->ingredient; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="PRES" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->presentation; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="CAR" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            <?= $produit->caracteristique; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="IMAGE" class="tab-pane">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-justify">
                                            
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>






