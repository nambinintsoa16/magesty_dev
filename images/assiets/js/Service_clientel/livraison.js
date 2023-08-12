 <script type="text/javascript">
      $(document).ready(function(){
        liste();
        function liste (){
          $.post('fonction/fonctionlivraison.php',function(data){
            $('.table').empty().append(data);
          });
        }
      });
    </script>