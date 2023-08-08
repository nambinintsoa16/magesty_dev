<span class="badge badge-danger text-center badge">Chiffre d'affaires globales: &nbsp <?php echo number_format($data['caglo'], 0, ',', ' ') ?>&nbsp Ar</span><br>
<span class="badge badge-primary text-center badge1">Chiffre d'affaires OPL : &nbsp<?php echo number_format($data['caop'], 0, ',', ' ') ?>&nbsp Ar</span><br>
<span class="badge badge-success text-center badge2">Chiffre d'affaires OPL livré : &nbsp<?php echo number_format($data['caopl'], 0, ',', ' ') ?>&nbsp Ar</span><br>
<span class="badge badge-primary text-center badge3">Chiffre d'affaires VP : &nbsp<?php echo number_format($data['cvp'], 0, ',', ' ') ?>&nbsp Ar</span><br>
<span class="badge badge-success text-center badge4">Chiffre d'affaires VP livré : &nbsp<?php echo number_format($data['cvpl'], 0, ',', ' ') ?>&nbsp Ar</span>


<div class="row mt-2 ff">
   <div class="col-md-12">
      <hr style="border:solid 1px red">
      <table class="table table-striped table-hover  table1">
         <tr>
            <th class="collapse"></th>
            <th style="width: 70px;">OPL</th>
            <th>CA Globale</th>
            <th>CA VB</th>
            <th>CA VP</th>
            <th>Ratio</th>
         </tr>
         </thead>
         <tbody>
            <?= $data['data'] ?>
         </tbody>
      </table>
   </div>
</div>