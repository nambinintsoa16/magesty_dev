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
        locale: 'fr',
        eventSources: [base_url + "operatrice/calendrier_de_livraison/pre", base_url + "operatrice/calendrier_de_livraison/ann", base_url + "operatrice/calendrier_de_livraison/pla", base_url + "operatrice/calendrier_de_livraison/liv", base_url + "operatrice/calendrier_de_livraison/etdc"],
        navLinks: true,
        selectable: true,
        selectHelper: true,


        dayClick: function(date) {

            var formatted_date = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear()
            window.location.replace(base_url + "Appel_telephonique/Etat_de_ventes/calendrier/" + formatted_date);

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