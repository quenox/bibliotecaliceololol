<?php
require_once 'conexion.php';

$codigo_libro = $_POST["codigo_libro"];
$autor        = $_POST["autor"];
$titulo       = $_POST["titulo"];
$editorial    = $_POST["editorial"];
$edicion      = $_POST["edicion"];
$isbn         = $_POST["isbn"];

$json_data = array();
$json_data["fue_actualizado"] = false;
$json_data["mensaje"] = "Error: No se pudieron actualizar los datos!";


if ( $autor == "" )
{
	$json_data["fue_actualizado"] = false;
	$json_data["mensaje"] = "Error: Debe indicar el autor del libro";
	echo json_encode($json_data);
	exit;
}

if ( $titulo == "" )
{
	$json_data["fue_actualizado"] = false;
	$json_data["mensaje"] = "Error: Debe indicar el titulo del libro";
	echo json_encode($json_data);
	exit;	
}



$query     = "update libro 
				set autorprincipal='$autor', titulo='$titulo', editorial='$editorial', edicion=$edicion, codigoisbn=$isbn where codigobarra=$codigo_libro";

if ( mysqli_query(conectar(), $query) )
{
	$json_data["fue_actualizado"] = true;
	$json_data["mensaje"] = "Datos actualizados exitosamente!";
}

else
{
	$json_data["fue_actualizado"] = false;
	$json_data["mensaje"] = "Error: No se pudieron actualizar los datos!";
}


echo json_encode($json_data);
exit;

?>