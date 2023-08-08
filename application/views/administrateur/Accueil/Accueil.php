<style>
   @media(max-width :750.98px) {
      .card {
         display: none;
      }

      .but {
         display: none;
      }

      .dateAutre {
         display: none;

      }

      .ff {
         display: none;
      }

      .card2 {
         display: none;
      }

      .card3 {
         display: none;
      }

      .previ {
         display: none;
      }

      .card4 {
         display: none;
      }

      .carda {
         display: none;
      }

      .table {
         display: none;
      }

      .num {
         display: none;
      }

      .moda {
         display: none;
      }

      .container {
         display: grid;
         font-size: 8px;

      }

      .nav1 {
         display: flex;
         margin: 0 auto;
         font-size: 10px;
         margin-left: 30px;
         width: 100%;

      }

      .content1 {
         display: grid;
         margin-top: 5px;

      }

      .panel-heading .accordion-toggle:after {
         /* symbol for "opening" panels */
         font-family: 'Glyphicons Halflings';
         /* essential for enabling glyphicon */
         content: "\e114";
         /* adjust as needed, taken from bootstrap.css */
         float: right;
         /* adjust as needed */
         color: grey;
         /* adjust as needed */
      }

      .panel-heading .accordion-toggle.collapsed:after {
         /* symbol for "collapsed" panels */
         content: "\e080";
         /* adjust as needed, taken from bootstrap.css */
      }

      .tabl {
         width: 20px;
         font-size: 10px;
      }

      .table1 {
         display: grid;
      }

      .response {
         display: grid;

      }



   }

   @media(min-width:750.98px) {
      .container-fluid {
         display: none;
         margin-left: -150px;
      }

      .nav1 {
         display: none;
      }

      .content1 {
         display: none;
      }

      .table1 {
         display: none;

      }

      .response {
         display: none;
      }

   }

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

   .moda {
      width: 100%;
      margin-top:
   }

   .card2 {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 30px;
      margin-left: 2px !important;
      padding-top: 7px;
      font-size: 15px;
   }

   .card3 {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 30px;
      margin-left: 2px !important;
      padding-top: 5px;
      font: red;
      font-size: 15px;
      margin-top: -13px;
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

   .card4 {
      background-color: #33b5e5;
      color: #fff;
      border-radius: 5px;
      width: 150px;
      height: 60px;
      padding-top: 15px;
      font-size: 15px;

   }

   .entent {
      padding-left: 135px;


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

   .previ {
      margin-top: -111px;
      margin-left: 300px
   }
</style>
<div class="row">
   <form method="post" action="<?= base_url("controlleur") ?>">
      <div class="form-row">
         <div class="col-md-8">
            <input type="date" class="form-control dateAutre" style="padding:0px" value="Y-m-d" name="date">
         </div>
         <div class="col-md-4">
            <button type="submit" class="btn btn-success but" style="width:100%"> valider</button>
         </div>
      </div>
   </form>
</div>


<div class="container">
   <span class="date_collapse collapse"> <?php if ($date == "") {
                                             $date = date('Y-m-d');
                                          }
                                          echo $date; ?></span>
   <div class="form-row text-center entent" style="margin-top:10px">
      <div class="form-group col-md-2 carda">
         Total publications<br><?= number_format($entete['totalpublication']) ?>
      </div>
      <div class="form-group col-md-2 card">
         Total clients<br><?= number_format($entete['totaLclient']) ?>
      </div>
      <div class="form-group col-md-2 card">
         Total réponses<br><?= number_format($entete['reponse']) ?>
      </div>
      <div class="form-group col-md-2 card">
         Total CA<br> <a href="#"><?= number_format($entete['ca'], 2, ',', ' ') ?>&nbsp;Ar</a>
      </div>
      <div class="form-group col-md-2 card">
         Produits vendus<br><a href="#" class='linka liste_produit'><?= number_format($entete['NBProduit']) ?></a>
      </div>
      <div class="form-group col-md-2 card">
         <a href="<?php echo site_url('controlleur/etat_vente/' . $date) ?>">Etat de vente du: </br><?php echo $date ?></a>
      </div>

      <div class="form-group col-md-4  previ">PREVISION DU: <?php echo $date ?>
      </div>
   </div>

   <div class="row mt-2 ff">
      <div class="col-md-12">
         <hr style="border:solid 1px #ccc">
         <table class="table table-light dataTable table-hover table-bordered table_rapport">
            <thead class="thead-light">
               <tr>
                  <th class="collapse"></th>
                  <th>OPLG</th>
                  <th>NOM OPLG</th>
                  <th>NOMBRE DE PRODUITS VENDUS</th>
                  <th>NOMBRE DE DISCUSSIONS CONCLUES</th>
               </tr>
            </thead>
            <tbody class="tbody">
               <?= $data ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<button type="button" class="btn btn-primary btn-lg active center-block response"><a href="<?php echo site_url('controlleur/acceuil') ?>">Entrer sur controleur</a></button>