$(document).ready(function()
{
	$("#div-liceodelolol").hide().fadeIn(4000);


	$("#btn-prestamo").click(function()
	{
		$("#menu-contenido").load("prestamo.php");
	});

	$("#btn-estado-prestamo").click(function(){
		$("#menu-contenido").load("estado_prestamos.php");
	});

	$("#btn-buscar-libro").click(function(){
		$("#menu-contenido").load("buscar_libro.php");
	});

	$("#btn-registrar-libro").click(function()
	{
		$("#menu-contenido").load("registrar_libro.php");
	});

	$("#btn-registrar-ejemplar").click(function()
	{
		$("#menu-contenido").load("registrar_ejemplar.php");
	});

	$("#btn-editar-libro").click(function()
	{
		$("#menu-contenido").load("editar_libro.php");
	});

	$("#btn-eliminar-libro").click(function()
	{
		$("#menu-contenido").load("eliminar_libro.php");
	});
});



