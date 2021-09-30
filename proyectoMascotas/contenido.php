<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" >
		<meta charset="utf-8">
		<title>Contenido</title>
	</head>

	<body>
		<div id="contenedor">
			<?php 
				require ('cabecera.php');	
				require ('sidebarIzq.php');
				require ('sidebarDer.php');
			?>
			<div id="contenido">
				<?php 
					if( isset($_SESSION["login"]) && ($_SESSION["login"]===true) ){
						echo "<h1>Hola, {$_SESSION['nombre']} bienvenido a la zona exclusiva de socios </h1>";
						echo "<h4>Datos importantes de la empresa:</h4>";
						echo "Contraseña wifi: 1gHs8Kss72pL ";
					}else
						echo "<h1>ERROR</h1><h3>No estás registrado >:(  inicia sesión <a href='login.php'>aquí</a></h3>";
				?>
			</div>
		</div>
		<?php require ('pie.php');?>
	</body>
</html>