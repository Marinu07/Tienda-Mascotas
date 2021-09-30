<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" >
		<meta charset="utf-8">
		<title>Admin</title>
	</head>

	<body>
		<div id="contenedor">
			<?php 
				require ('cabecera.php');	
				require ('sidebarIzq.php');
				require ('sidebarDer.php');
				echo "<div id='contenido'>";
					if( isset($_SESSION["login"]) && ($_SESSION["login"]===true) && ($_SESSION["esAdmin"]===true) )
						echo "Hola Admin, que tal?";
					else
						echo " <h1>No eres un admin fuera de aquí!!!!!</h1>";
				echo "</div>";	
				require ('pie.php');
			?>
			
		</div>
	</body>
</html>