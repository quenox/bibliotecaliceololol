<?php
session_start();
$_SESSION["cuenta_activa"] = false;


$rut  = $_POST["rut"];
$pass = $_POST["pass"];


if ( true )
{
	$_SESSION["cuenta_activa"] = true ;
	$json_data["ok"] = true;
	header("Location: menu_bibliotecario.php");
	exit;
}

else
{
	$json_data["ok"] = false;
	header("Location: index.php");
	exit;
}

?>