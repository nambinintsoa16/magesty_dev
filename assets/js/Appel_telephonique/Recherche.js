$(document).ready(function() {
    $('.tableClient').DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
    });
});