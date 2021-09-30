<?php //session_start();
	define("_SITIO", "login");
	require_once("include/config.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" >
		<meta charset="utf-8">
		<title>Login</title>
	</head>

	<body>
		<div id="contenedor">
			<?php 
				require ('cabecera.php');	
				require ('sidebarIzq.php');
				//require ('sidebarDer.php');
			?>
				<div id='contenido'>
					<h1>Acceso al sistema</h1>
					<form action="procesarLogin.php" method="POST">
						<fieldset>
							<label>Usuario:</label> <input type="text" name="nom">
							<label>Contraseña:</label> <input type="password" name="con">
							<button type="Submit">Entrar</button>
							<button type="Submit"><a href="altausuario.php" class="botonCompra">Darse de alta</a></button>
						</fieldset>
					</form>					
				</div>
			<?php
				require ('pie.php');
			?>
			
		</div>
	</body>
</html>