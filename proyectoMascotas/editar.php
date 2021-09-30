<?php 

define("_SITIO", "EDITAR");
require_once("include/config.php");
$claseUsuario = new Usuario();
$usuario=$claseUsuario->obtenerUsuario($user->getId());
if(isset($_POST['submit']) && isset($_POST['contraseña'])&& isset($_POST['ConfirmaContraseña'])	&& isset($_POST['nombre'])&& isset($_POST['apellidos'])&& isset($_POST['email'])){
	$usuario->setPassword($_POST["contraseña"]);
	$usuario->setEmail($_POST["email"]);
	$usuario->setNombre($_POST["nombre"]);
	$usuario->setApellido($_POST["apellidos"]);
	$result = $claseUsuario->actualizarUsuario($usuario, $_POST["ConfirmaContraseña"], $_FILES['fileToUpload']);
	
	if(!hayError($result)){
		header('Location: perfil.php');
	}
}
if(!$user->logueado())
	header('Location: perfil.php');
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Editar Cuenta</title>
	<meta charset = "UTF-8"> 
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
	<div id="contenedor">
		<?php 
		require ('cabecera.php');
		require ('sidebarIzq.php');
		?>
		<div id="contenido">
			<h1>Editar Cuenta</h1> 
			<?php
				if(isset($result) && hayError($result))
					echo $result["errors"][0];
			?>
			<fieldset>
				<legend>Editar</legend>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
					<div class="row">
						<h4>Nombre:</h4>
						<input name = "nombre" class="input" type="text" value="<?php echo $usuario->getNombre();?>" size="30" /> 
					</div>
					<div class="row">
						<h4>Apellidos:</h4>
						<input name = "apellidos" class="input" type="text" value="<?php echo $usuario->getApellido();?>" size="30" /> 
					</div>
					<div class="row">
						<h4>Email:</h4>
						<input name = "email" class="input" type="text" value="<?php echo $usuario->getEmail() ;?>" size="30" /> 
					</div>
					<div class="row">
					<h4>Contraseña:</h4>
						<input name = "contraseña" class="input" type="password"  value="<?php echo $usuario->getPassword(); ?>" size="30" /> 					
					</div>
					<div class="row">
						<h4>Confirma contraseña:</h4>
						<input name ="ConfirmaContraseña" class="input" type="password" value="<?php echo $usuario->getPassword(); ?>" size="30" /> 
					</div>
					<h4>Introduce tu imagen de perfil:</h4>
						<input class="botonCompra" type="file"  value= "<?php echo $usuario->getFotoPerfil(); ?>" name="fileToUpload" id="fileToUpload" />
					<br />
					<input class="botonCompra" type="submit" name="submit" value="Editar"/>
				</form>
			</fieldset>
		</div>
	<?php require ('pie.php'); ?>
	</div>
</body>
</html>