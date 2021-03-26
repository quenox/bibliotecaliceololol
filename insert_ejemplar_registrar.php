<?php
require_once 'conexion.php';


$codigobarra = $_POST["codigobarra"];
$int_copia   = $_POST["int_copia"];

$conn   = conectar();
$query  = "insert into ejemplar values($int_copia, $codigobarra, 'Desconocida')";

$json_data = array();

if ( $int_copia <= 0 )
{
	$json_data["fue_registrado"] = false;
	$json_data["mensaje"] = "Error: No se permiten valores inferiores a 1";
	echo json_encode($json_data);
	exit;
}

if ( mysqli_query($conn, $query) )
{
	$json_data["fue_registrado"] = true;
	$json_data["mensaje"] = "Copia del libro creada exitosamente!";
}

else
{
	$json_data["fue_registrado"] = false;
	if ( mysqli_errno($conn) == 1062 ) //Duplicate entry error code
		$json_data["mensaje"] = "Error: La copia ".$int_copia." del libro ya se encontraba registrada!";
	else
		$json_data["mensaje"] = "Ocurrio un error al intentar registrar la copia del libro!";		
}

echo json_encode($json_data);
exit;
?>