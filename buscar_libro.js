$(document).ready(function()
{
	$("#in-busqueda-codigobarra").focus(); //por default focus en busq. cod.barra
	read_only_inputs_search(false, true, true);

	inputs_search_mouseenter();

	$("#in-busqueda-codigobarra").keydown(function(){
		$("#in-busqueda-titulo").val("");
		$("#in-busqueda-autor").val("");
	});
	$("#in-busqueda-titulo").keydown(function(){
		$("#in-busqueda-codigobarra").val("");
		$("#in-busqueda-autor").val("");
	});
	$("#in-busqueda-autor").keydown(function(){
		$("#in-busqueda-codigobarra").val("");
		$("#in-busqueda-titulo").val("");
	});


	$("#in-busqueda-codigobarra").keyup(function(){
		var filtro     = $("#in-busqueda-codigobarra").val();
		var buscar_por = "codigobarra";
		buscar_libros(filtro, buscar_por);
	});
	$("#in-busqueda-titulo").keyup(function(){
		var filtro     = $("#in-busqueda-titulo").val();
		var buscar_por = "titulo";
		buscar_libros(filtro, buscar_por);
	});
	$("#in-busqueda-autor").keyup(function(){
		var filtro     = $("#in-busqueda-autor").val();
		var buscar_por = "autor";
		buscar_libros(filtro, buscar_por);
	});
});



function buscar_libros(filtro, buscar_por)
{
	$.ajax(
	{
		url: "select_libro_busqueda.php",
		method: "POST",
		data: {filtro:filtro, buscar_por:buscar_por},
		dataType: "json",
		success: function(data)
		{
			var html_tbody = "";
			if ( data.hay_resultados )
			{
				for ( var i=0 ; i<data.libros.length ; i++ )
				{
					html_tbody += "<tr>";
					html_tbody += " <td>"+data.libros[i].numero+"</td>";
					html_tbody += " <td>"+data.libros[i].titulo+"</td>";
					html_tbody += " <td>"+data.libros[i].autorprincipal+"</td>";
					html_tbody += " <td>"+data.libros[i].editorial+"</td>";
					html_tbody += " <td>"+data.libros[i].edicion+"</td>";
					html_tbody += "</tr>";
				}
			}

			$("#tbody-libros").html(html_tbody);
		}

	});
}



function read_only_inputs_search(codigobarra_bool, titulo_bool, autor_bool)
{
	$("#in-busqueda-codigobarra").prop("readonly", codigobarra_bool);
	$("#in-busqueda-titulo").prop("readonly", titulo_bool);
	$("#in-busqueda-autor").prop("readonly", autor_bool);	
}

function inputs_search_mouseenter()
{
	$("#in-busqueda-codigobarra").mouseenter(function(){
		read_only_inputs_search(false, true, true);
		$("#in-busqueda-codigobarra").focus();
	});

	$("#in-busqueda-titulo").mouseenter(function(){
		read_only_inputs_search(true, false, true);
		$("#in-busqueda-titulo").focus();
	});

	$("#in-busqueda-autor").mouseenter(function(){
		read_only_inputs_search(true, true, false);
		$("#in-busqueda-autor").focus();
	});	
}