<?php
	function head($ua = null){
		!is_null($ua) ? $ua->sessionValidate() : null;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/resources/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<style>
	body{
		font-family: 'Roboto', serif;
	}
</style>
	<title>
		Blog X
	</title>
</head>
<body>
	<div id="app" class="container-fluid p-0">
		<header class="row m-0 bg-light">
			<div class="col-9">
				<h1 class="ml-3 mt-2">BLOG X</h1>
			</div>
			<div class="col-3 mt-2">
				<form class="d-flex" role="search">
		        <input class="form-control me-2" id="searchWord" type="search" placeholder="Search" aria-label="Search">
		        <button class="btn btn-outline-success" onclick="app.searchWord()" type="button"><i class="bi bi-search"></i></button>
		      </form>
			</div>
		</header>
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
		  <div class="container-fluid">
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="/">Inicio</a>
		        </li>
		        <?php if(!is_null($ua) && $ua->sv){?>
		        <li class="nav-item">
		          <button class="nav-link btn btn-link"
		          type="button" aria-current="page"
		          onclick="app.views('newpost')">
		          		Nueva publicacion
		          </button>
		        </li>
		        <li class="nav-item">
		          <button class="nav-link btn btn-link"
		          type="button" aria-current="page"
		          onclick="app.views('myposts')">
		          		Mis publicaciones
		          </button>
		        </li>
		    	<?php }?>
		      </ul>
		      <ul class="navbar-nav me-auto mb-2 d-flex">
		      	<?php if(is_null($ua) || !$ua->sv){?>
		        <li class="nav-item">
		          <button type="button" class="nav-link btn btn-link" 
		          		onclick="app.views('inisession')" aria-current="page" href="#">
		          		Iniciar sesion
		          	</button>
		        </li>

		    	<?php }else{ ?>
		      	<li class="nav-item dropdown">
		          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		            <?=$ua->name?>
		          </a>
		          <ul class="dropdown-menu">
		            <li><a class="dropdown-item" href="#">Action</a></li>
		            <li><a class="dropdown-item" href="#">Another action</a></li>
		            <li><hr class="dropdown-divider"></li>
		            <li><button type="button" class="dropdown-item btn btn-linl"
		            	onclick="app.views('endsession')">
		        		    Cerrar sesion
		        		</button></li>
		          </ul>
		        </li>
		    	<?php } ?>
		      </ul>
		    </div>
		  </div>
		</nav>
	<?php
}
function scripts($script=""){
	?>
	</div>
<script src="/resources/js/jquery-3.6.3.js"></script>
<script src="/resources/js/bootstrap.js"></script>
<script src="/resources/js/popper.js"></script>
<script src="/resources/js/app.js"></script>
<?php
	if($script != ""){
		echo '<script src="/resources/js/'. $script . '.js"></script>';
	}
}
	function foot(){
?>
</body>
</html>
<?php }