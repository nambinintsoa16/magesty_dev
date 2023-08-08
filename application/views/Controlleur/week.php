<style>
    .center {
        margin: auto;
        width: 60%;

        padding: 10px;
    }

    .tbody>td {
        width: 50px !important;
        text-align: left !important;
    }
</style>
<div class="center">
    <h3><u>Chiffre d'affaires réel</u></h3>
</div>
<div class="container">
    <div class="row">
        <div class="form-group">
            <select class="form-control dateRecap">
                <?php
                $data = $mois;
                foreach ($mois as $key => $mois) :
                    if ($key == date("m")) :
                ?>
                        <option selected><?= $mois ?></option>
                    <?php else : ?>
                        <option><?= $mois ?></option>
                <?php endif;
                endforeach; ?>
            </select>
        </div>
    </div>
</div>
<div>
    <table class="table table_rapport table-striped table-hover table-bordered">

        <thead>
            <tr style="font-size:16px;background-color:aquamarine" class="casemaine">
                <th style="width:100px">TOTAL</th>
                <th class="text-center" style="width:200px"></th>
                <th class="text-center" style="width:150px"></th>
                <th class="text-center" style="width:150px"></th>
                <th class="text-center" style="width:150px"></th>
                <th class="text-center" style="width:150px"></th>
                <th class="text-center" style="width:150px"></th>
            </tr>
        </thead>
        <thead class="thead-light text-center">

            <tr>
                <th class="text-center">Matricule</th>
                <th class="text-center" style="width:200px">OPLG</th>
                <th class="text-center" style="width:150px">S1</th>
                <th class="text-center" style="width:150px">S2</th>
                <th class="text-center" style="width:150px">S3</th>
                <th class="text-center" style="width:150px">S4</th>
                <th class="text-center" style="width:150px">Total</th>
            </tr>
        </thead>
        <tbody class="tbody text-center">

        </tbody>
    </table>
</div>