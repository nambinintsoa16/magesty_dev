<div class="card-body">
<div class="row">
	<div class="responsive w-100">
		<table class="table table-striped table-bordered w-100 mt-4 text-center">
			<thead class="bg-success text-white">
				<th>Date</th>
				<th>Code client</th>
				<th>Code Urgent</th>
				<th>Detail</th>
			</thead>
		    <tbody>

				<?php foreach ($data as $key => $data):?>
		    	<tr>
		      		<td><?=$data->Date?></td>
		      		<td><?=$data->codeClient?></td>
		      		<td><?=$data->CodeUrgent?></td> 
		      		<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?=$data->Id?>">Objet</button></td>     
		    	</tr>
		    <div class="modal fade" id="<?=$data->Id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-info">
						<h5 class="modal-title" id="exampleModalLongTitle"><?=$data->Id?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						 <div class="col-md-12">
						 	 <ul class="list-group">
						 	 	<li class="list-group-item">
                                    <span class="col-md-4"><?=$data->Objet?></span>
                                </li>
						 	 </ul>
						 </div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>    
		<?php endforeach;?>
		    </tbody>
		</table>
	</div>
</div>

</div>

