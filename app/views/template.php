<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Mi Tienda</title>
	<!-- Styles -->
	<link rel="stylesheet" href="<?= url('/assets/css/argon.min.css') ?>">
	<link rel="stylesheet" href="<?= url('/assets/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= url('/assets/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= url('/assets/css/style.css') ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap">
	<!-- Scripts -->

	<script src="<?= url('/assets/js/jquery.min.js') ?>"></script>
	<script src="<?= url('/assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= url('/assets/js/argon.min.js') ?>"></script>
	<script src="<?= url('/assets/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= url('/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1 shadow-sm">
	    <div class="container">
	        <a class="navbar-brand" href="<?= url('/') ?>">
	        	Mi Tienda
	        </a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-expanded="false">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbar-default">
	            <div class="navbar-collapse-header">
	                <div class="row">
	                    <div class="col-8 collapse-brand">
	                        <a href="index">
	                            Mi Tienda
	                        </a>
	                    </div>
	                    <div class="col-4 collapse-close">
	                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-expanded="false">
	                            <span></span>
	                            <span></span>
	                        </button>
	                    </div>
	                </div>
	            </div>
	            <ul class="navbar-nav ml-lg-auto">
	                
	                <li class="nav-item">
	                    <a href="<?= url('/') ?>" class="nav-link nav-link-icon">
	                        <span class="fas fa-home"></span> Inicio
	                    </a>
	                </li>

	                <li class="nav-item">
	                    <a href="<?= url('/cart') ?>" class="nav-link nav-link-icon">
	                        <span class="fas fa-shopping-cart"></span> Carrito
	                    </a>
	                </li>

	                <?php if(Session::get('loggedIn')): ?>


		                <?php if(checkRole('admin')): ?>

		                <li class="nav-item">
		                    <a href="<?= url('/locales') ?>" class="nav-link nav-link-icon">
		                        <span class="fas fa-map-marker"></span> Locales
		                    </a>
		                </li>
		                <li class="nav-item">
		                    <a href="<?= url('/products') ?>" class="nav-link nav-link-icon">
		                        <span class="fas fa-box"></span> Productos
		                    </a>
		                </li>
		                <li class="nav-item">
		                    <a href="<?= url('/orders') ?>" class="nav-link nav-link-icon">
		                        <span class="fas fa-dollar-sign"></span> Pedidos
		                    </a>
		                </li>

		                <?php endif; ?>

	                	<li class="nav-item dropdown">
	                        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
	                            <span class="fas fa-user-cog"></span> <?= Session::get('user')->name ?> <span class="fas fa-angle-down ml-1"></span>
	                        </a>
	                        <div class="dropdown-menu dropdown-menu-right">
	                            <a class="dropdown-item" href="<?= url('/history') ?>"><span class="fas fa-power-off mr-1"></span>Historial de compras</a>
	                            <a class="dropdown-item" href="<?= url('/logout') ?>"><span class="fas fa-power-off mr-1"></span>Cerrar Sesión</a>
	                        </div>
	                    </li>



	                <?php else: ?>

	                <li class="nav-item">
	                	<a href="<?= url('/login') ?>" class="nav-link nav-link-icon">
	                		<span class="fas fa-sign-in-alt mr-1"></span>Ingresar
	                	</a>
	                </li>


	                <?php endif; ?>    
	            	
	            </ul>

	        </div>
	    </div>
	</nav>	
	<div class="container mt-4">
		<?php if(Session::get('flash')): ?>
		<div class="alert alert-success">
			<?= Session::get('flash') ?>
		</div>
		<?php endif; Session::remove('flash') ?>

		<?php if(Session::get('error')): ?>
		<div class="alert alert-danger">
			<?= Session::get('error') ?>
		</div>
		<?php endif; Session::remove('error') ?>

		<?php $this->render($this->view); ?>
		
	</div>
	<script>
		$(document).ready(function(){
			$('.dataTable').DataTable({
				'ordering': false,
				'language':{
					'url': '<?= url('/assets/js/Spanish.json') ?>'
				}
			});
		});
	</script>
</body>
</html>