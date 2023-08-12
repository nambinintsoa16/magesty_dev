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
    
                   eventSources: ["calendrier_de_livraison/pre","calendrier_de_livraison/ann", "calendrier_de_livraison/pla", "calendrier_de_livraison/liv", "calendrier_de_livraison/etdc"],
                    navLinks: true,
                    selectable: true,
                    selectHelper: true,
    
    
                    dayClick: function(date) {
                     /* $('.modal-title1').empty().append(date);*/
             var formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
    
                    window.location.replace('calendrier/detail_livraison/'+formatted_date);
    
                   },
    
    
                    select: function(start, end) {
                       /* $('.modal').modal('show');
                        var date=$('.modal-title1').html().split(":");
                        var date2=date[0].split(" ");
                        var dadefin=date2[2]+" "+date2[1]+ " "+date2[3]+" ";
                        $.post('fonction/foctionretourcalandar.php',{date:dadefin},function(data){
                           $('.data').empty().append(data);
                        });*/
    
    
                    },
                    eventClick: function(event, element) {
    
    
                       /*window.location.replace(livraisondetail.php);
                        //window.location.href=http://livraisondetail.php/;
                        // Display the modal and set the values to the event values.
                        //$('.modal').modal('show');
                       /* $('.modal').find('#title').val(event.title);
                        $('.modal').find('#starts-at').val(event.start);
                        $('.modal').find('#ends-at').val(event.end);*/
                    },
                    editable: true,
    
                    eventLimit: true // allow "more" link when too many events
    
                });
    
                // Bind the dates to datetimepicker.
                // You should pass the options you need
                //$("#starts-at, #ends-at").datetimepicker();
    
                // Whenever the user clicks on the "save" button om the dialog
                $('#save-event').on('click', function() {
                    var title = $('#title').val();
                    if (title) {
                        var eventData = {
                            title: title,
                            start: $('#starts-at').val(),
                            end: $('#ends-at').val()
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
    
                    // Clear modal inputs
                    $('.modal').find('input').val('');
    
                    // hide modal
                    $('.modal').modal('hide');
                });
            });