<?php 
define("_SITIO", "LOGOUT");
require_once("include/config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" >
		<meta charset="utf-8">
		<title>Logout</title>
	</head>

	<body>
		<div id="contenedor">
			<?php 
				require ('cabecera.php');	
				require ('sidebarIzq.php');
				$usu = new Usuario();
				$usu -> cerrarSesion();
				echo "<div id='contenido'><h2>Hasta luego Lucas</h2></div>";

				require ('pie.php');
			?>
			
		</div>
	</body>
</html>