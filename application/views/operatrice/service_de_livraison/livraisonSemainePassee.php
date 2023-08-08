<div class="container col-md-12">
    <fieldset class="border p-1">
        <legend class="w-auto"><b class="text-sm">Etat de livraison</b></legend>
        <!--<div class="form-group col-md-12">
        	<div class="row">
				<div class="input-group col-md-6">
					<input type="date" class="form-control" value="" name="date">					
				</div>
				<div class="input-group col-md-6">
					<input type="date" class="form-control" value="" name="date">
					<div class="input-group-prepend">
						<button type="submit" class="btn btn-success but btn-success-sm p-1"> valider</button>
				</div>					
				</div>
				
			</div>
		-->
		</div>
    </fieldset>

    
            <div class=" table-responsive-lg">
                <table class="table table-bordered table-stripted table_mois">
                    <thead>
                    	<tr>
                    		<th style="font-size: 12px;" class="text-center">TOTAL</th>
                            <th style="font-size: 12px;" class="text-center"><?=number_format($total, 0, ',', ' ')?></a></th>
                    	</tr>
                        <tr class="bg-primary text-white">
                            <th style="font-size: 12px;" class="text-center">DATE DE LIVRAISON</th>
                            <th style="font-size: 12px;" class="text-center">CA LIVRE DE LA SEMAINE PASSEE</a></th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                    	<?= $data?>
                    </tbody>
                </table>
            
    </div>

</div>