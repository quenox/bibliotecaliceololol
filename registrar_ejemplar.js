$(document).ready(function()
{

	$("#in-codigo-barra").focus();

	//permitir solo numeros en la clase input-number
	$('.input-number').on('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});

	$("#in-codigo-barra").keyup(function(e){

		if ( e.keyCode == 13 )
		{
			var codigobarra = $("#in-codigo-barra").val();
			identificar_libro(codigobarra);
		}
	});

});


function identificar_libro(codigobarra)
{
	$.ajax({
		url: "select_identificar_libro.php",
		method: "POST",
		data: {codigobarra:codigobarra},
		dataType: "json",
		success: function(data)
		{
			console.log(data);
			if ( data.hay_resultados )
			{
				var codigobarra  = data.libro.codigobarra;
				var titulo       = data.libro.titulo;
				var autor        = data.libro.autorprincipal;
				var edicion      = data.libro.edicion;


				alertify.prompt( 'Agregar un ejemplar del libro: '+titulo, 'Escriba el numero de la copia', '', 
					function(evt, copia)
					{
						var int_copia = parseInt(copia);
						if ( Number.isInteger(int_copia) )
						{
							registrar_ejemplar(codigobarra, int_copia);
						}
						else
						{
							alertify.error("Error: Debe ingresar un valor entero, por ejemplo: 1");
						}
					},
					function() 
					{ 
						alertify.error('Cancelado'); 
					}
				);
				$("#in-codigo-barra").val("");
			}
			else
			{
				alertify.error(data.mensaje);
			}
		}

	})
}

function registrar_ejemplar(codigobarra, int_copia)
{
	$.ajax({
		url: "insert_ejemplar_registrar.php",
		method: "POST",
		data: {codigobarra:codigobarra, int_copia:int_copia},
		dataType: "json",
		success: function(data)
		{
			if ( data.fue_registrado )
			{
				alertify.success(data.mensaje);
			}
			else
			{
				alertify.error(data.mensaje);
			}
			$("#in-codigo-barra").val("");
		}
	});
}