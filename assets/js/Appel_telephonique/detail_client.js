$(document).ready(function() {

    const codeclient = $('.codeClient').text();


    $.post(base_url + 'Clients/dataFiabiliter', { codeclient: codeclient }, function(data) {
        $('.data').empty().append(data.total);
        var ctx = document.getElementById("doughnut");
        ctx.height = 100;
        var data = [data.livre, data.attente, data.annule];
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['livrées', 'En attente', 'Annulées'],
                datasets: [{
                    data: data,
                    borderColor: "rgba(0,0,0,0.1)",
                    backgroundColor: ['#3ec556', '#42A5F5', '#F44336'],
                }]
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
        });
    }, 'json');

    $.post(base_url + 'Clients/datalineDachat', { codeclient: codeclient }, function(data) {
        var datas = data.donne;
        var labels = data.date;
        var datasets = [{
            borderColor: "rgba(0,0,0,1)",
            borderWidth: "1",
            data: datas
        }];
        var ctx = document.getElementById("lineChart");
        ctx.height = 60;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
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
        });


    }, 'json');




    $.post(base_url + 'Clients/datalineDachatProduit', { codeclient: codeclient }, function(datas) {


        var ctx = document.getElementById("singelBarChart");
        ctx.height = 140;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["AUT", "BEA", "BOI", "DEO&PAR", "HBD", "HC", "LES", "SC", "SV"],
                datasets: [{
                    data: datas.donne,
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });


    }, 'json');

    $('.dataTables').dataTable({
        "ajax": base_url + 'clients/detailVente/?codeclient=' + codeclient


    });


});