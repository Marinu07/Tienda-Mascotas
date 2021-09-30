<?php 
define("_SITIO", "USUARIO");
require_once("include/config.php");
 ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" />
		<meta charset="utf-8">
		<title>Proces Login</title>
	</head>

	<body>
		<div id="contenedor">
			<?php 
				require ('cabecera.php');	
				require ('sidebarIzq.php');
			?>
				<div id='contenido'>
					<?php
						$username = htmlspecialchars(trim(strip_tags($_REQUEST["nom"])));
						$pasw = htmlspecialchars(trim(strip_tags($_REQUEST["con"])));

						$usuario = new Usuario();
						$result= $usuario->validaLogin($username, $pasw);
						if(!hayError($result)){
							echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
						}else{
							foreach ($result['errors'] as $error) {
								echo $error . "<br/>";
							}
						}
						
					?>
				</div>
			<?php
				require ('pie.php');
			?>
			
		</div>
	</body>
</html>