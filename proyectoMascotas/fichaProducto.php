<?php  
	define("_SITIO", "fichaProducto");
	require_once("include/config.php");
	require_once("include/class_producto.php");
	require_once("include/class_categoria.php");
	$producto = new Producto();
	if(isset($_GET['producto'])){
		$producto= $producto->obtenerProducto($_GET['producto']);	
	}
	else{
		$producto=null;
	}
?>
<!DOCTYPE html>
<html lang ="es">
<head>
	<title>fichaProducto</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" >
	<meta charset="utf-8">
</head>
<body>
	<div id= 'contenedor'>
		<?php 
		require ('cabecera.php');
		require ('sidebarIzq.php');
		?>
		<div id = 'contenido'>
			<?php
				if($producto!=null){
					echo "
						<div class =\"pedidos\">
							<div class = 'imgProd'>
								<img class = 'imagenFichaProducto' src=\"img/products/".rawurlencode($producto->getId()).".". $producto->getFoto()."\" alt= \"{$producto->getNombre()}\" >
							</div>
							<div class= 'descrProd'>
								<h2 class= 'tituloP'>{$producto->getNombre()}</h2>
								<h3 class= 'marca'>Marca: {$producto->getMarca()}</h3>
								<h3 class= 'talla'>Talla: {$producto->getTalla()}</h3>
								<div class = 'descripcion'>Descripion: {$producto->getDescripcion()}</div>
								<h5>PRECIO:{$producto->getPrecio()} € </h5>
							
						";
					if($producto->getStock() > 0){
							echo "<a href='cesta.php?idProducto={$producto->getId()}' class='boton'>Comprar</a>";
					}
					else {
						    echo "<span class=\"botonSinStock\">No disponible</span>";
							echo "<a href='index.php' class='boton'>Volver</a>";
					}
						
					echo "</div></div>";



				}else{
					echo "<p>Este producto no existe</p>";
				}
		echo"</div>";

		require ('pie.php');
		?>		
		
	</div>
</body>
</html>