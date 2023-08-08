$(document).ready(function() {
    $('.client0007').on('click', function(e) {
        e.preventDefault();
       var parent = $(this).parent().parent();
        var codeclient = parent.children().first().text();
        var type = "";
        var date = $('.date_collapse').text();
        $.post(base_url + 'Operatrice/client_detail', { date: date, codeclient: codeclient, type: type }, function(data) {
            $.alert({
                title: codeclient + " / " + type,
                content: data,
                columnClass: 'col-md-10 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-10',
                type: 'blue',
                icon: 'fa fa-spinner fa-spin',

            });
        });

    });
});