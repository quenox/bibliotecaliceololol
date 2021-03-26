<?php
require_once 'conexion.php';

$codigo_libro = $_POST["codigo_libro"];

$json_data = array();
$query     = "select * from libro where codigobarra=$codigo_libro";
$result    = mysqli_query(conectar(), $query);

if ( mysqli_num_rows($result) == 1 )
{
	$json_data["libro_existe"] = true;
}

else
{
	$json_data["libro_existe"] = false;
}

$json_data["libro"] = mysqli_fetch_assoc($result);

echo json_encode($json_data);
exit;

?>