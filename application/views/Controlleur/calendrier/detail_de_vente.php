<div class="collapse date_select"><?= $date ?></div>
<div class="container p-0 m-0">
    <div class="row p-0 m-0">
        <div class="col-md-3 col-sm-6 col-xs-12 link" id="Previ" style="padding-right:30px;cursor:pointer">
            <div class="row">
                <div class="col-md-4" style="background:#007bff;height:70px"><span class="info-box-icon">
                        <i class="fa fa-bookmark-o" style="color:white;font-size:24px;padding-top:20px;padding-left:0px;"></i></span>
                </div>
                <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                    <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Prévisionnelles <br>
                        <?= number_format($previ, 2, ',', ' '); ?>&nbspAr
                    </p>
                </div>
            </div>

        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 link" id="livre" style="padding-right:30px;cursor:pointer">
            <div class="row">
                <div class="col-md-4" style="background:#5cb85c;height:70px"><span class="info-box-icon">
                        <i class="fa fa-bookmark-o" style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                </div>
                <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                    <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Réalisées <br>
                        <?= number_format($livre, 2, ',', ' '); ?>&nbspAr
                    </p>

                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 link" id="annule" style="padding-right:30px;cursor:pointer">
            <div class="row">
                <div class="col-md-4" style="background:#d9534f;height:70px"><span class="info-box-icon">
                        <i class="fa fa-bookmark-o" style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                </div>
                <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                    <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Annulées <br>
                        <?= number_format($annule, 2, ',', ' '); ?>&nbspAr

                    </p>
                </div>
            </div>


        </div>

        <div class="col-md-2 col-sm-6 col-xs-12 link" id="confirmer" style="padding-right:30px;cursor:pointer">
            <div class="row">
                <div class="col-md-4" style="background:#aa66cc;height:70px"><span class="info-box-icon">
                        <i class="fa fa-bookmark-o" style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                </div>
                <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                    <p class="" style="color:black;font-size:12px;padding-top:10px">Ventes Confirmées <br>
                        <?= number_format($confirmer, 2, ',', ' '); ?>&nbspAr
                    </p>
                </div>
            </div>


        </div>

        <div class="col-md-3 col-sm-6 col-xs-12 link" id="en_attente" style="padding-right:30px;cursor:pointer">
            <div class="row">
                <div class="col-md-4" style="background:orange;height:70px"><span class="info-box-icon">
                        <i class="fa fa-bookmark-o" style="color:white;font-size:24px;padding-top:20px;padding-left:5px;"></i></span>
                </div>
                <div class="col-md-8" style="background:white;color:#ddd;height:70px">
                    <p class="" style="color:black;font-size:12px;padding-top:10px"> Ventes à confirmer <br>
                        <?= number_format($en_attente, 2, ',', ' '); ?>&nbspAr
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:20px;">
    <div class="row" style="text-align:center!important;">
        <table class="table table-striped table-advance table-hover tabe_user">
            <thead>
                <tr>

                    <th>OPLG</th>
                    <th>Ventes Prévisionnelles</th>
                    <th>Ventes Réalisées</th>
                    <th>Ventes Annulées</th>
                    <th>Ventes Confirmées</th>
                    <th>Ventes à confirmer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as  $key => $user) : ?>
                    <tr>
                        <td><?= substr($key, 0, 7) ?></td>
                        <td><a href="#" class="com_use" id="Previ"><?php if (isset($user['previ'])) {
                                                                        echo number_format((int)$user['previ'], ' 2', ',', ' ');
                                                                    } else {
                                                                        echo number_format((int)00, ' 2', ',', ' ');
                                                                    } ?></a></td>
                        <td><a href="#" class="com_use" id="livre"><?php if (isset($user['livre'])) {
                                                                        echo number_format((int)$user['livre'], ' 2', ',', ' ');
                                                                    } else {
                                                                        echo number_format((int)00, ' 2', ',', ' ');
                                                                    } ?></a></td>
                        <td><a href="#" class="com_use" id="annule"><?php if (isset($user['annule'])) {
                                                                        echo number_format((int)$user['annule'], ' 2', ',', ' ');
                                                                    } else {
                                                                        echo number_format((int)00, ' 2', ',', ' ');
                                                                    } ?></a></td>
                        <td><a href="#" class="com_use" id="confirmer"><?php if (isset($user['confirmer'])) {
                                                                            echo number_format((int)$user['confirmer'], ' 2', ',', ' ');
                                                                        } else {
                                                                            echo number_format((int)00, ' 2', ',', ' ');
                                                                        } ?></a></td>
                        <td><a href="#" class="com_use" id="en_attente"><?php if (isset($user['en_attente'])) {
                                                                            echo number_format((int)$user['en_attente'], ' 2', ',', ' ');
                                                                        } else {
                                                                            echo number_format((int)00, ' 2', ',', ' ');
                                                                        } ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<hr style="background-color:#000;">





<div class="row" style="background:white;margin-top:20px;margin-left:0px;margin-right:0px">
    <div class="col-lg-12" style="">
        <section class="panel">

        </section>

    </div>

</div>
</div>
</div>