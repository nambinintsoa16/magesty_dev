<div class="row">
   <form method="post" action="<?= base_url("controlleur/etat_mensuel") ?>">
      <div class="form-row">
         <div class="col-md-4">
            <input type="date" class="form-control dateAutre1" value="Y-m-d" name="dateAutre1">
         </div>
         <div class="col-md-4">
            <input type="date" class="form-control dateAutre2" value="Y-m-d" name="dateAutre2">
         </div>
         <div class="col-md-4">
            <button type="submit" class="btn btn-success" style="width:100%"> valider</button>
         </div>


      </div>

   </form>
</div>
<div class="form-group col-md-2 " style="margin-top:-28px;margin-left:210px"><b><?php echo $entete['date1'] ?></div></b>
<div class="form-group col-md-2 " style="margin-top:-34px;margin-left:580px"><b><?php echo $entete['date2'] ?></div></b>
<style>
   .card {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 60px;
      margin-left: 2px !important;
      padding-top: 15px;
      font-size: 12px;

   }

   .carda {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 60px;
      padding-top: 15px;
      font-size: 12px;

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
<div class="form-row text-center entent" style="margin-top:10px">
   <div class="form-group col-md-3 carda" style="margin-left:-50px">
      TOTAL CA GLOBALE<br>
      <?= number_format($entete['ca'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      TOTAL CA VB <br>
      <?= number_format($entete['CA_VB'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      TOTAL CA VB LIVRE<br>
      <?= number_format($entete['CA_VBL'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      Total CA VP<br>
      <?= number_format($entete['cavpt'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      TOTAL CA VP LIVRE<br>
      <?= number_format($entete['cavpL'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      TOTAL RATIO<br>
      <a href="#" class='linka'><?= number_format((($entete['CA_VBL']) * 100 / $entete['CA_VB']), 2, ',', ' ') ?>%</a>
   </div>
</div>
<div class="form-group contentTable">

   <table class="table table-light dataTable table-hover ">
      <thead class="thead-light">
         <tr>
            <th>OPLG</th>
            <th class="text-center" style="width:150px">NOM OPLG</th>
            <th class="text-center" style="width:150px">PAGE</th>
            <th class="text-center" style="width:100px">CA GLOBALE</th>
            <th class="text-center" style="width:100px">CA VB</th>
            <th class="text-center" style="width:100px">CA VB LIVRE </th>
            <th class="text-center" style="width:100px">CA VP</th>
            <th class="text-center" style="width:100px">CA VP LIVRE</th>
            <th>RATIO FB</th>
         </tr>
      </thead>
      <tbody class="tbody">
         <?= $data ?>
      </tbody>
   </table>
</div>

<!-- <div class="collapse">
      <input type="date" class="form-control dateRecap" value="" name="date">
   </div>  
  
   <div class="row">
<form method="post" action="<?= base_url("controlleur/etat_mensuel") ?>">
<div class="form-row" >
   <div class="col-md-4">
      <input type="date" class="form-control" value="Y-m-d" name="dateAutre1">
   </div>
   <div class="col-md-4">
      <input type="date" class="form-control" value="Y-m-d" name="dateAutre2">
   </div>
   <div class="col-md-4">
     <button type="submit" class="btn btn-success" style="width:100%"> valider</button>
   </div>
  
 
</div>

</form>
</div>

<style>
 .card{
    background-color:#33b5e5;
    color:#fff;
    border-radius:5px;
    width: 150px;
    height: 60px;
    margin-left:2px!important;
    padding-top: 15px;
    font-size:15px;

 }
 .carda{
    background-color:#33b5e5;
    color:#fff;
    border-radius:5px;
    width: 150px;
    height: 60px;
    padding-top: 15px;
    font-size:15px;

 }
 .entent{
   padding-left:140px;


 }
.card a{
    text-decoration: none;
    color:#fff;

 } 
.table{
   background-color:#fff;
   margin:0;
}
.chart{
   background-color:#fff;
  
}
</style>
<span class="date_collapse collapse"> <?php if ($mois == "") {
                                          $mois = date('Y-m');
                                       }
                                       echo $mois; ?></span>
<div class="form-row text-center entent" style="margin-top:10px">
<div class="form-group col-md-3 carda" style="margin-left:-140px">
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
      Total CA<br>
     <?= number_format($entete['ca'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      Total CAL<br>
     <?= number_format($entete['cal'], 0, ',', ' ') ?>
   </div>
   <div class="form-group col-md-2 card">
      Produits vendus<br>
     <a href="#" class='linka liste_produit'><?= number_format($entete['NBProduit']) ?></a>
   </div>
   <div class="form-group col-md-2 card">
      Total ratio<br>
      <a href="#" class='linka liste_produit'><?= number_format((($entete['cal']) * 100 / $entete['ca']), 2, ',', ' ') ?>%</a>
   </div>
   </div>
 <div class="form-group contentTable">

      <table class="table table-light dataTable table-hover">
            <thead class="thead-light">
                <tr>
                    <th>OPLG</th>
                    <th>NOM OPLG</th>
                    <th style="width:150px">PAGE</th>
                    <th>NBR DE PUB</th>
                    <th>NBR DE CLT</th>
                    <th>NBR DE REP</th>
                    <th>CHIFFRE D'AFFAIRES</th>
                    <th style="width:100px">CA LIVRE</th>
                    <th>PROD VENDUS</th>
                    <th>CONCLUES</th>
                    <th>RATIO</th>                   
                </tr>
            </thead>
            <tbody class="tbody">
                <?= $data ?>
            </tbody>
        </table> 
   </div>
   <div class="collapse">
      <input type="date" class="form-control dateRecap" value="" name="date">
   </div> -->