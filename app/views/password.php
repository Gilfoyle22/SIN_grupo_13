<div class="col-md-4">
	<div class="card shadow-sm">
		<div class="card-header">
			<i class="fas fa-key"></i> Cambio de clave
		</div>
		<div class="card-body">
			<div id="message"></div>
			<small class="text-danger"><b>La clave debe tener letras y/o números, sin espacios. Minimo 6 caracteres</b></small>
			<form id="passwordForm">
				<div class="form-group">
					<label>Clave actual <b class="text-danger">*</b></label>
					<input type="password" name="clave_actual" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<label>Clave nueva <b class="text-danger">*</b></label>
					<input type="password" name="clave_nueva" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<label>Confirmar clave nueva <b class="text-danger">*</b></label>
					<input type="password" name="clave_nueva2" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<button type="submit" id="btnSend" class="btn btn-primary">
						<i class="fas fa-check"></i> Cambiar
					</button>
					<button type="button" id="btnShow" class="btn btn-secondary btn-sm">
						<i class="fas fa-eye"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#passwordForm').submit(function(e){
		e.preventDefault();
		$('#btnSend').attr('disabled',true);
		$.ajax({
			url: '<?= url('/cambiar_clave') ?>',
			method: 'post',
			data: $(this).serialize(),
			success: function(data){
				data = JSON.parse(data);
				if(data.status){
					location.href = '<?= url('/') ?>';
				}else{
					$("#message").html(`<div class="alert alert-danger">${data.message}</div>`);
					$('#btnSend').attr('disabled',false);
				}
			}
		});
	});

	$('#btnShow').click(function(){
		if($('input[type=password]').attr('type') == 'password'){
			$('input[type=password]').attr('type','text');
			$(this).html('<i class="fas fa-eye-slash"></i>');
		}else{
			$('input[type=text]').attr('type','password');
			$(this).html('<i class="fas fa-eye"></i>');
		}
		
	});
</script>