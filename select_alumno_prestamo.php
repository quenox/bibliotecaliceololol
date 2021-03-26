<?php
require_once 'conexion.php';

$rut_alumno = $_POST["rut_alumno"];

//datos del alumno
$query  = "select numero, nombres, apellidop from alumno where numero=$rut_alumno";
$result = mysqli_query(conectar(), $query);
$tuplas = mysqli_num_rows($result);
$row    = mysqli_fetch_assoc($result);

$json_data = array();
$json_data["sin_resultados"] = true;
$json_data["nombre_alumno"]  = "Sin resultados.";

if ( $tuplas != 0 )
{
	$json_data["sin_resultados"] = false;
	$json_data["numero"]         = $row["numero"];
	$json_data["nombre_alumno"]  = $row["nombres"]." ".$row["apellidop"];
}

else
{
	echo json_encode($json_data);
	exit;
}

//prestamos del alumno
$query2  = "select refnumeroejemplar, titulo, autorprincipal, fectermino, codigobarra
				from alumnopideejemplar, libro
					where refcodigobarralibro=codigobarra and refnumeroalumno=$rut_alumno and entregado=0";

$result2 = mysqli_query(conectar(), $query2);

$json_data["prestamos_actuales"] = array();
$i = 0;
while ( $row2 = mysqli_fetch_assoc($result2) )
{
	$json_data["prestamos_actuales"][$i][] = $row2["refnumeroejemplar"];  
	$json_data["prestamos_actuales"][$i][] = $row2["titulo"];
	$json_data["prestamos_actuales"][$i][] = $row2["autorprincipal"];

	$fecha_actual = new DateTime(date("Y-m-d"));
	$fecha_limite = new DateTime($row2["fectermino"]);
	$diferencia   = $fecha_actual->diff($fecha_limite);

	if ( comparar_fechas(date("Y-m-d"), $row2["fectermino"]) == -1 ) //fec actual menor que fec max! :)
		$json_data["prestamos_actuales"][$i][] = 0;
	if ( comparar_fechas(date("Y-m-d"), $row2["fectermino"]) == 0 ) //fec actual igual que fec max! :|
		$json_data["prestamos_actuales"][$i][] = 0;
	if ( comparar_fechas(date("Y-m-d"), $row2["fectermino"]) == 1 ) //fec actual menor que fec max! :(
		$json_data["prestamos_actuales"][$i][] = $diferencia->days;

	$json_data["prestamos_actuales"][$i][]  = $row2["codigobarra"];
	$i++;
}


echo json_encode($json_data);
exit;


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