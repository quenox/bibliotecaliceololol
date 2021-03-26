<?php


function conectar()
{
	$conn = mysqli_connect("localhost", "liceodel", "bolt235711131719232931", "liceodel_biblioteca");

	if (!$conn) 
	{
	    echo "Error de conexion con la bd";
	    exit;
	}
	return $conn;
}

?>


