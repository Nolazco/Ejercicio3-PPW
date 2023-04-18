<?php
	namespace views;
	require '../../app/autoloader.php';
	include "./layouts/main.php";
	use Controllers\auth\LoginController as LoginController;
	$ua = new LoginController;

	head($ua);
?>

<div class="row mx-auto" style="90%">
	<div class="col-4">
		<div id="prev-post" class="list-group">
			<!--publicaciones anteriores -->
		</div>
	</div>
	<div class="col-6">
		<div id="content" class="content">
			<!--Ultima publicacion/publicaicion seleccionada -->
		</div>
	</div>
	<div class="col">
		<div id="dates" class="list-group">
			<!-- Fechas de publicaciones -->

		</div>
	</div>
</div>

<?php scripts();?>

<script type="text/javascript">
	$(function(){
		app.previousPost();
		app.lastPost(1);	
	});
</script>
<?php 
	foot();