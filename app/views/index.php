<div class="row">
	<?php if(Session::get('user')): ?>
	<?php
	$db = DB::getInstance();
	$user = $db->find('users', 'id', Session::get('user')->id);
	$local_id = $user->local_id;
	?>
	<div class="col-md-6">
		<form method="POST">
			<div class="form-group">
				<label>Local de recojo</label>
				<select class="form-control form-control-sm" name="local_id">
					<?php foreach($locales as $local): ?>
					<option <?= $local->id == $local_id ? 'selected' : '' ?> value="<?= $local->id ?>"><?= $local->name ?></option>
					<?php endforeach ?>
				</select>
				<small>Debes seleccionar el local de recojo para poder comprar</small>
			</div>
			<button class="btn btn-primary">Guardar</button>
		</form>
	</div>
	<?php endif ?>
	<div class="col-md-12">
		<h3 class="text-primary text-center mb-4"><i class="fa fa-shopping-bag"></i> Catálogo de productos</h3>
	</div>
	<?php foreach($products as $product): ?>
	<div class="col-md-4">
		<div class="card border-0 shadow-sm mb-4">
			<img src="<?= $product->image ?>" alt="" class="card-img-top" height="200" style="object-fit: contain;">
			<div class="card-body">
				<h5 class="card-title mb-0 text-truncate"><?= $product->name ?></h5>
				<span class="small d-block mb-2 text-truncate">
					<?= $product->description ?> &nbsp; 
				</span>
				<span class="d-block mb-2">
					S/ <?= $product->price ?>
				</span>
				<?php if($product->stock > 0): ?>
				<a class="btn btn-primary btn-block" href="<?= url('/cart/add/'.$product->id) ?>"><i class="fa fa-shopping-cart"></i> Agregar al carrito</a>
				<?php else: ?>
				<button class="btn btn-primary btn-block" disabled>Agregar al carrito</button>
				<?php endif ?>
			</div>
		</div>
	</div>
	<?php endforeach ?>
</div>
