<div class="container">
   <div class="row">
      <form method="post" action="<?= base_url("controlleur/acceuil") ?>">
         <div class="form-row">
            <div class="col-md-4">
               <input type="date" class="form-control dateAutre " value="Y-m-d" name="date">
            </div>
            <div class="col-md-4">
               <button type="submit" class="btn btn-success but" style="width:100%"> valider</button>
            </div>


         </div>

      </form>


      <style>
         @media(max-width :750.98px) {
            .card {
               display: none;
            }

            .dateAutre {
               width: 310px;
            }

            .but {
               width: 70px;
               margin-left: 320px;
               margin-top: -58px;
            }

            .badge {
               width: 340px;
               background: #01579B;

            }

            .badg {
               width: 300px;
               font-size: 11px;
               background: blue;
            }

            .badge1 {
               width: 340px;
               background: #0277BD;
            }

            .badge2 {
               width: 340px;
               background: #0288D1;
            }

            .badge3 {
               width: 340px;
               background: #039BE5;
            }

            .badge4 {
               width: 340px;
               background: #03A9F4;
            }

            .badge5 {
               width: 300px;
               background: #007bff;
            }

            .badge6 {
               width: 300px;
               background: #5cb85c;
            }

            .badge7 {
               width: 300px;
               font-size: 11px;
               background: #d9534f;
            }

            .badge8 {
               width: 300px;
               font-size: 11px;
               background: #aa66cc;
            }

            .badge9 {
               width: 300px;
               font-size: 11px;
               background: orange;
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
               margin-top: 20px;

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

            .table1 {
               display: grid;
               left: 0;
               top: 0;
            }

            .response {
               display: grid;
            }

            .page-header {
               display: none;
            }



         }

         @media(min-width:751.98px) {
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
               font-size: 9px;
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


      <span class="date_collapse collapse"> <?php echo $date; ?></span>
      <!---------------    N a v  t a b s  c o l l a p s <em></em>----------------------------------->
      <div class="col-12 m-0 p-0">
         <ul class="nav nav-pills mb-3 nav1" id="pills-tab" role="tablist">
            <li class="nav-item">
               <a class="nav-link col-md-8" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">ETAT JOURNALIER</a>
            </li>
            <li class="nav-item">
               <a class="nav-link col-md-8" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">ETAT MENSUEL</a>
            </li>
            <li class="nav-item">
               <a class="nav-link col-md-8" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">PERFORMANCE</a>
            </li>
         </ul>
      </div>
      <div class="tab-content content1" id="pills-tabContent">
         <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="container">

               <div class="col-12 m-0 p-0">
                  <div class="panel-group" id="accordion">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <H6 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                 Chiffre d'affaire du :&nbsp <?php echo $date ?>
                              </a>
                           </H6>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                           <div class="panel-body in">
                              <?php

                              $cajour = [
                                 'data' => $cajour
                              ];
                              $this->load->view("Controlleur/response/ca_journalier", $cajour) ?>
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <H6 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                 Discussion journalière du <?php echo $date ?>
                              </a>
                           </H6>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                           <div class="panel-body">
                              <?php

                              $discussion = [
                                 'data' => $discussion
                              ];
                              $this->load->view("Controlleur/response/discussion_jour", $discussion) ?>
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <H6 class="panel-title">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                 Etat de vente du <?php echo $date ?>
                              </a>
                           </H6>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                           <div class="panel-body">
                              <?php
                              $etatvente = [

                                 'data' => $etatvente,

                              ];

                              $this->load->view("Controlleur/response/etat_vente", $etatvente) ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <?php
            $mensuel = [
               'data' => $mensuel
            ];

            $this->load->view("Controlleur/mensuel", $mensuel); ?>
         </div>
         <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <?php
            $datas = [
               'data' => $datas
            ];
            $this->load->view("Controlleur/perfo", $datas); ?>
         </div>
      </div>
   </div>
</div>