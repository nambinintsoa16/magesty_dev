    $(() => {
        $('.table').dataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            }
        })
    })