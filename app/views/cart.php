<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">Mi carrito</h3>
	</div>
	<?php if(count($cart) > 0): ?>
	<div class="col-md-9">
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th></th>
						<th>Producto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Importe</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($cart as $item): ?>
					<tr>
						<td><img src="<?= $item['image'] ?>" width="60" height="40" style="object-fit: contain;"></td>
						<td><?= $item['name'] ?></td>
						<td><?= $item['price'] ?></td>
						<td width="15%">
							<form action="<?= url('/cart/update') ?>" method="POST">
								<input type="hidden" name="id" value="<?= $item['id'] ?>">	
								<input type="number" class="form-control" min="1" step="1" name="quantity" value="<?= $item['quantity'] ?>" onchange="this.closest('form').submit()">
							</form>
						</td>
						<td><?= number_format($item['price']*$item['quantity'], 2) ?></td>
						<td>
							<form action="<?= url('/cart/remove') ?>" method="POST">
								<input type="hidden" name="id" value="<?= $item['id'] ?>">	
								<button type="submit" class="btn btn-danger btn-sm">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<a href="<?= url('/cart/clear') ?>" class="btn btn-danger">Vaciar carrito</a>
	</div>
	<?php

	$total = 0;
	$igv = 0;
	$subtotal = 0;

	foreach($cart as $item){
		$total += $item['price']*$item['quantity'];
	}

	$igv = $total * 0.18;
	$subtotal = $total - $igv;

	?>
	<div class="col-md-3">
		<div class="card border-0 shadow-sm bg-primary text-white">
			<div class="card-body">
				<h5 class="card-title text-white">Detalle</h5>
				<p>
					<b>Subtotal:</b> <?php echo number_format($subtotal, 2) ?>
				</p>
				<p>
					<b>IGV (18%):</b> <?php echo number_format($igv, 2) ?>
				</p>
				<p>
					<b>Total:</b> <?php echo number_format($total, 2) ?>
				</p>
				<a href="<?= url('/checkout') ?>" class="btn btn-secondary btn-block">Finalizar compra</a>
			</div>
		</div>
	</div>
	<?php else: ?>
	<div class="col-md-12">
		<p class="text-center">El carrito está vacío.</p>
	</div>
	<?php endif ?>
</div>