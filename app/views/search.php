<div class="col-md-10 offset-md-1">
	<div class="card shadow-sm">
		<div class="card-header">
			<i class="fa fa-search"></i> Resultados de Busqueda
		</div>
		<div class="card-body">
			<?php if($doc): ?>
			<h5><i class="fa fa-file-alt"></i> Datos de Documento</h5>
			<div class="table-responsive">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th>#</th>
							<th>Asunto</th>
							<th>Remitente</th>
							<th>Tipo de Documento</th>
							<th>Fecha</th>
							<th>Estado</th>
							<th>Observación</th>
							<th>Adjunto</th>
						</tr>
					</thead>
					<tr>
						<td><?= $doc->id ?></td>
						<td><?= $doc->asunto ?></td>
						<td><?= $doc->remitente ?></td>
						<td><?= $doc->tipo ?></td>
						<td><?= formatDate($doc->fecha) ?></td>
						<td><?= getStatus($doc->estado) ?></td>
						<td><?= $doc->observacion ?></td>
						<td>
							<?php if($doc->zip): ?>
								<a href="<?= url('/files/output/' . $doc->id . '.zip') ?>">Descargar</a>
							<?php endif; ?>
						</td>
					</tr>
				</table>
			</div>
			<h5><i class="fa fa-user-friends"></i> Historial de Documento</h5>
			<div class="table-responsive">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th>#</th>
							<th>Origen</th>
							<th>Destino</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($historial as $h): ?>
						<tr>
							<td><?= $h->id ?></td>
							<td><?= $h->origen ?></td>
							<td><?= $h->destino ?></td>
							<td><?= formatDate($h->fecha) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php else: ?>
				<h5 class="text-center">
					La busqueda no obtuvo resultados.
				</h5>
			<?php endif; ?>
		</div>
	</div>
</div>