<div class="collapse">
   <input type="date" class="form-control dateRecap" value="" name="date">
</div>

<div class="row">
   <form method="post" action="<?= base_url("controlleur/performance") ?>">
      <div class="form-row">
         <div class="col-md-4">
            <input type="date" class="form-control dateAutre1" value="<?php echo $entete['date1'] ?>" name="dateAutre1">
         </div>

         <div class="col-md-4">
            <input type="date" class="form-control dateAutre2" value="<?php echo $entete['date2'] ?>" name="dateAutre2">
         </div>
         <div class="col-md-4">
            <button type="submit" class="btn btn-success" style="width:100%"> valider</button>
         </div>


      </div>

   </form>
</div>

<style>
   .card {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 60px;
      margin-left: 2px !important;
      padding-top: 15px;
      font-size: 15px;

   }

   .carda {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 60px;
      padding-top: 15px;
      font-size: 15px;

   }

   .entent {
      padding-left: 140px;


   }

   .card a {
      text-decoration: none;
      color: #fff;

   }

   .table {
      background-color: #fff;
      margin: 0;
   }

   .chart {
      background-color: #fff;

   }
</style>
<span class="date_collapse collapse"> <?php if ($mois == "") {
                                          $mois = date('Y-m');
                                       }
                                       echo $mois; ?></span>
<div class="form-row text-center entent" style="margin-top:10px; margin-left:110px">
   <div class="form-group col-md-3 carda">
      Total publications<br>
      <?= number_format($entete['totalpublication']) ?>
   </div>
   <div class="form-group col-md-2 card">
      Total clients<br>
      <?= number_format($entete['totaLclient']) ?>
   </div>
   <div class="form-group col-md-2 card">
      Total réponses<br>
      <?= number_format($entete['reponse']) ?>
   </div>
   <div class="form-group col-md-2 card">
      Produits vendus<br>
      <a href="#" class='lien'><?= number_format($entete['NBProduit']) ?></a>
   </div>
</div>
<div class="form-group contentTable">

   <table class="table table-light dataTable table-hover">
      <thead class="thead-light">
         <tr>
            <th class="collapse"></th>
            <th>OPLG</th>
            <th>NOM OPLG</th>
            <th>NOM DE LA PAGE</th>
            <th>NOMBRE DE PUBLICATIONS</th>
            <th>NOMBRE DE CLIENTS</th>
            <th>NOMBRE DE REPONSES</th>
            <th>NOMBRE DE PRODUITS VENDUS</th>

         </tr>
      </thead>
      <tbody class="tbody">
         <?= $data ?>
      </tbody>
   </table>
</div>