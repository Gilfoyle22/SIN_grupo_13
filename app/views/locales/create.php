<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Crear nuevo local
		</h3>
		<form action="<?= url('/locales/create') ?>" method="POST">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control" name="name">
					</div>
				</div>
			</div>
			<button class="btn btn-primary">Guardar</button>
		</form>
	</div>

	
</div>