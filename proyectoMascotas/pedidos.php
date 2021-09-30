<?php 
define("_SITIO", "PEDIDOS");
require_once("include/config.php");
require_once("include/class_pedido.php");
require_once("include/class_producto.php");

if(!$user->logueado()){

	header('Location: login.php?return_to=/perfil.php');
}

$classpedido = new Pedido();
$pedidos =$classpedido->buscarPedidosPorIdUsuario($user->getId());
$classproducto = new Producto();
$cusuario = new Usuario();
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Mis pedidos</title>
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
				<?php
					if(!$pedidos){
						echo "¡Vaya! Todavía no has comprado nada, échale un vistazo a la <a class =\"botonCompra\" href=\"index.php\" > Tienda </a> a ver si te interesa algo.</tr>";
					}
					else{
						echo "<div class ='pedidos'>";
						
						foreach ($pedidos as $pedido) {
							echo "<div class=\"producto\">";
							echo "
							<p name=\"id\" type=\"id\">Id de pedido: {$pedido->getId_pedido()}</p>
							<p>Precio final: {$pedido->getPrecioTotal()} euros</p>
							<p>Fecha de Compra: {$pedido->getFecha()} </p>
							<p>Productos:</p> ";
							$pedidosUsuario = $classpedido->buscarPorIdPedido($pedido->getId_pedido());
							foreach($pedidosUsuario as $product){
								$productoporPedido= $classproducto->obtenerProducto($product->getidProducto());
								echo "<div class=\"divPedidos\"><span class=\"pPedidos\">{$productoporPedido->getNombre()} {$productoporPedido->getCategoria()}</span>
								<div class=\"divPedidosPeque\"><img class=\"centerPedidos\" src=\"img/products/" . rawurlencode($productoporPedido->getId()).".".$productoporPedido->getFoto()."\" ></div></div>";
							}
							echo "</div>";
						}
						echo "</div>";
						
					}
				  ?>
		</div>	

		<?php
		require ('pie.php');
		?>
	</div>
</body>
</html>