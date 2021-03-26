<?php
session_start();

if ( !isset($_SESSION["cuenta_activa"]) || !$_SESSION["cuenta_activa"] )
{
	header("Location: cerrar_sesion.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS Alertify -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

</head>
<body>

	<div class="container text-center pt-2">
		<div class="row py-3" style="background-image: url('background-images/banner_biblioteca.jpg');">
			<div class="col col-md-3 text-left">
				<img src="https://liceodelolol.cl/wp-content/uploads/2019/01/cropped-INSIGNIA2-2.png" style="width: 110px;" class="btn">
			</div>
			<div id="div-liceodelolol" class="col col-md-7 text-center" style="background-color: rgba(138, 240, 207, 0.7);">
				<h1 style="color: black;font-family: Courier New, Courier, monospace">Bliblioteca De Lolol</h1>
			</div>
			<div class="col col-md-2 text-right">
				<a href="cerrar_sesion.php" class="btn btn-primary btn-sm"><strong>cerrar sesion <i class="fa fa-sign-out"></i></strong></a>
			</div>
		</div>

		<div class="row mt-2">
			<div class="col col-md-3">
				<div class="row mt-2">
					<button id="btn-prestamo" class="btn btn-warning btn-block">Prestamo <i class="fa fa-book"></i></button>
				</div>
				<div class="row mt-2">
					<button id="btn-estado-prestamo" class="btn btn-warning btn-block">Estado de prestamos <i class="fa fa-table"></i></i></button>
				</div>				
				<div class="row mt-2">
					<button id="btn-buscar-libro" class="btn btn-warning btn-block">Buscar libro <i class="fa fa-search"></i></button>
				</div>
				<div class="row mt-2">
					<button id="btn-registrar-libro" class="btn btn-warning btn-block">Registrar libro <i class="fa fa-plus"></i></button>
				</div>
				<div class="row mt-2">
					<button id="btn-registrar-ejemplar" class="btn btn-warning btn-block">Añadir ejemplar <i class="fa fa-plus"></i></button>
				</div>
				<div class="row mt-2">
					<button id="btn-editar-libro" class="btn btn-warning btn-block">Editar libro <i class="fa fa-edit"></i></button>
				</div>
				<div class="row mt-2">
					<button id="btn-eliminar-libro" class="btn btn-danger btn-block">Eliminar libro <i class="fa fa-trash"></i></button>
				</div>
				<div class="row mt-2">
					<button class="btn btn-warning btn-block" disabled>Mi Cuenta <i class="fa fa-user"></i></button>
				</div>			
			</div>
			<div id="menu-contenido" class="col col-md-9">
			
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="menu_bibliotecario.js"></script>
	<!-- JavaScript Alertify -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>
</html>