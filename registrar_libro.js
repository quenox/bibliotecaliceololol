$(document).ready(function()
{
	$("#in-codigobarra").focus();
	
	//si usuario escribe en campo obligatorio -> elimina la clase is-invalid de este/os input/s
	remove_is_invalid_inputs_obligatorios(); 

	$("#btn-registrarlibro").click(function()
	{
		var codigo_barra = $("#in-codigobarra").val(); //obligatorio
		
		if ( codigo_barra.length != 13 )
		{
		    alertify.error("Error: Codigo no valido! Vuelva a intentarlo!");
		    $("#btn-registrarlibro").val("");
		    return;
		}
		
		var autor_libro  = $("#in-autor").val(); //obligatorio
		var titulo_libro = $("#in-titulo").val(); //obligatorio
		var editorial    = $("#in-editorial").val();
		var nro_edicion  = $("#in-edicion").val();
		var codigo_isbn  = $("#in-isbn").val();
		var copias_libro = $("#in-cantidad").val(); //obligatorio

		var campo_obligatorio_vacio = false;
		if ( codigo_barra.length == 0 )
		{
			$("#in-codigobarra").addClass("is-invalid");
			campo_obligatorio_vacio = true;
		}
		if ( autor_libro.length == 0 )
		{
			$("#in-autor").addClass("is-invalid");
			campo_obligatorio_vacio = true;
		}
		if ( titulo_libro == 0 )
		{
			$("#in-titulo").addClass("is-invalid");
			campo_obligatorio_vacio = true;
		}
		if ( copias_libro.length == 0 )
		{
			$("#in-cantidad").addClass("is-invalid");
			campo_obligatorio_vacio = true;
		}

		if ( campo_obligatorio_vacio ) 
		{
			alertify.error("Complete todos los campos obligatorios!");
			return;
		}

		if ( editorial == "" ) 
		{
			editorial = "Desconocida";
		}

		if ( nro_edicion == "" ) 
		{
			nro_edicion = 1;
		}

		if ( codigo_isbn == "" ) 
		{
			codigo_isbn = -1;
		}


		$.ajax({
			url: "insert_libro.php",
			method: "POST",
			data: {codigo_barra:codigo_barra, autor_libro:autor_libro, titulo_libro:titulo_libro, 
				editorial:editorial, nro_edicion:nro_edicion, codigo_isbn:codigo_isbn, copias_libro:copias_libro},
			dataType: "json",
			success: function(data) 
			{
				if ( data.libro_creado ) 
				{
					alertify.success("Libro registrado exitosamente!");
					vaciar_campos();
				}
				else
				{
					alertify.error(data.mensaje.error);
					if(data.mensaje.error.includes("Duplicate entry"))
					{
						alertify.error("El libro ya se encontraba en la base de datos!");
						$("#menu-contenido").load("registrar_libro.php");
					}
				}

				if ( data.copias_creadadas == false )
				{
					console.log("Error al crear copias del libro");
				}
			}

		});
	});

});


/**
 * Remueve la clase is-invalid en los inputs que son obligatorios
 *  siempre y cuando hayan escrito algun valor en estos
 * @return void
 */
function remove_is_invalid_inputs_obligatorios()
{
	$("#in-codigobarra").keyup(function()
	{
		if ( $("#in-codigobarra").val() != 0 )
			$("#in-codigobarra").removeClass("is-invalid");
	});

	$("#in-autor").keyup(function()
	{
		if ( $("#in-autor").val() != 0 )
			$("#in-autor").removeClass("is-invalid");
	});

	$("#in-titulo").keyup(function()
	{
		if ( $("#in-titulo").val() != 0 )
			$("#in-titulo").removeClass("is-invalid");
	});

	$("#in-cantidad").keyup(function()
	{
		if ( $("#in-cantidad").val() != 0 )
			$("#in-cantidad").removeClass("is-invalid");
	});
}



function vaciar_campos()
{
	$("#in-codigobarra").val("");
	$("#in-autor").val("");
	$("#in-titulo").val("");
	$("#in-editorial").val("");
	$("#in-edicion").val(1);
	$("#in-isbn").val("");
	$("#in-cantidad").val(1);
}