
<div class="container">
<div class="row">
     <div class="form-group col-md-4">
         <a href="#" class="add_relance btn btn-primary">Ajoure</a>
    
    </div>
 </div>   

   <div class="row">
     <div class="form-group col-md-4">
   
      <fieldset><legend>CRX</legend>
        <input type="text" class="form-control">
      </fieldset> 

    </div>

    <div class="form-group col-md-4">
    <fieldset><legend>CRX</legend>
     <input type="text" class="form-control">
     </fieldset> 
 </div>

 <div class="form-group col-md-4">
 <fieldset><legend>CRX</legend>
     <input type="text" class="form-control">
     </fieldset> 
 </div>

 </div>
</div>
<hr/>
<div class="container p-3" style="background-color:rgba(255, 255, 255, 0.3)">
  <div class="responsive">
<table class="table table-bordered">
<thead>
  <tr>
    <td class="text-center">ID</td>
    <td class="text-center">NOM DU CLIENT</td>
     <?php foreach($entete as $entete):?>
        <td><?=$entete?></td>
     <?php endforeach;?>
 </tr>
</thead>
<tbody style="height:500px;overflow: scroll;" class="tbody">
<?php foreach ($data as $key => $data):?>
   <tr> 
     
      <td class="text-center"><?php $result=explode('.',$key); echo $result[1]; ?></td> 
      <td class="text-center"><?=$result[0]?></td> 
    <?php foreach($data['page'] as $key=>$donne ): if($donne=="CLT"){$color="green";$font="#fff";}else if($donne=="CMT"){$color="#0099CC";$font="#fff";}else{$color="orange";$font="#fff";}?>
      <td  class="text-center" style="background-color:<?=$color?>;color:<?=$font?>"><?=$donne?>
      <input type="checkbox" class="form-control select_user"><label></label>
      </td>
    <?php endforeach;?>  
   </tr>
<?php endforeach;?>
</tbody>
</table>
<p><?=$links?></p>
</div></div>