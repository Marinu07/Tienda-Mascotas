<?php
require_once("include/config.php");
?>
<div id= "cabecera">
	<a href="index.php"><div id= "imagen-logo"></div> </a> 
	<?php 
		if($user->logueado())
		{
			$claseUsuario = new Usuario();
			$usuario=$claseUsuario->obtenerUsuario($user->getId());
			if($usuario->getFotoPerfil()==""){
				echo '<div class="saludo">Bienvenido, <a class="white-text" href="perfil.php">'.$user->getNombre() .' </a><a href="cesta.php"><img src="img/cesta.png" alt="cesta" class="centerCesta"></a>&nbsp; &nbsp;<a class="log" href="logout.php">(Salir)</a></div>';
			}
			else{
				echo '<div class="saludo">Bienvenido, <a class="white-text" href="perfil.php">'.$user->getNombre() .'</a><a href="cesta.php"><img src="img/cesta.png" alt="cesta" class="centerCesta"></a>&nbsp; &nbsp;<a class="log" href="logout.php">(Salir)</a></div>';
			}
		}
		else
		{
			?>
				<div class="saludo">Usuario desconocido.   <a class="log" href="login.php?return_to=<?php echo $_SERVER["REQUEST_URI"]; ?>">Login</a>	</div>
			<?php
		}
	?>
	<div class="titulo"><h1>TIENDA DE ANIMALES</h1></div>	
</div>
<div class="menu">	
		<a href="perfil.php" class="botonMenu">Perfil</a>
		<a href="index.php" class="botonMenu">Tienda</a>
		<?php
		if($user->logueado() && $usuario->getNivel_Acceso()=="1"){
			echo '<a href="altaproducto.php" class="botonMenu">Alta Producto</a> ';
		}
		?>
</div>
	
	
