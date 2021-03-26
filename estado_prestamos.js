$(document).ready(function()
{

	$.ajax({
		url: "select_prestamos_activos.php",
		method: "POST",
		dataType: "json",
		success: function(data)
		{	
			if ( data.hay_prestamos )
			{
				var html_tbody = "";
				
				for(var i = 0; i < data["prestamos"].length; i++)
				{
					html_tbody += "<tr>";
					html_tbody += '<td><img src="background-images/status_active.gif" style="width: 30px;"></td>';
					html_tbody += "<td>"+data["prestamos"][i].nombre+"</td>";
					html_tbody += "<td>"+data["prestamos"][i].copia+"</td>";
					html_tbody += "<td>"+data["prestamos"][i].titulo+"</td>";

					if ( data["prestamos"][i].retrasado )
						html_tbody += '<td><img src="background-images/status_danger.gif" style="width: 40px;"></td>';
					else
						html_tbody += '<td></td>';					
					
					html_tbody += '<td>'+data["prestamos"][i].fectermino+'</td>';
					html_tbody += "</tr>";
				}

				$("#tbody-prestamos").html(html_tbody);
				$("#strong-atraso").html("Prestamos actuales con atraso: "+data["retrasados"]);
				$("#strong-sin-atraso").html("Prestamos actuales sin atraso: "+data["no_retrasados"]);
				$("#strong-total").html("Total: "+data["total"]);
			}

			else
			{
				alertify.warning("Actualmente no hay prestamos!");
				$("#strong-atraso").html("Prestamos actuales con atraso: 0");
				$("#strong-sin-atraso").html("Prestamos actuales sin atraso: 0");
				$("#strong-total").html("Total: 0");
			}
		}

	});



});