
<style type="text/css">
  .donut-inner {
   margin-top: -100px;
   margin-bottom: 100px;
   margin-left: 210px;
}
.donut-inner h5 {

   margin-top: 0;
}
.donut-inner span {
   font-size: 12px;
}
</style>
	<div id="user-profile-2" class="user-profile">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-18">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Profile
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#feed">
                        <i class="blue ace-icon fa fa-info bigger-120"></i>
                        Detail
                    </a>
                </li>
            </ul>

            <div class="tab-content no-border padding-24">
                <div id="home" class="tab-pane in active">
                    <div class="row">
                           <div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
        
                <div>
                   <img class="editable img-responsive" alt="" id="avatar2" src="#">
                </div>
            
                <div class="profile-usertitle">
                    <div  class="profile-userpic">
                     <img src="../img/QRcode/.png" class="img-thumbnail" style="width:60px;">
                    </div>
                </div>
                
                <div class="profile-userbuttons">
               <a href="#" class="btn btn-sm btn-block btn-primary">
                        
                                <span class="bigger-110">Blue</span>
                    
                            </a>     
                   
                </div>
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                 <div class="col-xs-12 col-sm-9">
                            <h4 class="blue">
                                <span class="middle"></span>
                             
                            </h4>
              <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Nom sur facebook </div>

                                    <div class="profile-info-value">
                                        <span><?=$Infoclient->Nom." ".$Infoclient->Prenom?></span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Localisation </div>

                                    <div class="profile-info-value">
                                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                                        <span><?=$Infoclient->ville?></span>
                                        <span><?=$Infoclient->Quartier?></span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name">Age </div>

                                    <div class="profile-info-value">
                                        <span>&nbsp;<?=$Infoclient->trancedage?> ans</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name">Sexe</div>

                                    <div class="profile-info-value">
                                        <span><?=$Infoclient->Sexe?></span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Enregistre le  </div>

                                    <div class="profile-info-value">
                                        <span><?=$Infoclient->datedenregistrement?>
                                      </span>
                                    </div>
                                </div>

                                 <div class="profile-info-row">
                                    <div class="profile-info-name"> situation matrimoniale </div>

                                    <div class="profile-info-value">
                                        <span>
                                        <?=$Infoclient->SituationMatrimonial?>
                                       </span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> Cadre socio-professionnel </div>

                                    <div class="profile-info-value">
                                        <span><?=$Infoclient->occupation?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-8 dotted"></div>

                            <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name">
                                        <i class="middle ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                    </div>

                                    <div class="profile-info-value">
                                         <a href="<?=$Infoclient->lien_facebook?>">facebook</a>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name">
                                        <i class="middle ace-icon fa fa-phone-square bigger-150 green"></i>
                                    </div>

                                    <div class="profile-info-value">
                                    <?=$Infoclient->Contact?>
                                    </div>
                                </div>
                   </div>
            </div>
        </div>
    </div>
</div>
                        </div>
                    </div>

                    
                </div>

                <div id="feed" class="tab-pane" >
                    <div class="profile-feed row"> 



<div class="row" style="background:white">
          <div class="col-lg-7 col-md-12">

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-map-marker red"></i><strong>Statistique</strong></h2>
              </div>
              <div class="panel-body-map">
                  <canvas class="lineChart " id="lineChart"></canvas>
                 
              </div>

            </div>
          </div>
       
          <div class="col-md-5" style="height: 210px; padding-top:5px;text-decoration:underline">
          <i class="fa fa-map-marker green"></i> Fiabilité du Client
              <canvas class="doughnut"  id="doughnut" style="padding-bottom: 10px;"></canvas>
              <div class="donut-inner" style="position: absolute;margin-bottom: 50px;margin-top: -80px;position: absolute;margin-left:193px;text-transform: bold">         
                    <h5 class="data" style="font-size:30px;"> %</h5>
               
             </div>

          </div>
          
          <div class="col-md-5" style="height: 200px;margin-top: -50px;">
          <i class="fa fa-map-marker green"></i> Tendances d'achat
              <canvas class="doughnut"  id="singelBarChart"></canvas>
              
          </div>
        
        </div>


        <!-- Today status end -->



        <div class="row">

          <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><i class="fa fa-flag-o red"></i><strong>Produit achéte</strong></h2>
              </div>
              <div class="panel-body">
                <table class="table dataTable">
                  <thead>
                    <tr>
                      <th style="text-align: center">Aperçu</th>
                      <th style="text-align: center">Produit</th>
                      <th style="text-align: center">Quantite</th>
                      <th style="text-align: center">Total</th>
                      <th style="text-align: center">Date de commande</th>
                      <th style="text-align: center">Statut</th>
                      <th>Info</th>
                    </tr>
                  </thead>
                  <tbody>

      
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
     </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
  $(document).ready(function(){
    chart()
  

   
    //line chart
function chart(){  
  var data= [ ];
    var  labels=[];
    var datasets=[
                {
                    
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    data: data
                            }
                        ];  
    var ctx = document.getElementById( "lineChart" );
    ctx.height = 140;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets:datasets
        },
        options: {
          legend: {
            display: false
            },
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    } );
     //doughut chart
    $('.data').empty().append("");
    var ctx = document.getElementById( "doughnut" );
    ctx.height = 80;
    var data=[];
    var myChart = new Chart( ctx, {
        type: 'doughnut',
        data: {
          labels:['livrées','Annulées'],
            datasets: [ {
                data:data,
                backgroundColor:['#3ec556','#ff0000'],   
                          }             
   ]

        },
         options: {
        legend: {
            display: false
            
        },
        cutoutPercentage: 80
    },

    elements: {
      center: {
      text: '',
      color: '#000', 
      fontStyle: 'arial', 
      sidePadding: 5 
    }
  }
    } );


      var ctx = document.getElementById("singelBarChart");
    ctx.height = 140;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "AUT","BEA","BOI","DEO&PAR","HBD","HC","LES","SC","SV"],
            datasets: [
                {
                    data:"",
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                            }
                        ]
        },
        options: {
             legend: {
             display: false
              }
           }
    } );
    } 


    

  });
</script>
                     
                  
