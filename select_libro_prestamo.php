<?php
require_once 'conexion.php';

$codigo_libro = $_POST["codigo_libro"];

$query   = "select numero, codigobarra, titulo, autorprincipal from ejemplar, libro where codigobarra=reflibro AND codigobarra=$codigo_libro"; 
$result  = mysqli_query(conectar(), $query); //todos los ejemplares


$query2  = "select refnumeroejemplar
				from alumnopideejemplar where refcodigobarralibro=$codigo_libro and entregado=0";
$result2 = mysqli_query(conectar(), $query2); //ejemplares no entregados


$ejemplares_no_entregados = array();

while( $row2 = mysqli_fetch_assoc($result2) )
{
	array_push($ejemplares_no_entregados, $row2["refnumeroejemplar"]);
}


$json_data = array();

$i = 0;
while ( $row = mysqli_fetch_assoc($result) )
{
	// Me aseguro de que el ejemplar (copia de libro) no este en uso actualmente
	if ( in_array($row["numero"], $ejemplares_no_entregados) )
	{
		continue;
	}

	$json_data[$i]["numero"]         = $row["numero"];
	$json_data[$i]["codigobarra"]    = $row["codigobarra"]; 
	$json_data[$i]["titulo"]         = $row["titulo"];
	$json_data[$i]["autorprincipal"] = $row["autorprincipal"];
	$json_data[$i]["fecha_limite"]   = date("d-m-Y", strtotime(date("d-m-Y")."+ 21 days"));

	$i++;
}



echo json_encode($json_data);
exit;

?>