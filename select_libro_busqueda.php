<?php
require_once 'conexion.php';

$filtro     = $_POST["filtro"];
$buscar_por = $_POST["buscar_por"];

if ( $buscar_por == "codigobarra" )
{
	$query  = "select ejemplar.numero as numero, titulo, autorprincipal, editorial, edicion 
				from ejemplar, libro 
					where libro.codigobarra=ejemplar.reflibro AND libro.codigobarra=$filtro";
}

if ( $buscar_por == "titulo" )
{
	$query  = "select ejemplar.numero as numero, titulo, autorprincipal, editorial, edicion 
			from ejemplar, libro 
				where (libro.codigobarra=ejemplar.reflibro) AND (titulo like '%$filtro%')";	
}

if ( $buscar_por == "autor" )
{
	$query  = "select ejemplar.numero as numero, titulo, autorprincipal, editorial, edicion 
			from ejemplar, libro 
				where (libro.codigobarra=ejemplar.reflibro) AND (autorprincipal like '%$filtro%')";	
}



$result    = mysqli_query(conectar(), $query);
$json_data = array();



$i = 0;
while ( $row = mysqli_fetch_assoc($result) )
{
	$json_data["libros"][$i++] = $row;
}

if ( $i != 0 )
{
	$json_data["hay_resultados"] = true;
}
else
{
	$json_data["hay_resultados"] = false;
}

echo json_encode($json_data);
exit;
?>