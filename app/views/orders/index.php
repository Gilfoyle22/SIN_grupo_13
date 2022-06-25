<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Lista de pedidos
		</h3>
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th>Id</th>
						<th>Cliente</th>
						<th>Fecha</th>
						<th>Total</th>
						<th>Anulado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php $db = DB::getInstance(); ?>
					<?php foreach($orders as $order): ?>
					<tr>
						<td><?= $order->id ?></td>
						<td>
							<?php
							$user = $db->find('users', 'id', $order->client_id);
							echo $user->name.' '.$user->last_name;
							?>
						</td>
						<td><?= formatDate($order->date) ?></td>
						<td><?= $order->total ?></td>
						<td><?= $order->annulled == 1 ? 'Si' : 'No' ?></td>
						<td>
							<div class="d-flex gap-2">
								<a href="<?= url('/order/'.$order->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
							</div>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>