$(document).ready(function()
{

	$("#btn-delete-libro").click(function(){
		var codigobarra = prompt("Ingrese el codigo de barras del libro");
		if ( codigobarra == null || codigobarra == "" )
		{
			alertify.error("Cancelado");
			return;
		}
		alertify.prompt( '¿Desea eliminar todos los registros del libro?', 'Para confirmar escriba la palabra: eliminar', '', 
			function(evt, value) {
				if ( value == 'eliminar' )
				{
					eliminar_libro(codigobarra);
					return;
				}
				else
				{
					alertify.error("Cancelado");
					return;
				}
			}, 
			function() 
			{ 
				alertify.error("Cancelado");
				return;
			}
		);
	});

	$("#btn-delete-ejemplar").click(function(){
		var codigobarra = prompt("Ingrese el codigo de barras del libro");
		if ( codigobarra == null || codigobarra == "" )
		{
			alertify.error("Cancelado");
			return;
		}
		var ejemplar = prompt("Ingrese el numero del ejemplar", 1);
		if ( ejemplar == null || ejemplar == "" )
		{
			alertify.error("Cancelado");
			return;
		}

		alertify.confirm('¿Desea eliminar el ejemplar?', 'Esta apunto de eliminar la copia '+ejemplar+' presiona Ok para confirmar', 
			function()
			{
				eliminar_ejemplar(codigobarra, ejemplar);
				return;
			}, 
			function()
			{ 
				alertify.error('Cancelado');
				return;
			}
		);
		
	});

});



function eliminar_libro(codigobarra)
{
	$.ajax({
		url: "delete_libro_eliminar.php",
		method: "POST",
		data: {codigobarra:codigobarra},
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			if ( data.fue_eliminado )
			{
				alertify.success(data.mensaje);
			}

			else
			{
				alertify.error(data.mensaje);
			}
		}

	});
}


function eliminar_ejemplar(codigobarra, nro_copia)
{
	$.ajax({
		url: "delete_ejemplar_eliminar.php",
		method: "POST",
		data: {codigobarra:codigobarra, nro_copia:nro_copia},
		dataType: "json",
		success: function(data)
		{
			if ( data.fue_eliminado )
			{
				alertify.success(data.mensaje);
			}
			else
			{
				alertify.error(data.mensaje);
			}
		}
	});
}