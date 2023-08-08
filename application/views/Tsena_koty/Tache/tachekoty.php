<div class="container card" style="background-color:#b1bace " >
    <div class="form-group">
        <label>ZONE: </label>
        <select class="custom-select custom-select-sm" id="sel1">
            <option hidden>
            <option>
            <option>PROVINCE</option>
            <option>ANTANANARIVO</option>
        </select>
    </div>
    <div class="form-group">
        <label>PAGE / COMPTE : </label>
        <select class="custom-select pageUsers custom-select-sm" id="sel1">
            <option hidden>--CHOIX--</option>
            <?php foreach ($pageuser as $value) : ?>
                <option value="<?= $value->id ?>">
                    <?= strtoupper($value->Type) ?>.|.<?= strtoupper($value->Nom_page) ?>.|.<?= strtoupper($value->Source) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>TACHE :</label>
                    <select class="custom-select select1 custom-select-sm" id="sel1">
                        <option hidden>--CHOIX--</option>
                        <?php foreach ($typetache as $value) : ?>
                            <option value="<?= $value->id ?>"><?= $value->nom_tache ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>TYPE DE TACHE :</label>
                    <select class="custom-select select2 custom-select-sm">

                    </select>
                </div>
            </div>
            <div class="col-md-4 ml-auto">
                <div class="form-group">
                    <label>ACTION :</label>
                    <select class="custom-select action custom-select-sm" id="sel1">
                        <option hidden>--CHOIX--</option>
                        <?php foreach ($typeaction as $value) : ?>
                            <option value="<?= $value->id ?>"><?= $value->nom_action ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $(".select1").on('change', function() {
                        var code = $(".select1 option:selected").text();
                        var nom_sous_tache = $(".select2 option:selected").text();
                        $.post(base_url + 'Accueil/completeTache', {
                            code: code,
                            nom_sous_tache: nom_sous_tache
                        }, function(data) {
                            $('.select2').empty().append(data);
                        });
                    });
                    $('.valid').on('click', function(e) {
                        e.preventDefault();
                        //$('.recherche').slideUp();
                        var codeclient = $('.clientkoty').text().trim();
                        var pageUsers = $('.pageUsers option:selected').val();
                        localStorage.setItem('pagetext', $('.pageUsers option:selected').text());
                        localStorage.setItem('produitUsers', 'PRO021');
                        localStorage.setItem('tache', $('.select1 option:selected').text());
                        localStorage.setItem('codeclient', codeclient);
                        localStorage.setItem('pageUsers', pageUsers);
                        var koty = $('.koty').text();
                        $('#modaltache').modal('toggle');
                        window.location.href =   base_url + 'Tsena_koty/Taches/Discussion/'+codeclient;
                    
                       
                    });



                });
            </script>