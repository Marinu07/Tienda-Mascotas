<?php 

define("_SITIO", "REGISTRO");
require_once("include/config.php");

if(isset($_POST['submit']) && isset($_POST['usuario']) && isset($_POST['contraseña'])&& isset($_POST['ConfirmaContraseña'])	&& isset($_POST['nombre'])&& isset($_POST['apellidos'])&& isset($_POST['email']))//&& isset($_POST['telefono']))
{
	$claseUsuario = new Usuario();
	$usuario = new tUsuario();

	$usuario->setUsername(htmlspecialchars(trim(strip_tags($_POST["usuario"]))));
	$usuario->setPassword(htmlspecialchars(trim(strip_tags($_POST["contraseña"]))));
	$usuario->setNivel_Acceso(1);
	$usuario->setEmail(htmlspecialchars(trim(strip_tags($_POST["email"]))));
	$usuario->setNombre(htmlspecialchars(trim(strip_tags($_POST["nombre"]))));
	$usuario->setApellido(htmlspecialchars(trim(strip_tags($_POST["apellidos"]))));
	//$usuario->setTelefono($_POST["telefono"]);
	$con = htmlspecialchars(trim(strip_tags($_POST["ConfirmaContraseña"])));
	$result = $claseUsuario->insertarUsuario($usuario, $con, $_FILES["fileToUpload"]);

	if(!hayError($result))
		header('Location: login.php');
}
if($user->logueado())
	header('Location: perfil.php');
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Registro</title>
	<meta charset = "UTF-8"> 
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
	<div id="contenedor">
		<?php require ('cabecera.php');
		  require ('sidebarIzq.php');?>
	
		<div id="contenido">
			<h1>Registro</h1> 
			<?php
				if(isset($result) && hayError($result))
					echo $result["errors"][0]; // solo mostramos el primero
			?>
			<fieldset>
				<legend>Formulario de registro</legend>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
					<div class="row">
						<h4>Nombre:</h4>
						<input name = "nombre" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
						<h4>Apellidos:</h4>
						<input name = "apellidos" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
						<h4>Email:</h4>
						<input name = "email" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
						<h4>Usuario:</h4>
						<input name = "usuario" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
					<h4>Contraseña:</h4>
						<input name = "contraseña" class="input" type="password"  size="30" /> 					
					</div>
					<div class="row">
						<h4>Confirma contraseña:</h4>
						<input name ="ConfirmaContraseña" class="input" type="password"  size="30" /> 
					</div>
					<h4>Introduce tu imagen de perfil:</h4>
						<input class="botonCompra" type="file" name="fileToUpload" id="fileToUpload" />
					<br />
					<input class="botonCompra" type="submit" name="submit" value="Registrar"/>
				</form>
			</fieldset>
		</div>
		<?php require ('pie.php'); ?>
	</div>
</body>
</html>