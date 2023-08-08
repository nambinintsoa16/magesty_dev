<div class="container">
    <div class="row">
        <table class="table table-light dataTable table_timeline">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">HEURE</th>
                    <th class="text-center">ID DISC / CODE AFFICHE</th>
                    <th class="text-center">CODE DISCUSSION</th>
                    <th class="text-center">CODE PRODUIT</th>
                    <th class="text-center">NOM PAGE/COMPTE</th>
                    <th class="text-center">CODE CLIENT / NOM PRODUIT</th>
                    <th class="text-center">TYPE INTERVENTION</th>
                    <th class="text-center">ACTION</th>


                </tr>
            </thead>

            <tbody class="tbody">
                <?php foreach ($data as $data) :

                    $date = explode(' ', $data['heure']);
                    $dt = new dateTime($date[1]);
                    $dt->modify('+1hours');
                    $dates = $dt->format("H:i:s");

                ?>
                    <tr>

                        <td><?php if ($data['action'] != "") {
                                echo $date[1];
                            } else {
                                echo $dates;
                            } ?></td>
                        <td class="text-center"><?= $data['Id_discussion'] ?></td>
                        <td class="text-center"><?= $data['Id_reponse'] ?></td>
                        <td class="text-center"><?= $data['CodeProduit'] ?></td>
                        <td class="text-center"><?= strtoupper($data['Nom_page']) ?></td>
                        <td class="text-center"><?= $data['client'] ?></td>
                        <td class="text-center"><?= strtoupper($data['Type']) ?></td>
                        <td <?php if ($data['action'] == 'PUBLICATION') {
                                echo 'style="background-color:#FF0000;color:#fff;padding:5px 10px;border-radius:5px;"';
                            } else if ($data['action'] == 'PARTAGE') {
                                echo 'style="background-color:#339900;color:#fff;padding:5px 10px;border-radius:5px;"';
                            } else if ($data['action'] == 'SONDAGE') {
                                echo 'style="background-color:#ffbb33;color:#fff;padding:5px 10px;border-radius:5px;"';
                            } else if ($data['action'] = 'DISCUSSION') {
                                echo 'DISCUSSION';
                            } ?>><?= $data['action']; ?></td>

                    </tr>
                <?php
                // $datevomp="";
                // $datevomp= $date_temp;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>