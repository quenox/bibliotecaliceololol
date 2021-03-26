<?php
require_once 'conexion.php';

$json_data = array();
$json_data["hay_prestamos"] = false;

$query = "select concat(nombres,' ' , apellidop, ' ', apellidom) as nombre, ejemplar.numero as copia, titulo, fectermino 
			from alumno, alumnopideejemplar, ejemplar, libro
				where entregado=0 and
					alumno.numero=alumnopideejemplar.refnumeroalumno and
						alumnopideejemplar.refnumeroejemplar=ejemplar.numero and
							alumnopideejemplar.refcodigobarralibro=libro.codigobarra and
								ejemplar.reflibro=libro.codigobarra";

$result = mysqli_query(conectar(), $query);
$json_data["total"]         = mysqli_num_rows($result);
$json_data["retrasados"]    = nro_prestamos_con_retraso();
$json_data["no_retrasados"] = $json_data["total"] - $json_data["retrasados"];

if ( mysqli_num_rows($result) > 0 )
{
	$json_data["hay_prestamos"] = true;
}

$i = 0;
while ( $row = mysqli_fetch_assoc($result) )
{
	$json_data["prestamos"][$i]["nombre"]     = $row["nombre"];
	$json_data["prestamos"][$i]["copia"]      = $row["copia"];
	$json_data["prestamos"][$i]["titulo"]     = $row["titulo"];
	$json_data["prestamos"][$i]["fectermino"] = $row["fectermino"];
	
	if ( comparar_fechas(date("Y-m-d"), $row["fectermino"]) == 1 ) //fecha actual > que fecha limite
		$json_data["prestamos"][$i]["retrasado"]   = true;
	else
		$json_data["prestamos"][$i]["retrasado"]   = false;
	

	$i++;
}

echo json_encode($json_data);
exit;



function nro_prestamos_con_retraso()
{
	$fecha_hoy = date("Y-m-d");
	$query     = "select id from alumnopideejemplar 
					where entregado=0 and fectermino<'$fecha_hoy'";
	$result    = mysqli_query(conectar(), $query);
	return mysqli_num_rows($result); 
}


/**
 * Compara dos fechas para determinar cual es mayor, menor o si son iguales
 * @param  [type] $fec1 [description]
 * @param  [type] $fec2 [description]
 * @return [int]       [-1 si $fec1 <  $fec2]
 * @return [int]       [ 0 si $fec1 == $fec2]
 * @return [int]       [ 1 si $fec1 >  $fec2]
 */
function comparar_fechas($fec1, $fec2)
{
	$fecha1 = strtotime($fec1);
	$fecha2 = strtotime($fec2);

	if ( $fecha1 < $fecha2 )
		return -1;
	if ( $fecha1 == $fecha2 ) 
		return 0;
	return 1;
}
?>