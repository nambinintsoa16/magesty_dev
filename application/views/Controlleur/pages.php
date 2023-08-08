<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="col-12 m-0 p-0">
        <div class="container">
            <h2>Gestion des pages</h2>
            <ul class="nav nav-tabs">
                <li class="active text-center" style="width:50%; "><a data-toggle="tab" href="#home">Liste des pages activées</a></li>
                <li class="text-center" style="width:50%"><a data-toggle="tab" href="#menu1">Liste des pages desactivées</a></li>

            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active" style="width: 50%;">

                    <?php

                    $datas = [
                        'data' => $datas
                    ];
                    $this->load->view("Controlleur/actives", $datas) ?>


                </div>
                <div id="menu1" class="tab-pane fade">
                    <?php

                    $passives = [
                        'data' => $passives
                    ];
                    $this->load->view("Controlleur/off", $passives) ?>

                </div>

            </div>
        </div>
    </div>

</body>

</html>