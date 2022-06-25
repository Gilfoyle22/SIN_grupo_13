<div class="row">
	
	<div class="col-md-6">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<h5 class="card-title"><i class="fa fa-sign-in-alt"></i> Ingresar a su cuenta</h5>
				<form method="POST" action="<?= url('/login') ?>">
					<div class="form-group">
						<label>Correo electrónico</label>
						<input type="text" class="form-control form-control-sm" name="email">
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" class="form-control form-control-sm" name="password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">
							<i class="fa fa-arrow-right"></i> Ingresar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card border-0 shadow-sm">
			<div class="card-body">
				<h5 class="card-title"><i class="fa fa-user-plus"></i> Crear una cuenta</h5>
				<form method="POST" action="<?= url('/register') ?>">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" class="form-control form-control-sm" name="name">
					</div>
					<div class="form-group">
						<label>Apellidos</label>
						<input type="text" class="form-control form-control-sm" name="last_name">
					</div>
					<div class="form-group">
						<label>Correo electrónico</label>
						<input type="text" class="form-control form-control-sm" name="email">
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" class="form-control form-control-sm" name="password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">
							<i class="fa fa-arrow-right"></i> Crear cuenta
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
</div>