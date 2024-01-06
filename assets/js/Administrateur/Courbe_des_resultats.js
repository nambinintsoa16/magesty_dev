$(document).ready(function(){

const ctx = document.getElementById('circles-1');

 var char_enquette = new Chart(ctx, {
    type: 'doughnut',
    data: {
    //  labels: ['Tena Afa-po tanteraka', 'Tena Afa-po', 'Afa-po','Tsy Afa-po','Tena tsy Afa-po mihitsy'],
      datasets: [{
        label: '5',
        //data: [40, 19, 3,20,5],
       backgroundColor: [
		      '#64DD17',
		      '#33691E',
		      '#00B0FF',
		      '#ffc000',
		      '#01579B',
		      '#64DD17',
		      '#33691E',
		      '#00B0FF',
		      '#ffc000',
		      '#01579B'
		    ],
        borderWidth: 0
      }]
    },
    options: {
      legend: {
               display: false
                            
             },
      cutoutPercentage: 70,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
        elements: {
           center: {
             text: '',
             color: '#000', 
             fontStyle: 'arial', 
             sidePadding: 5 
        }
    }
  });
 var textCtx = $("#text").get(0).getContext("2d");
	textCtx.textAlign = "center";
	textCtx.textBaseline = "middle";
	textCtx.font = "30px sans-serif";
	textCtx.fillText("0%", 150, 150);
 $('#valider_selection').on('click',function(event){
 	event.preventDefault();
  let debut = $('#debut').val();
  let fin = $('#fin').val();
  let famille = $("#select-produit-famille option:selected").val();
 	let produit = $("#select-produit option:selected").val();
 	let question_select_text = $('#select-question option:selected').text();
 	let question_select_id = $('#select-question option:selected').val();
  


 	$('#title-question').empty().append(question_select_text);
 	$.post(base_url+"Administrateur/get_data_chart",{famille,debut,fin,produit,question_select_text,question_select_id},function(response){
 		if(response.error !='false'){
 			   char_enquette.data.labels = response.question_text;
  			 char_enquette.data.datasets[0].data = response.stat;
  			 textCtx.clearRect(0, 0, 250, 250);
  			 textCtx.fillText(response.number+"%", 150, 130);
         textCtx.fillText(response.message, 150, 160);
			 char_enquette.update();
			 let i = 0;
			 $("#question_containt").empty();
       $("#resultat_containt").empty().append(response.total);
			 for (const [key, value] of Object.entries(response.question)) {
			 	$("#question_containt").append(value)	
			  }
 		}
 	},'json');
 });
});