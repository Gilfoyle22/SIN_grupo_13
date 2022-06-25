<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center">Compra realizada</h3>
		<p>Tu compra fue realizada correctamente, aquí te dejamos algunos detalles de la compra:</p>
		<p>
			<span class="d-block"> Venta n°: <?= $order->id ?> </span>
			<span class="d-block"> Fecha: <?= formatDate($order->date) ?> </span>
			<span class="d-block"> Total: <?= $order->total ?> </span>
		</p>
	</div>
</div>