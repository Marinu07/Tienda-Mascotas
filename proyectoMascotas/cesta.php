<?php

define("_SITIO", "CESTA");
require_once("include/config.php");
require_once("include/class_cesta.php");

$cesta = new Cesta();

if(isset($_GET['idProducto'])){
	$resultado = $cesta->insertarEnCesta($_GET['idProducto']);
	if(!$resultado)
		$errno = "No se ha podido añadir a la cesta"; 
}

if(isset($_GET['borrarProductoCesta'])){
	$cesta->borrarProductoCesta($_GET['borrarProductoCesta']);
}

if(isset($_GET['disminuirCantidad'])){
	$cesta->disminuirCantidad($_GET['disminuirCantidad']);
}

if(isset($_GET['aumentarCantidad'])){
	$cesta->aumentarCantidad($_GET['aumentarCantidad']);
}

?>
<!DOCTYPE html>
<html lang ="es">
<head>
	<title>Cesta</title>
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
				echo (isset($errno))? $errno : '';
				$listaCesta = $cesta->obtenerCesta();
				$precioFin = 0;
				if(count($listaCesta)>0){
					echo "<table class=\"tienda2\">";
					echo   "<thead>
								<tr class=\"cabecera_td\">
									<td>Producto</td>
									<td>Nombre</td>
									<td>Marca</td>
									<td>Talla</td>
									<td>Precio</td>
									<td>Cantidad</td>
									<td>Stock</td>
									<td>Eliminar</td>
								</tr>
							</thead>
							<tbody>";
					
					foreach ($listaCesta as $p ) {
				
						echo "
							<tr>
								<td><img id= 'img_cesta' src=\"img/products/".rawurlencode($p->getId()).".".$p->getFoto()."\"alt=\"{$p->getNombre()}\"></td>
								<td>{$p->getNombre()}</td>
								<td>{$p->getMarca()}</td>
								<td>{$p->getTalla()}</td>
								<td>{$p->getPrecio()} €</td>
								<td> <a class=\"plain-text\" href=\"cesta.php?disminuirCantidad={$p->getId()}\"> - </a>
								<input class=\"form-control basketQuantity validate-integer\" name=\"{$p->getId()}\" value=\"{$p->getCantidad()}\" type=\"text\">
								<a class=\"plain-text\" href=\"cesta.php?aumentarCantidad={$p->getId()}\"> + </a>
								</td>
								<td>";
								echo $p->getStock();

								echo "</td><td><a href=\"cesta.php?borrarProductoCesta={$p->getId()}\" class=\"boton2\">X</a></td>";
								$precioFin = $precioFin + $p->getPrecio() * $p->getCantidad();
					}
					echo "<tr><td colspan=\"3\"><a href=\"procesarCompra.php\" class=\"botonCompra\">Finalizar compra</a></td>";
					echo "<td><span class=\"precioFin\">Total: $precioFin €</span></td><td colspan=\"3\"></td></table>";

				}
				else{
					echo "La cesta esta vacía. <a href=\"index.php\" class=\"botonCompra\">Ir a la Tienda</a>";
				}
			
				
		echo"</div>";

		require ('pie.php');
			?>		
		
	</div>
</body>
</html>