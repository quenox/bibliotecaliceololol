<?php
require_once 'conexion.php';

$codigo_barra = $_POST["codigo_barra"];
$autor_libro  = $_POST["autor_libro"];
$titulo_libro = $_POST["titulo_libro"];
$editorial    = $_POST["editorial"];
$nro_edicion  = $_POST["nro_edicion"];
$codigo_isbn  = $_POST["codigo_isbn"];
$copias_libro = $_POST["copias_libro"];


$json_data = array();
$json_data["libro_creado"]    = false;
$json_data["copias_creadas"]  = false;
$json_data["mensaje"]["error"]        = "Error: ";
$json_data["mensaje"]["confirmacion"] = "Libro registrado exitosamente!";

$conn   = conectar();

$query1 = "insert into libro values($codigo_barra, '$autor_libro', '$titulo_libro', '$editorial', $nro_edicion, $codigo_isbn)";

if ( mysqli_query($conn, $query1) ) {
	$json_data["libro_creado"] = true;
}

else
{
	$json_data["libro_creado"]     = false;
	$json_data["mensaje"]["error"] = $json_data["mensaje"]["error"].mysqli_error($conn);
	echo json_encode($json_data);
	exit;
}

for ( $i=1 ; $i<=$copias_libro ; $i++ )
{
	$query2 = "insert into ejemplar values($i, $codigo_barra, 'Desconocida')";

	if ( mysqli_query($conn, $query2) ) 
	{
		$json_data["copias_creadas"] = $json_data["copias_creadas"] && true;
	}
	else
	{
		$json_data["copias_creadas"]   = false;
		$json_data["mensaje"]["error"] = $json_data["mensaje"]["error"].mysqli_error($conn);
		break; 
	}
}

echo json_encode($json_data);
exit;
?>