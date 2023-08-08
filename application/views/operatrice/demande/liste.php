<div class="col-md-12">

    <form class="form-inline pull-right" method="post" action="<?=base_url("operatrice/listeDemandeEnvoyer")?>">

             <input type="date" class="form-control form-control-sm" name="date" id="input-date">

             <button type="submit" class="btn btn-primary mb-2">valider</button>

    </form>

</div>

<div class="col-md-12 vide_com">

<hr style="margin-top:20px;margin-bottom: 25px;border: solid 1px gray; ">

</div>

<div class="col-md-12 vide_com">

            <table class="table dataTable table-striped table-advance table-hover" id="tableau" >

              <thead class="bg-primary">

                <tr class="text-white">

                    <th style="color: #fff;">Id</th>

                    <th style="color: #fff;">Date</th>

                    <th style="color: #fff;">Nom</th>

                    <th style="color: #fff;">Facebook</th>

                    <th style="color: #fff;">Compte</th>

                    <th style="color: #fff;">Statut</th>

                  </tr>

              </thead>

                <tbody class="tbody">  

                    <?php foreach ($data as $key => $data):?>

                        <tr>

                            <th><?=$data->Id?></th>

                            <th><?=$data->Date?></th>

                            <th><?=$data->NomEtPrenom?></th>

                             <th><a href="<?=$data->Lien?>" target="_blank"><i class="fa fa-facebook"></i></a></th>

                            <th><?=$data->Nom_page?></th>

                            <th><?=$data->Statut?></th>

                        </tr>    

                    <?php endforeach ?>

                </tbody>

              </table>  

            </div>

            

            <hr/> <br/>  

         <a href=""  class="btn btn-success print pull-right" style="margin-left:25px">Exporter</a>

                    

 

