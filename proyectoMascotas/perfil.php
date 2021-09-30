<?php 
define("_SITIO", "PERFIL");
require_once("include/config.php");
require_once("include/class_producto.php");

if(!$user->logueado()){

	header('Location: login.php?return_to=/perfil.php');
}

$usuario = new Usuario();
$datosUsuario = $usuario->obtenerUsuario($user->getId());

?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Mi perfil</title>
	<meta charset = "UTF-8"> 
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>	
	<div id="contenedor">
		<?php
			require ('cabecera.php'); 
			require ('sidebarIzq.php');?>
		<div id="contenido">
			<div id="novedades">
				<ul class="UlNovedades">
					<li class="vertical"><a class ="botonSubmenu" href="pedidos.php">Mis pedidos</a></li>
				</ul>
			</div>	
			<?php

				echo "<div class=\"perfil\">";
				if($datosUsuario->getFotoperfil()=="") {
					echo "<div class=\"FotoEnPerfil\"><img class=\"centerPerfil\" alt=\"Foto producto\" src=".RUTA_IMAGEN_PERFIL."foto_perfil_defecto.jpg></div>";
				}
				else {
					echo "<div class=\"FotoEnPerfil\"><img class=\"centerPerfil\" alt=\"Foto producto\" src=".RUTA_IMAGEN_PERFIL.$user->getId().".".$datosUsuario->getFotoperfil()."></div>";
				}
				echo"<div class ='infoperf'> <h4>Nombre / Alias: ".$datosUsuario->getNombre()."/".$datosUsuario->getUsername()." </h4>";
				echo "<h4>Email: ".$datosUsuario->getEmail()."</h4>";
				echo "<a href=\"editar.php\">Editar información</a>"."<br/>";
				echo "<a href=\"pedidos.php\" > Ver tus pedidos </a></div></br></div>";
				
			?>
		</div>	

		<?php 
		require ('pie.php');
		?>
	</div>
</body>
</html>