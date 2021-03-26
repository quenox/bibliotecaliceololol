$(document).ready(function()
{
	$("#in-buscar-alumno").focus();

	//permitir solo numeros en la clase input-number
	$('.input-number').on('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});


	$("#in-buscar-alumno").keyup(function(e)
	{
		if ( $("#in-buscar-alumno").val().length != 0 )
			$("#in-buscar-alumno").removeClass("is-invalid");

		if ( e.keyCode == 13 ) //enter
		{
			accion_buscar_alumno();
		}
	});


	$("#btn-buscar-alumno").click(function()
	{
		accion_buscar_alumno();
	});


	$("#in-codigo-barra").keydown(function(e)
	{
	    if(e.keyCode == 13) //enter
	    {
	    	var codigo_libro = $("#in-codigo-barra").val();

	    	$.ajax({
	    		url: "select_libro_prestamo.php",
	    		method: "POST",
	    		data: {codigo_libro:codigo_libro},
	    		dataType: "json",
	    		success: function(data)
	    		{	
	    			var html_tbody   = "";

	    			if ( data.length > 0 )
	    			{
	    				console.log(data);
	    				var fecha_limite = String(data[0]["fecha_limite"]);

		    			for ( var i=0 ; i < data.length ; i++ ) 
		    			{
		    				html_tbody += "<tr>";
		    				html_tbody += "<td>"+data[i]["numero"]+"</td>";
		    				html_tbody += "<td>"+data[i]["titulo"]+"</td>";
		    				html_tbody += "<td>"+data[i]["autorprincipal"]+"</td>";
		    				html_tbody += '<td><strong>'+fecha_limite+'</strong></td>';
		    				html_tbody += '<td><button class="btn btn-outline-info btn-sm btn-confirmar-prestamo" data-codigobarra="'+data[i]["codigobarra"]+'" data-numero-copia="'+data[i]["numero"]+'"><i class="fa fa-plus"></i></button></td>';
		    				html_tbody += "</tr>";
		    			}

		    			$("#tbody-libros").html(html_tbody);
		    			click_confirmar_prestamo();
	    			}

	    			else
	    			{
	    				alertify.error("Error: No se encontraron resultados!");
	    				$("#in-codigo-barra").val(html_tbody); //llega con valor vacio
	    			}
	    		}
	    	});
	        $("#in-codigo-barra").val("");
	    }
	});

});


function click_confirmar_prestamo()
{
	$(".btn-confirmar-prestamo").click(function()
	{
		var libro     = $(this).attr("data-titulo-libro");
		var alumno    = $("#alert-alumno-success").text();
		var rutalumno = $("#alert-alumno-success").attr("data-rutalumno");
		var nro_copia = $(this).attr("data-numero-copia");
		var cod_barra = $(this).attr("data-codigobarra");

		if ( rutalumno == -1 ) {
			alertify.error("El rut indicado es invalido o no se encuentra registrado en el sistema!");
			$("#in-buscar-alumno").val("");
			$("#in-buscar-alumno").focus();
			return;
		}

		alertify.confirm('Confirmar prestamo', 'Desea confirmar el prestamo del libro a '+alumno+'?', 
			function()
			{
				$.ajax({
					url: "insert_prestamo.php",
					method: "POST",
					data: {rutalumno:rutalumno, nro_copia:nro_copia, cod_barra:cod_barra},
					dataType: "json",
					success: function(data)
					{
						if ( data.prestamo_exitoso )
						{
							alertify.success(data.mensaje);
							$("#menu-contenido").load("prestamo.php"); //Actualiza la vista prestamo
						}
						else
						{
							console.log(data.mensaje);
							alertify.error(data.mensaje);
						}
					}
				});
			}, 
			function() 
			{ 
				alertify.error('Prestamo Cancelado!')
			}
		);
	});
}

/**
 * Se llama cada vez que se apreta el boton de devolucion del prestamo
 * @return {[type]} [description]
 */
function click_confirmar_devolucion()
{
	$(".btn-confirmar-devolucion").click(function()
	{
		var nro_copia    = $(this).attr("data-numero-copia");
		var cod_barra    = $(this).attr("data-codigobarra");
				

		alertify.confirm('Confirmar devolucion', 'Esta seguro/a que desea confirmar la devolucion?', 
			function()
			{ 
				$.ajax({
					url: "update_estadoprestamo.php",
					method: "POST",
					data: {nro_copia:nro_copia, cod_barra:cod_barra},
					dataType: "json",
					success: function(data)
					{
						if ( data.fue_actualizado )
						{
							alertify.success(data.mensaje);
						}
						else
						{
							alertify.error(data.mensaje);
						}
						$("#menu-contenido").load("prestamo.php");
					}
				});
			}, 
			function(){ 
				alertify.error('Devolucion cancelada!');
			}
		);

	});
}

function accion_buscar_alumno()
{
	$("#tbody-prestamos").html("");

	var rut_alumno = $("#in-buscar-alumno").val();
	if ( rut_alumno == "" )
	{
		$("#in-buscar-alumno").addClass("is-invalid");
		$("#alert-alumno-danger").css("display", "inline-block");
		$("#alert-alumno-success").css("display", "none");
		$("#alert-alumno-success").attr("data-rutalumno", -1);

		return;
	}

	$.ajax({
		url: "select_alumno_prestamo.php",
		method: "POST",
		data: {rut_alumno:rut_alumno},
		dataType: "json",
		success: function(data)
		{
			if ( data.sin_resultados )
			{
				$("#alert-alumno-danger").css("display", "inline-block");
				$("#alert-alumno-success").css("display", "none");
				$("#alert-alumno-success").attr("data-rutalumno", -1);
			}

			else
			{
				$("#alert-alumno-danger").css("display", "none");
				$("#alert-alumno-success").css("display", "inline-block");
				$("#alert-alumno-success").attr("data-rutalumno", data.numero);
				$("#alert-alumno-success").text(data.nombre_alumno);

				var html_tbody = "";
				for ( var i=0 ; i<data.prestamos_actuales.length ; i++ )
				{
					html_tbody += "<tr>";
					html_tbody += "<td>"+data.prestamos_actuales[i][0]+"</td>";
					html_tbody += "<td>"+data.prestamos_actuales[i][1]+"</td>";
					html_tbody += "<td>"+data.prestamos_actuales[i][2]+"</td>";

					if ( data.prestamos_actuales[i][3] == 1 ) //hay atraso en la entrega
						html_tbody += '<td><strong class="px-2" style="color:red;">'+data.prestamos_actuales[i][3]+'<i class="px-2 fa fa-exclamation-triangle"></i></strong></td>';
					else //no hay atraso en la entrega del libro
						html_tbody += '<td><strong>'+data.prestamos_actuales[i][3]+'</strong></td>';

					html_tbody += '<td><button class="btn btn-success btn-sm btn-confirmar-devolucion" data-numero-copia='+data.prestamos_actuales[i][0]+' data-codigobarra='+data.prestamos_actuales[i][4]+'><i class="fa fa-check-circle"></i></button></td>';
					html_tbody += "</tr>";
				}

				$("#tbody-prestamos").html(html_tbody);
				click_confirmar_devolucion();
				$("#in-codigo-barra").focus();
			}
		}

	});
}