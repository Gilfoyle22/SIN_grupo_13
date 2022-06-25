<div class="row">
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4">
			Lista de locales
		</h3>
		<a class="btn btn-primary mb-4" href="<?= url('/locales/create') ?>"><i class="fa fa-plus"></i> Crear nuevo</a>
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($locales as $local): ?>
					<tr>
						<td><?= $local->id ?></td>
						<td><?= $local->name ?></td>
						<td>
							<div class="d-flex gap-2">
								<a href="<?= url('/local/'.$local->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
								<form class="d-inline-block" action="<?= url('/local/'.$local->id.'/destroy') ?>" method="POST">
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