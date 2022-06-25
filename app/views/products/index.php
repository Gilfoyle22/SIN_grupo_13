<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Lista de productos
		</h3>
		<a class="btn btn-primary mb-4" href="<?= url('/products/create') ?>"><i class="fa fa-plus"></i> Crear nuevo</a>
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th></th>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Precio</th>
						<th>Stock</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($products as $product): ?>
					<tr>
						<td><img src="<?= $product->image ?>" width="60" height="40" style="object-fit: contain;"></td>
						<td><?= $product->id ?></td>
						<td><?= $product->name ?></td>
						<td><?= $product->description ?></td>
						<td><?= $product->price ?></td>
						<td><?= $product->stock ?></td>
						<td>
							<div class="d-flex gap-2">
								<a href="<?= url('/product/'.$product->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
								<form class="d-inline-block" action="<?= url('/product/'.$product->id.'/destroy') ?>" method="POST">
									<button class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro que desea eliminar este registro?')"><i class="fa fa-trash"></i></button>
								</form>
							</div>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>