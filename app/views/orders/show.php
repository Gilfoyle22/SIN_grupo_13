<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Detalle de pedido N° <?= $order->id ?>
		</h3>
		<p>
			Fecha: <?= formatDate($order->date) ?>
		</p>
		<p>
			Total: <?= $order->total ?>
		</p>
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th>Producto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Importe</th>
					</tr>
				</thead>
				<tbody>
					<?php $db = DB::getInstance(); ?>
					<?php foreach($details as $detail): ?>
					<tr>
						<td>
							<?php
							$product = $db->find('products', 'id', $detail->product_id);
							echo $product->name;
							?>
						</td>
						<td><?= $detail->price ?></td>
						<td><?= $detail->quantity ?></td>
						<td><?= number_format($detail->quantity * $detail->price, 2) ?></td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>