
<div class="row"> 

     <div class="col-md-12">
         <img src="<?=base_url("images/service_clientel/banniere-livraison.jpg")?>" alt="" width="100%" height="400px"
            style="object-fit: cover;margin-top:-16px!important;overflow: hidden;">
     </div>
</div>

        <div class="row">
            <div class="container d-flex" style="margin-top: -50px">
               <div class="col-md-3">
                  <div class="content" data-toggle="modal" data-target="#myModal" style="margin-left: 0px !important;background:#dc3545;border-top-left-radius: 5px;border-top-right-radius: 5px;cursor: pointer;">
                    <div class="bloc_annul1" style=";height:80px">
                        <p style="color:white;font-size: 16px;font-weight: bold;padding-top: 30px;padding-left: 10px; text-align: center; ">Générales</p>
                        <p  style="color:white;font-size: 24px;font-weight: bold;padding: 0px 10px"></p>
                    </div> 

                    <div class="more_info" style="height: 25px;background:#c6303e;top: 50px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;" >
                       <div style="color: white;text-align: center;padding-top: 2px">Découvrir</div>
                    </div>
                </div>
              </div>
               <div class="col-md-3">
                 <div class="content" data-toggle="modal" data-target="#myModal1" style="margin-left: 0px !important;background:#ffc107;border-top-left-radius: 5px;border-top-right-radius: 5px;cursor: pointer;">
                    <div class="bloc_annul1" style=";height:80px">
                         <p style="color:white;font-size: 16px;font-weight: bold;padding-top: 30px;padding-left: 10px; text-align: center; ">Nos Livreurs</p>
                        <p  style="color:white;font-size: 24px;font-weight: bold;padding: 0px 10px"> </p>
                    </div> 

                    <div class="more_info" style="height: 25px;background: #e5ad06;top: 50px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;" >
                        <div style="color: white;text-align: center;padding-top: 2px">Découvrir</div>
                    </div>
                </div>
            </div>
              <div class="col-md-3" style="">
                <div class="content" data-toggle="modal" data-target="#myModal2" style="margin-left: 0px !important;background:#17a2b8;border-top-left-radius: 5px;border-top-right-radius: 5px;cursor: pointer;">
                    <div class="bloc_annul1" style=";height:80px">
                        <p style="color:white;font-size: 15px;font-weight: bold;padding-top: 20px;padding-left: 10px; text-align: center;">Statistque d'annulation</p>
                        <p style="color:white;font-size: 24px;font-weight: bold;padding: 0px 10px"></p>

                    </div> 

                    <div class="more_info" style="height: 25px;background: #1592a5;top: 50px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;" >
                        <div style="color: white;text-align: center;padding-top: 2px">Découvrir</div>
                    </div>
                </div>
               
                
              </div>
             
              <div class="col-md-3">
                 <div class="content"  data-toggle="modal" data-target="#myModal3" style="margin-left: 0px !important;background:#28a745;border-top-left-radius: 5px;border-top-right-radius: 5px;cursor: pointer;">
                    <div class="bloc_annul1" style=";height:80px">
                        <p style="color:white;font-size: 16px;font-weight: bold;padding-top: 30px;padding-left: 10px; text-align: center; "> Relance</p>
                        <p  style="color:white;font-size: 24px;font-weight: bold;padding: 0px 10px"> </p>

                    </div> 

                    <div class="more_info" style="height: 25px;background: #24963e;top: 50px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;" >
                        <div style="color: white;text-align: center;padding-top: 2px">Découvrir</div>
                    </div>
                </div> 
            </div>
             
        </div>
        <div class="wrapper w-100">
        	<div class="row" >
        		<div class="col-md-12">
	            <div class="card card-lg mt-4" style="margin-right: 30px; margin-left: 30px">
	              <div class="card-header">
									<h4 class="modal-title">LISTE MOTIF D'ANNULATION</h4>
								</div>
	                <div class="card-body">
	                  <div class="responsive w-100" style="height: 460px; overflow: scroll;">
			                <table class="table table-bordered dataTable  w-100 text-center">
						            <thead class="bg-danger text-white">
						              <tr>
						                <th>NUMERO</th> 
						                <th>CODE D'ANNULATION</th>
						                <th>SIGNIFICATION</th>
						              </tr>
						            </thead>
						            <tbody>
						                <?php foreach($datas as $datas):?>
						              <tr>
                            <td><?= $datas->id?></td> 
						                <td><?= $datas->code_annul?></td>
						                <td><?= $datas->contenu?></td>       
						              </tr>
						                <?php endforeach;?> 
						            </tbody>
        							</table>
								</div>
	        		</div>	
	        </div>	
	     </div>			
     </div>
  </div>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="card card-lg">
                <div class="card-header">
                    <div class="card-body">
                        <hr>
                        <h4>STATISTIQUE DE LIVRAISON ANNULEES MENSUELLES  PAR CODE D'ANNULATION </h4>
                        <hr>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
</div>
      <!-- Modal annulée -->
      <div id="myModal" class="modal fade  " role="dialog">
        <div class="modal-dialog modal-lg d-flex" style="background:white;margin-top:20px">

          <!-- Modal content-->
          <div class="modal-content" style="background: white!important">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Liste des livraisons annulées</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-3 jour link" id="jounalier"> 
                      <div class="row" style="cursor:pointer;padding-left: 20px;padding-right: 20px">
	                         <div class="col-md-3" style="background: #33b5e5;height: 60px;padding-left: 5px;color:#fff;padding-top: 20px;font-weight: bold;border-bottom-left-radius:5px;border-top-left-radius:5px" ><i class="fa fa-edit" style="font-size:20px;" aria-hidden="true"></i></div>
	                      <div class="col-md-9" style="background-color:#0099CC!important;padding-top:20px;padding-left:10px;height: 60px;border-bottom-right-radius:5px;border-top-right-radius:5px;color: white;font-size: 14px; text-align: center;">JOURNALIERE
	                      </div>
                      </div>
                      
                    </div>
                     <div class="col-md-3 hebdo  link" style="padding-left: 10px" id="hebdo">
                        <div class="row" style="cursor:pointer;padding-left: 10px;padding-right: 10px">
                        <div class="col-md-3" style="background: #33b5e5;height: 60px;padding-left: 5px;color:#fff;padding-top: 20px;font-weight: bold;border-bottom-left-radius:5px;border-top-left-radius:5px" ><i class="fa fa-edit" style="font-size:20px;" aria-hidden="true"></i></div>
                      <div class="col-md-9" style="background-color:#f39c12!important;padding-top:15px;padding-left:15px;height: 60px;border-bottom-right-radius:5px;border-top-right-radius:5px;color: white;font-size: 14px; text-align: center;">HEBDOMADAIRE</div>
                      </div>
                     </div>

                      <div class="col-md-3 men  link" id="mensuel">
                         <div class="row" style="cursor:pointer;padding-left: 10px;padding-right: 10px">
                        <div class="col-md-3" style="background: #33b5e5;height: 60px;padding-left: 5px;color:#fff;padding-top: 20px;font-weight: bold;border-bottom-left-radius:5px;border-top-left-radius:5px" ><i class="fa fa-edit" style="font-size:20px;" aria-hidden="true"></i></div>
                      <div class="col-md-9" style="background-color:#00a65a!important;padding-top:15px;padding-left:15px;height: 60px;border-bottom-right-radius:5px;border-top-right-radius:5px;color: white;font-size: 14px">MENSUEL</div>
                      </div>
                      </div>
                       <div class="col-md- sem  link" id="semestriel">
                         <div class="row" style="cursor:pointer;padding-left: 25px;padding-right: 25px">
                        <div class="col-md-3" style="background: #33b5e5;height: 60px;padding-left: 5px;color:#fff;padding-top: 20px;font-weight: bold;border-bottom-left-radius:5px;border-top-left-radius:5px" ><i class="fa fa-edit" style="font-size:20px;" aria-hidden="true"></i></div>
                      <div class="col-md-9" style="background-color:#f56954!important;padding-top:15px;padding-left:15px;height: 60px;border-bottom-right-radius:5px;border-top-right-radius:5px;color: white;font-size: 14px">SEMESTRIEL</div>
                      </div>
                       </div>
                  </div>
                 
                  </div>

               <div class="row" style="background:white;margin-top:20px">
                <div class="col-lg-12" style="padding: 0px 30px">
                    <section class="listelivreAnnuleJ">
                      
                    </section>
                     
                </div>

              </div>

          </div>  
           
            <div class="modal-footer"  style="background:">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </div>

        </div>
      </div>

       <!-- Modal livreur -->
       <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header bg-warning">
                 <h4 class="modal-title" style="text-transform: uppercase;color:black;font-weight: bold">STATISTIQUES de livraisons annulées par LIVREUR</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
             
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="container">
                  <div class="col-md-6">
                      <canvas id="pie-chart2"></canvas>
                  </div>
                  <div class="col-md-6" id="">
                     <canvas id="myChart4"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </div>

        </div>
      </div>

       <!-- Modal livreur -->
       <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header bg-info">
             <h4 class="modal-title" style="text-transform: uppercase;color:black;font-weight: bold">STATISTIQUES de livraisons annulées par code d'annulation </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="container">
                  <div class="col-md-12">
                    <div class="col-md-6" style="margin-top:20px ">
                      <section class="panel listLivraisonEffectuée">
                          <canvas id="myChart3"></canvas>
                         
                      </section>
                    </div>
                <div class="col-md-6" style="margin-top:20px ">
                    <section class="panel listLivraisonEffectuée">
                         
                          <canvas id="pie-chart" width="800" height="450"></canvas>
                    </section>
                 </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </div>

        </div>
      </div>
      <div id="myModal3" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header bg-success">
             <h4 class="modal-title" style="text-transform: uppercase;color:black;font-weight: bold">Liste des livraisons annulées à relancer</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="container">
                  <div class="col-md-12">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
          </div>

        </div>
      </div> 
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo json_encode($labels);?>],
        datasets: [{
            label: 'Représentation graphique des livraison annulées selon code d annulation (Mensuel)',
            data: [<?php echo json_encode($data1);?>],
            backgroundColor: [
                '#ff4444',
                '#ffbb33',
                '#00C851',
                '#33b5e5',
                '#CC0000',
                '#FF8800',

                '#007E33',
                '#0099CC',
                '#2BBBAD',
                '#4285F4',
                '#aa66cc',
                
                '#00695c',
                '#aa66cc',
                '#aa66cc'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
             barWidth:10
        }]
    },
    options: {
        scales: {
           yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


const ctx1 = document.getElementById('myChart3').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo $labels;?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php echo $data1;?>],
            backgroundColor: [
 '#ff4444',
                '#ffbb33',
                '#00C851',
                '#33b5e5',
                '#CC0000',
                '#FF8800',

                '#007E33',
                '#0099CC',
                '#2BBBAD',
                '#4285F4',
                '#aa66cc',
                
                '#00695c',
                '#aa66cc',
                '#aa66cc',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
           barWidth:10
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

<!-- 
<script type="text/javascript"> 
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $labels;?>],
        datasets: [{
            label: 'Représentation graphique des livraison annulées selon code d annulation (Mensuel)', 
            data: [<?php echo $data1;?>],
            backgroundColor: [
 '#ff4444',
                '#ffbb33',
                '#00C851',
                '#33b5e5',
                '#CC0000',
                '#FF8800',

                '#007E33',
                '#0099CC',
                '#2BBBAD',
                '#4285F4',
                '#aa66cc',
                
                '#00695c',
                '#aa66cc',
                '#aa66cc',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
           barWidth:10
        }]
    },
    options: {
      
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
        
    }
});

var ctx1 = document.getElementById('myChart3').getContext('2d');
var myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: [<?php echo $labels;?>],
        datasets: [{
            label: 'Nombre', 
            data: [<?php echo $data1;?>],
            backgroundColor: [
                '#ff4444',
                '#ffbb33',
                '#00C851',
                '#33b5e5',
                '#CC0000',
                '#FF8800',

                '#007E33',
                '#0099CC',
                '#2BBBAD',
                '#4285F4',
                '#aa66cc',

                '#00695c',
                '#aa66cc',
                '#aa66cc',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
           barWidth:10
        }]
    },
    options: {
      
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
        
    }
});


var ctx2 = document.getElementById('myChart4').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: [<?php echo $labels1;?>],
        datasets: [{
            label: 'Nombre de livraison annulées', 
            data: [<?php echo $data11;?>],
            backgroundColor: [

                '#ff4444',
                '#ffbb33',
                '#00C851',
                '#33b5e5',
                '#CC0000',
                '#FF8800',
                '#007E33',
                '#aa66cc'
               
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1,
           barWidth:10
        }]
    },
    options: {
      
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
        
    }
});



 $(document).ready(function(){

          $.post('fonction/listelivreAnnuleJ.php',function(data){
            $('.listelivreAnnuleJ').empty().append(data); 
          });
        
        $('.jour').on('click',function(){
             $.post('fonction/listelivreAnnuleJ.php',function(data){
            $('.listelivreAnnuleJ').empty().append(data); 
          });
        });

      
        $('.hebdo').on('click',function(){
            $.post('fonction/listelivreAnnuleB.php',function(data){
            $('.listelivreAnnuleJ').empty().append(data); 
          });
        });


        $('.men').on('click',function(){
            $.post('fonction/listelivreAnnuleM.php',function(data){
            $('.listelivreAnnuleJ').empty().append(data); 
          });
        });

         $('.sem').on('click',function(){
            $.post('fonction/listelivreAnnuleS.php',function(data){
            $('.listelivreAnnuleJ').empty().append(data); 
          });
        });

var labelss=[<?php echo $labelss;?>];
var data=[<?php echo $data1;?>];
console.log(data);
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: labelss,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#ff4444", "#ffbb33","#00C851","#33b5e5","#CC0000","#FF8800", "#007E33","#0099CC","#2BBBAD","#4285F4","#aa66cc","#00695c"],
        data: data
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Représentation graphique de livraison annullée par code annulation'
      }
    }
});

var labels1=[<?php echo $labels1;?>];
var data11=[<?php echo $data11;?>];
console.log(data);

new Chart(document.getElementById("pie-chart2"), {
    type: 'pie',
    data: {
      labels: labels1,
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#ff4444", "#ffbb33","#00C851","#33b5e5","#CC0000","#FF8800", "#007E33","#0099CC","#2BBBAD","#4285F4","#aa66cc","#00695c"],
        data: data11
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Représentation graphique de livraison annullée par Livreurs'
      }
    }
});

      });
         
</script>
-->