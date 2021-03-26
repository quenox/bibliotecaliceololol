$(document).ready(function()
{
	$("#in-codigobarra").focus();

	$("#in-autor").prop('disabled', true);
	$("#in-titulo").prop('disabled', true);
	$("#in-editorial").prop('disabled', true);
	$("#in-edicion").prop('disabled', true);
	$("#in-isbn").prop('disabled', true);
	$("#btn-editarlibro").prop('disabled', true);


	$("#in-codigobarra").keydown(function(e)
	{
		if(e.keyCode == 13) //
	    {
			var codigo_libro = $("#in-codigobarra").val();

			$.ajax({
				url: "select_libro_editar.php",
				method: "POST",
				data: {codigo_libro:codigo_libro},
				dataType: "json",
				success: function(data)
				{
					if ( data["libro_existe"] ) 
					{
						$("#in-codigobarra").prop('disabled', true);

						$("#in-autor").prop('disabled', false);
						$("#in-titulo").prop('disabled', false);
						$("#in-editorial").prop('disabled', false);
						$("#in-edicion").prop('disabled', false);
						$("#in-isbn").prop('disabled', false);
						$("#btn-editarlibro").prop('disabled', false);

						$("#in-autor").val(data["libro"].autorprincipal);
						$("#in-titulo").val(data["libro"].titulo);
						$("#in-editorial").val(data["libro"].editorial);
						$("#in-edicion").val(data["libro"].edicion);
						$("#in-isbn").val(data["libro"].codigoisbn);
					}
					else
					{
						alertify.error("Error: No existe un libro con el codigo especificado");
						$("#in-codigobarra").val("");
					}
				}

			});
	    }
	});


	$("#btn-editarlibro").click(function()
	{
		var codigo_libro = $("#in-codigobarra").val(); //obligatorio
		var autor        = $("#in-autor").val(); //obligatorio
		var	titulo       = $("#in-titulo").val(); //obligatorio
		var editorial    = $("#in-editorial").val();
		var edicion      = $("#in-edicion").val();
		var isbn         = $("#in-isbn").val();

		$.ajax({
			url: "update_libro_editar.php",
			method: "POST",
			data: {codigo_libro:codigo_libro, autor:autor, titulo:titulo, 
					editorial:editorial, edicion:edicion, isbn:isbn},
			dataType: "json",
			success: function(data)
			{
				if ( data.fue_actualizado )
				{	
					alertify.success(data.mensaje);
					$("#menu-contenido").load("editar_libro.php");
				}
				else
				{
					alertify.error(data.mensaje);
				}
			}
		})
	});


});