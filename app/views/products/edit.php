<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Editar producto
		</h3>
		<form action="<?= url('/product/'.$product->id) ?>" method="POST">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="name" value="<?= $product->name ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Descripción</label>
						<input type="text" class="form-control" name="description" value="<?= $product->description ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Precio</label>
						<input type="number" class="form-control"  min="0.10" step="0.10" name="price" value="<?= $product->price ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Imagen (url)</label>
						<input type="text" class="form-control" name="image" value="<?= $product->image ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Stock</label>
						<input type="number" min="0" step="1" class="form-control" name="stock" value="<?= $product->stock ?>">
					</div>
				</div>
			</div>
			<button class="btn btn-primary">Guardar</button>
		</form>
	</div>

	
</div>