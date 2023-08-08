<div class="form-group">

      <table class="table table-light dataTable table_listeclient">
            <thead class="thead-light">
                <tr>
                    <th>CODE CLIENT</th>
                    <th>NOM DU CLIENT</th>
                    <th>NOMBRE DE DISCUSSIONS</th>
                    <th>STATUT</th>
                                                                     
                </tr>
            </thead>
            <tbody class="tbody">
            
           <?php foreach($data as $data):?>
            <tr>
                <td><?=$data['Code_client']?></td>
                <td>
                <a href="<?=base_url('Controlleur/details_discussion/'.$user."/".$data['client'])?>" class='link1 details'><?=$data['detail']->Nom?></a>
                </td>
                <td class='text-center nbre'><a class='link duscuss' href="<?=base_url('Controlleur/details_discussion/'.$user."/".$data['client']."/".$date)?>"><?=count($data['discuss'])?></a></td>
                <td class='text-center statut'><?=$data['statut']?></td>
            </tr>
                <?php endforeach;?>
             </tbody>
        </table> 
   </div>    
  