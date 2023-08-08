        <div class="modal fade " tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title1 collapse">Détail Livraison Journalière </h4>
                        <h4 class="modal-title">Détail Livraison Journalière </h4>

                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Livraison</a></li>
                            <li><a data-toggle="tab" href="#menu1">Livraison Livrée</a></li>
                            <li><a data-toggle="tab" href="#menu2">Livraison Reportée</a></li>
                            <li><a data-toggle="tab" href="#menu3">Livraison Annulée</a></li>
                        </ul>

                        <div class="tab-content data">
                           

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" id="save-event">Enregistrer</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script type='text/javascript'>
      

       
        </script>
        <style type='text/css'>
        body {
            margin-top: 40px;
            
           font-size:12px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }

        #calendar {
            width: 900px;
            margin: 0 auto;
        }

        #loading {
            position: absolute;
            top: 5px;
            right: 5px;
        }
        </style>
        <div id='loading' style='display:none'>Chargement...</div>
        <div id='calendar'></div>