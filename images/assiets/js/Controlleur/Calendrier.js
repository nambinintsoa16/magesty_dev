$(document).ready(function() {
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
            eventSources: ["calendrier_de_livraisons_controlleur/pre","calendrier_de_livraisons_controlleur/ann", "calendrier_de_livraisons_controlleur/pla", "calendrier_de_livraisons_controlleur/liv", "calendrier_de_livraisons_controlleur/etdc"],
            navLinks: true,
            selectable: true,
            selectHelper: true,


            dayClick: function(date) {
      
     var formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()

            window.location.replace('detail_calendrier/'+formatted_date);

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
    });