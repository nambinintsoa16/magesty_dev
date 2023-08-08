<div class="collapse date_select"><?=$date?></div>
        <div class="container p-0 mt-2">
            <div class="row p-0 m-0 d-flex justify-content-between">
                <div class="link" id="Previ" style="padding-right:2px;cursor:pointer;">
                    <div class="row">
                        <div class="col-md-4 p-3" style="background:#007bff;height:90px"><span class="info-box-icon">
                                <i class="flaticon-shapes" style="color:white;font-size:24px;"></i></span>
                        </div>
                        <div class="col-md-8 card" style="color:#ddd;height:90px">
                            <p class="text-dark font-weight-bold pt-2" style="font-size:12px;">Ventes Prévisionnelles <br>
                                <b class="text-center"><?=number_format($previ, 2, ',', ' ');?>&nbsp;Ar</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="link ml-4" id="livre" style="padding-right:2px;cursor:pointer;">
                    <div class="row">
                        <div class="col-md-4 p-3" style="background:#5cb85c;height:90px"><span class="info-box-icon">
                                <i class="flaticon-shapes" style="color:white;font-size:24px;"></i></span>
                        </div>
                        <div class="col-md-8 card" style="color:#ddd;height:90px">
                            <p class="text-dark font-weight-bold pt-2" style="font-size:12px;">Ventes Réalisées <br>
                            <b class="text-center"><?=number_format($livre, 2, ',', ' ');?>&nbsp;Ar</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="link ml-4"  id="annule" style="padding-right:2px;cursor:pointer;">
                    <div class="row">
                        <div class="col-md-4 p-3" style="background:#d9534f;height:90px"><span class="info-box-icon">
                                <i class="flaticon-shapes" style="color:white;font-size:24px;"></i></span>
                        </div>
                        <div class="col-md-8 card" style="color:#ddd;height:90px">
                            <p class="text-dark font-weight-bold pt-2" style="font-size:12px;">Ventes Annulées <br>
                                <b class="text-center"><?=number_format($annule, 2, ',', ' ');?>&nbsp;Ar</b>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="link ml-4" id="confirmer" style="padding-right:2px;cursor:pointer;">
                    <div class="row">
                        <div class="col-md-4 p-3" style="background:#aa66cc;height:90px"><span class="info-box-icon">
                                <i class="flaticon-shapes" style="color:white;font-size:24px;"></i></span>
                        </div>
                        <div class="col-md-8 card" style="color:#ddd;height:90px">
                            <p class="text-dark font-weight-bold pt-2" style="font-size:12px;">Ventes Confirmées <br>
                                <b class="text-center"><?=number_format($confirmer, 2, ',', ' ');?>&nbsp;Ar</b>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="link ml-4" id="en_attente" style="padding-right:2px;cursor:pointer;">
                    <div class="row">
                        <div class="col-md-4 p-3" style="background:orange;height:90px"><span class="info-box-icon">
                                <i class="flaticon-shapes" style="color:white;font-size:24px;"></i></span>
                        </div>
                        <div class="col-md-8 card" style="color:#ddd;height:90px">
                            <p class="text-dark font-weight-bold pt-2" style="font-size:12px;"> Ventes à confirmer <br>
                                <b class="text-center"><?=number_format($en_attente, 2, ',', ' ');?>&nbsp;Ar</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bg-white panel p-2">
           

        </div>
