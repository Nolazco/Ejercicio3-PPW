<?php
	namespace views;
	require_once "../../../app/autoloader.php";
	include "../layouts/main.php";
	use Controllers\auth\LoginController as LoginController;

	head();
?>

<div class="container">
	<div class="card mt-5 w-50 mx-auto">
		<div class="card-body">
			<form action="" id="login-form">
				<div class="form-group">
					<label for="username">Usuario</label>
					<input type="text" 
					       id="username"
					       class="form-control"
					       name="username"
					       placeholder="Nombre de usuario"
					       required>
				</div>
				<div class="form-group">
					<label for="passwd">Contraseña</label>
					<input type="password"
					       class="form-control"
					       id="passwd"
					       name="passwd"
					       required>
				</div>
				<div class="d-grid gap-2 my-2">
					<small id="error" class="form-text text-danger d-none mb-2">
						Los datos ingresados en el inicio de sesión son incorrectos.
					</small>
					<button class="btn btn-primary" type="submit">
						iniciar sesion <i class="bi bi-box-arrow-in-right"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php scripts(); ?>
<script type="text/javascript">
	$(function(){
		const lf = $("#login-form");
		lf.on("submit", function(e){
			e.preventDefault();
			e.stopPropagation();
			const data = new FormData();
			data.append("username", $("#username").val());
			data.append("passwd", $("#passwd").val());
			data.append("_login", "");
			fetch(app.routes.login, {
				method : "POST",
				body : data
			})
				.then ( resp => resp.json() )
				.then ( resp => {
					if(resp.r != false){
						location.href = "../home.php"
						//app.view("home")
					}else{
						$("#error").removeClass(d-none);
					}
				} ).catch( err => console.error( err ));
		})
	})
</script>