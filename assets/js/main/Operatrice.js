$('document').ready(function(){
  $('.menu-list > a').on('click',function(e){;
    chargement();
       e.preventDefault();
       var page = $(this).attr('href');
       $('.menu-items').removeClass('active');
       $(this).parent().addClass('active');
       $.post(base_url+"operatrice/page",{page:page},function(data){
            $('.main').empty().append(data);
            if(page=="Etat_de_vente"){
            	closeDialog();
            	etatDeVente();
            }else{
            	closeDialog();
            }
            
       });
         
   });






function alertMessage(title,message,icons,btn){
    swal(title,message, {
        icon : icons,
        buttons: {        			
            confirm: {
                className : btn
                     }
                },
        });

}

  function chargement(){
  var htmls='<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
  $.dialog({
    "title": "",
    "content": htmls,
    "show": true,
    "modal": true,
    "close": false,
    "closeOnMaskClick": false,
    "closeOnEscape": false,
    "dynamic": false,
    "height": 150,
    "fixedDimensions": true
  });   
    
    
  }
  function closeDialog(){
   $('.jconfirm').remove();
  }
  
	
  function etatDeVente(){
  	 var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                     lang: 'fr',
                   eventSources: [""],
                    navLinks: true,
                    selectable: true,
                    selectHelper: true,
    
    
                    dayClick: function(date) {
              
             var formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
    
                    window.location.replace('calendrier/'+formatted_date);
    
                   },
    
    
                    select: function(start, end) {
                
                    },
                    eventClick: function(event, element) {

                    },
                    editable: true,
    
                    eventLimit: true
    
                });
    
                $('#save-event').on('click', function() {
                    var title = $('#title').val();
                    if (title) {
                        var eventData = {
                            title: title,
                            start: $('#starts-at').val(),
                            end: $('#ends-at').val()
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); 
                    }
                    $('#calendar').fullCalendar('unselect');
                    $('.modal').find('input').val('');
                    $('.modal').modal('hide');
                });

  }

});