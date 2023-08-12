$(document).ready(function(){
     liste();
     listesoincapi();
     listehygiennecorporelle();
     listehygienbucodentaire();
     listebeaute();
     listelessive();
     listesoinvisage();
     listeboisson();
        function liste (){
          $.post('fonction/fonctionlisteproduitdeoparfun.php',function(data){
            $('.listeproduitdeopar').empty().append(data); 
          });
        }
         function listesoincapi (){
          $.post('fonction/fonctionlisteproduitsoincapilaire.php',function(data){
            $('.listeproduitsoincapilaire').empty().append(data); 
          });
            var statut='Annule';
            $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.ann').empty().append(data); });
            
        }
         function listehygiennecorporelle (){
          $.post('fonction/fonctionlistproduithygiennecorporelle.php',function(data){
            $('.listeproduithygiennecorporelle').empty().append(data); 
          });
           var statut='livre';
          $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.LV').empty().append(data); });
        }
         function listehygienbucodentaire (){
          $.post('fonction/fonctionlisteproduithygiennebucodentaire.php',function(data){
            $('.listeproduithygiennebucodentaire').empty().append(data); 
          });
        }
         function listebeaute (){
          $.post('fonction/fonctionlisteproduitbeaute.php',function(data){
            $('.listeproduitbeaute').empty().append(data); 
          });
          $.post('fonction/fonctionProduitConf.php',function(data){
            $('.PL').empty().append(data); 
          });
        }
        function listelessive (){
          $.post('fonction/fonctionlisteproduitlessive.php',function(data){
            $('.listeproduitlessive').empty().append(data); 
          });
          var statut='on_attente';
            $.post('fonction/fonctionModT.php',{statut:statut},function(data){
            $('.ETDC').empty().append(data); });
         
        }
        function listesoinvisage (){
          $.post('fonction/fonctionlisteproduitsoinvisage.php',function(data){
            $('.listesoinvisage').empty().append(data); 
          });
        }
        function listeboisson (){
          $.post('fonction/fonctionlisteproduitboisson.php',function(data){
            $('.listeboisson').empty().append(data); 
          });
        }




       test();
        function test(){

$.post('fonction/fonctionlistemodal.php',{},function(data){
            $('.PRV').empty().append(data); 
          });
} 

var data1=<?php echo "[".$COM["AUTRES"].",".$COM["BEAUTE"].",".$COM["BOISSON"]. ",".$COM["DEO & PARFUM"].",".$COM["HYGIENE BUCO-DENTAIRE"].",".$COM["HYGIENE CORPORELLE"].",".$COM["LESSIVE"].",".$COM["SOINS CAPILLAIRE"].",".$COM["SOINS VISAGE"
]."]";?>;
var label1=<?php echo $lab;?>;
var ctx = document.getElementById('fammile');
 ctx.height = 170;
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: label1,
        datasets: [{
            label: '# of Votes',
            data: data1,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
                
            ],
            borderWidth: 1
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

var $data2="";
var ctx = document.getElementById('zone');
ctx.height = 170;
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: $data2,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
                
            ],
            borderWidth: 1
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
   /*/ $('canvas').remove();
    $('.item2').prepend('<canvas id="ca" height="80">Hello</canvas>');
    $('.item1').prepend('<canvas id="bar-chart-sample" height="80"></canvas>');*/
var data=[<?php echo $Annul;?>,<?php echo $livr;?>,50;    
var ctx = document.getElementById('ca');
 ctx.height = 170;
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Produit non livrés', 'Produit Livrés ', 'Produit Commandés '],
        datasets: [{
            label: '# of Votes',
            data: data,
            backgroundColor: [
                '#e30832',
                '#00a65a',
                '#03a5cc'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
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

