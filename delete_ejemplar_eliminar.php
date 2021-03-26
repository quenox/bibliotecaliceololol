<?php
require_once 'conexion.php';

$codigobarra = $_POST["codigobarra"];
$nro_copia   = $_POST["nro_copia"];
$json_data   = array();

$json_data["fue_eliminado"] = false;
$json_data["mensaje"]       = "Ocurrio un error al intentar eliminar el ejemplar ";


$query  = "delete from ejemplar where numero=$nro_copia and reflibro=$codigobarra";
$conn   = conectar();

if ( mysqli_query($conn, $query) )
{
	if ( mysqli_affected_rows($conn) > 0 )
	{
		$json_data["fue_eliminado"] = true;
		$json_data["mensaje"]       = "Ejemplar eliminado exitosamente";
		echo json_encode($json_data);
		exit;
	}
}

//$json_data["mensaje"] = $json_data["mensaje"].mysqli_error($conn);

echo json_encode($json_data);
exit;
?>