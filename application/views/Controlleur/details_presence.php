<div class="container">
   <div class="row">
      <table class="table table-light dataTable table_timeline">
            <thead class="thead-light">
                <tr>
                    <th>HEURE</th>
                    <th>DATE</th>
                   
                   
                </tr>
            </thead>
            <tbody class="tbody">
                <?php foreach($data as $data):
                   
                   $date=explode(' ',$data['heure']);
                    $dt=new dateTime($date[1]);
                    $dt->modify('+3hours');
                    $dates=$dt->format("H:i:s");
                    
                 ?>   
                  <tr>
                    
                     <td><?php if($data['action']!=""){echo $date[1];}else{echo $dates;}?></td>
                    
                                        
                  </tr>
                <?php endforeach;?>
            </tbody>
        </table> 
   </div>    
</div>