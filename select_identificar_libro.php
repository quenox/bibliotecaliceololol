<?php
require_once 'conexion.php';

$codigobarra = $_POST["codigobarra"];

$query  = "select * from libro where codigobarra=$codigobarra";
$result = mysqli_query(conectar(), $query);
$libro  = mysqli_fetch_assoc($result);

$json_data = array();


if ( mysqli_num_rows($result) == 0 )
{
	$json_data["hay_resultados"] = false;
	$json_data["mensaje"] = "Error: El codigo del libro no se encuentra registrado";
}
else
{
	$json_data["hay_resultados"] = true;
	$json_data["libro"] = $libro;
}

echo json_encode($json_data);
exit;
?>