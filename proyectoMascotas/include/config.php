<?php

if(!defined("_SITIO"))
	exit(0);

ini_set('display_errors', '1');
define("RUTA_IMAGEN_PRODUCTOS", "img/products/");
define("RUTA_IMAGEN_PERFIL","img/uploads/");

session_start();

require_once "include/class_usuario.php";
if(isset($_SESSION['userID']) && isset($_SESSION['sesion']) && isset($_SESSION['nombre']) && isset($_SESSION['fotoPerfil']) && $_SESSION['sesion'] === true && $_SESSION['userID'] > 0)
	$user = new tUsuarioSesion($_SESSION['userID'],$_SESSION['sesion'],$_SESSION['esAdmin'],$_SESSION['nombre'],$_SESSION['fotoPerfil']);
else
	$user = new tUsuarioSesion(0,false,0,0,null);

function hayError($result)
{
	return !empty($result['errors']);
}
?>
