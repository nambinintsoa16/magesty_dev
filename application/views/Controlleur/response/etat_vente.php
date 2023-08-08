    
<span class="badge badge-danger text-center badge5">Ventes Prévisionnelles : &nbsp <?=number_format($data['catotal'], 0, ',', ' ');?>&nbsp Ar</span><hr>
<span class="badge badge-primary text-center badge6">Ventes Réalisées : &nbsp<?=number_format($data['livre'], 0, ',', ' ');?>&nbsp Ar</span><hr>
<span class="badge badge-success text-center badge7">Ventes Annulées : &nbsp<?=number_format($data['annule'], 0, ',', ' ');?>&nbsp Ar</span><hr>
<span class="badge badge-primary text-center badge8">Ventes Confirmées : &nbsp<?=number_format($data['confirmer'], 0, ',', ' ');?>&nbsp Ar</span><hr>
<span class="badge badge-success text-center badge9">Ventes à confirmer : &nbsp<?=number_format($data['en_attente'], 0, ',', ' ');?>&nbsp Ar</span>
<div class="container">
   <div class="row pt-2 pl-0">
      <div class="col-12 pl-0">
                    <table class="table table-hover table1">
                        <thead>
                            <tr style="background:#fff">
                                <th style="width:40px" class="text-center"scope="col">Client</th>
                                <th scope="col" class="text-center">Vendeur Prin</th>
                                <th scope="col" class="text-center">Vendeur Sec</th>
                                <th scope="col" class="text-center">Montant</th>
                                <th style="width:50px" class="text-center" scope="col">Equipe</th>
                                <th style="width:80px" class="text-center" scope="col">Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$data['data']?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
