<?php
require_once 'conexion.php';


$nro_copia = $_POST["nro_copia"];
$cod_barra = $_POST["cod_barra"];


$json_data = array();

$json_data["fue_actualizado"] = false;
$json_data["mensaje"] = "Lo sentimos, ha ocurrido un error. Vuelva a intentarlo mas tarde!";


$query = "update alumnopideejemplar set entregado=1 where refnumeroejemplar=$nro_copia";

if ( mysqli_query(conectar(), $query) )
{
	$json_data["fue_actualizado"] = true;
	$json_data["mensaje"] = "La entrega del libro ha sido confirmada!";
}

else
{
	$json_data["fue_actualizado"] = false;
	$json_data["mensaje"] = "Error: No se pudo confirmar la entrega!";
}

echo json_encode($json_data);
exit;


?>