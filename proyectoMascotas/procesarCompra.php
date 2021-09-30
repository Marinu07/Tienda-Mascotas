<?php
define("_SITIO", "PROCESARCOMPRA");
require_once("include/config.php");
require_once("include/class_cesta.php");
require_once("include/class_pedido.php");

if(!$user->logueado())
	header('Location: login.php?return_to=/procesarCompra.php');

$cesta = new Cesta();
$listacesta = $cesta->obtenerCesta();
$precioCesta = $cesta->obtenerPrecioTotalCesta();

$usuario = new Usuario();
$datosUsuario = $usuario->obtenerUsuario($user->getId());

if(isset($_POST['submit'])) // todos los datos son correctos se confirma sin añadir mas informacion.
{
		$clasePedido = new Pedido();
		$result = $clasePedido->crearPedido($user->getId());
}
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Proceso de Compra</title>
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
			
			<h1>Pedido</h1>
			<?php 
			if(!isset($result))
			{
				if(!$user->logueado())
				{
					alert("inicia sesión primero");
			?>
					<a href="registro.php" class="botonCompra">Registro</a>	
					<a href="login.php?return_to=/procesarCompra.php" class="botonCompra">Login</a>	<!-- Te devuelve al inicio-->
			<?php
				}
				else if(empty($listacesta))
				{
					echo"<h2> Tu cesta está vacía</h2>";
					echo "<p> Mira la <a href=\"tienda.php\" >tienda</a> a ver si hay algo que te interesa";
				}
				else
				{
					?>
					<h2>Confirmar datos</h2>
					<div id="divProcesarCompra">
						<div id= "datos_usuario">
							<?php
							echo "Usuario: {$datosUsuario->getUsername()}<br />";
							echo "Nombre: {$datosUsuario->getNombre()}<br />";
							echo "Apellidos: {$datosUsuario->getApellido()}<br />";
							echo "Email: {$datosUsuario->getEmail()}<br />";
						echo "</div><div id ='datos_producto'>";
						echo "<br/><table class=\"tienda2\">";
						echo "<thead><tr><td>Productos</td><td>Precio</td><td>Cantidad</td></tr><thead><tbody>";
						foreach($listacesta as $p)
							echo "<tr> <td>&nbsp;{$p->getNombre()} </td><td> {$p->getPrecio()} € </td><td> {$p->getCantidad()}</td></tr>";
						echo "</tbody></table><br/>Total a pagar: {$precioCesta} €</div>";
						?>
						<div class="fieldset">
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class = "form-">
								<br/> <button class="botonCompra" type="submit" name="submit">Realizar Compra</button>
							</form>
							
						</div>
					</div>
					<?php
				}
			}
			else if(hayError($result))
			{
				echo "Error: " . $result["errors"][0];
			}
			else
				echo 'El pedido se ha procesado correctamente, <a href="pedidos.php">Pincha aqui</a> para ver el estado de tus pedidos';
		?>
				
		</div>
		<?php require ('pie.php'); ?>
	</div>
		
	
</body>
</html>