<script type="text/javascript">
      $(document).ready(function(){
        liste();
        function liste (){
          $.post('fonction/fonctionlistelivraisonjoureffectuee.php',function(data){
            $('.listLivraisonEffectuée').empty().append(data); 
          });
        }
      });
    </script>