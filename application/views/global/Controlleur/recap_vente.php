<div class="row">



<div class="form-row text-center entent" style="margin-top:10px">
   <div class="form-group col-md-3 card">
      Total clients<br>
      <?=number_format($entete['totaLclient'])?>
   </div>
   <div class="form-group col-md-3 card">
      Total réponses<br>
      <?=number_format($entete['reponse'])?>
   </div>
   <div class="form-group col-md-3 card">
      Total chiffre d'affaires<br>
     <a href="#"><?=number_format($entete['ca'], 2, ',', ' ')?>&nbsp;Ar</a>
   </div>
   <div class="form-group col-md-3 card bg-dark" style="margin_left=250px">
      Produits vendus<br>
      <?=number_format($entete['NBProduit'])?>
   </div>
</div>

<div class="form-group contentTable">

      <table class="table table-light dataTable table-hover table_rapport">
            <thead class="thead-light">
                <tr>
                    <th>OPLG</th>
                    <th>NOM OPLG</th>
                    <th>NOM DE LA PAGE</th>
                    <th>NOMBRE DE PUBLICATION/PARTAGE</th>
                    <th>NOMBRE DE CLIENTS</th>
                    <th>NOMBRE DE REPONSES</th>
                    <th>CHIFFRE D'AFFAIRES</th>
                    <th>NOMBRE DE PRODUITS VENDUS</th>
                    <th>NOMBRE DE DISCUSSIONS CONCLUES</th>
                                       
                </tr>
            </thead>
            <tbody class="tbody">
                <?=$data?>
            </tbody>
        </table> 
   </div>    

