<?php
require_once 'conexion.php';

$rutalumno = $_POST["rutalumno"];
$nro_copia = $_POST["nro_copia"];
$cod_barra = $_POST["cod_barra"];
$fecha_actual = date("Y-m-d");
$fecha_limite = date("Y-m-d", strtotime(date("Y-m-d")."+ 21 days"));
$entregado    = 0;

$json_data = array();
$json_data["prestamo_exitoso"] = false;
$json_data["mensaje"] = "";

$conn  = conectar();

$query = "insert into alumnopideejemplar(refnumeroalumno, refnumeroejemplar, refcodigobarralibro, fecinicio, fectermino, entregado) VALUES ($rutalumno,$nro_copia,$cod_barra,'$fecha_actual','$fecha_limite',$entregado)";

$query_contar_prestamos  = "select id 
							from alumnopideejemplar 
								where refnumeroalumno=$rutalumno and
									entregado=0";

$result_contar_prestamos  = mysqli_query($conn, $query_contar_prestamos);
$total_prestamos_activos  = mysqli_num_rows($result_contar_prestamos);
$json_data["resultados"]  = $total_prestamos_activos;
$max_prestamos_permitidos = 2;

if ( $total_prestamos_activos < $max_prestamos_permitidos )
{
	if ( mysqli_query($conn, $query) )
	{
		$json_data["prestamo_exitoso"] = true;
		$json_data["mensaje"] = "Prestamo realizado correctamente!";
	}
	else
	{
		$json_data["prestamo_exitoso"] = false;
		$json_data["mensaje"] = "Ocurrio un error al intentar realizar el prestamo!";
		//$json_data["mensaje"] = "Ocurrio un error al intentar realizar el prestamo!".mysqli_error($conn);
	}
}

else
{
	$json_data["prestamo_exitoso"] = false;
	$json_data["mensaje"] = "Error: el alumno ya ha alcanzado el maximo de prestamos permitidos (max:2)";
}

echo json_encode($json_data);
exit;

?>
