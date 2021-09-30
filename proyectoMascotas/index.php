<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head> <title>Tienda</title>
		<link rel="stylesheet" type="text/css" href="css/estilo.css" >
		<meta charset="utf-8">
</head>
<body>
<?php 
define("_SITIO", "CarchCar");
require_once("include/config.php");
require_once("include/class_producto.php");
require_once("include/class_categoria.php");


$productos = array();
$produ = new Producto();
$categoria = new Categoria();
if(isset($_REQUEST['buscarNom'])){
	$busqueda = htmlspecialchars(trim(strip_tags($_REQUEST['buscarNom'])));
	$productos = $produ->findByWords($busqueda);
}
elseif(isset($_GET['buscar'])){
	$busqueda = htmlspecialchars(trim(strip_tags($_GET['buscar'])));
	$productos = $produ->buscar($busqueda);
}
elseif(isset($_GET['especie'])){
	$busqueda = htmlspecialchars(trim(strip_tags($_GET['especie'])));
	$cat = $categoria->buscarPorEspecie($busqueda);
	$subcat = "";
	foreach($cat as $categoria){
		$subcat .= "<li class ='subcat'><a href='index.php?cat={$categoria->getId()}&especie={$_GET['especie']}'>{$categoria->getNombre()}</a></li>";
		if(!isset($_GET['cat'])){
			$pro = $produ->buscarPorCategoria($categoria->getId());
			if($pro){
				foreach($pro as $producto ){
					array_push($productos, $producto);
				}
			}
		}
	}
	if(isset($_GET['cat'])){
		$cat = htmlspecialchars(trim(strip_tags($_GET['cat'])));
		$pro = $produ->buscarPorCategoria($cat);
			if($pro){
				foreach($pro as $producto ){
					array_push($productos, $producto);
				}
			}
		

	}
}	
else{
	$productos = $produ->obtenerTodos();
}
	echo "<div id='contenedor'>";
		require ('cabecera.php');
		require ('sidebarIzq.php');
		?>		
		<div id = "contenido">
			<?php
			if(isset($_GET['especie'])) echo $subcat;
			$cant =false;
				echo "<div class='pedidos'>";
				foreach($productos as $producto)
				{
					
					if(!empty($producto)){
						echo "<div class='producto'>
							<div class = 'fotoProdDiv'>
								<a class = 'linkfoto' href=\"fichaProducto.php?producto={$producto->getId()}\"><img class='fotoProd' src=\"img/products/".rawurlencode($producto->getId()).".".$producto->getFoto()."\" alt=\"{$producto->getMarca()}\" ></a>
							</div>
							<div class= 'datosProd'>
							
							<a class='nombreProd' href=\"fichaProducto.php?producto={$producto->getId()}\">{$producto->getNombre()}</a><br />
							<div ><p>{$producto->getMarca()}</p></div>
								<div class='precios'>{$producto->getPrecio()} €  ";
									if($producto->getStock() > 0){
										echo "<a href='cesta.php?idProducto= {$producto->getId()} ' class='botoncompra'> Comprar</a>";
									}
									else echo "<span class=\"botonSinStock\">No disponible</span>";
							
						echo "</div></div>
							</div>";
						$cant = true;
					}					
				}
				if(!$cant){
					echo "Lo sentimos, todavía no hay productos de ese tipo:(<br/>";
				}
				echo "</div>";
			  ?>
		</div>
			
		<?php 
		require ('pie.php');
		?>
	</div>
	
</body>
</html>
