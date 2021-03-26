<?php
require_once 'conexion.php';

$codigobarra = $_POST["codigobarra"];
$json_data   = array();

$json_data["fue_eliminado"] = false;
$json_data["mensaje"]       = "Ocurrio un error al intentar eliminar el libro ";

$query  = "delete from libro where codigobarra=$codigobarra";
$conn   = conectar();


if ( mysqli_query($conn, $query) )
{
	if ( mysqli_affected_rows($conn) > 0 )
	{
		$json_data["fue_eliminado"] = true;
		$json_data["mensaje"]       = "Libro eliminado exitosamente";
		echo json_encode($json_data);
		exit;
	}
}

//$json_data["mensaje"] = $json_data["mensaje"].mysqli_error($conn);

echo json_encode($json_data);
exit;
?>