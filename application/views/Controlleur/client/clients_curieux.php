<div class="column">
                <table class="table table-hove ">
                    <thead class="bg-primary"> 
                    <tr>    <th>Id</th>
                            <th>Code client </th>
                            <th>Nom et Prénom</th>
                            <th>Lien sur facebook</th>
                            <th>Origin</th>
                            <th></th>
                  </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($client as $client): ?>
                        <tr>
                                <td  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><?=$client->Id?></td>
                                <td  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><?=$client->Code_client?></td>
                                <td  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><?=$client->Nom?></td>
                                <td  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><?=$client->Link_facebook?></td>
                                <td  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><?=$client->Origin?></td>
                                <th  style="background-color:<?php if(empty($client->Link_facebook)):?>green;<?php else:?>orange<?php endif;?>;color:#fff;"><a href="<?=base_url('controlleur/detail_clients_curieux/'.$client->Id)?>" class="btn btn-primary"><i class="fa fa-info"><i></a></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><?=$links?></p>
            </div>