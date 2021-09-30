<?php 

define("_SITIO", "ALTAPRODUCTO");
require_once("include/config.php");
require_once("include/Objetos/tProducto.php");
require_once("include/class_producto.php");
require_once("include/class_categoria.php");
require_once("include/class_especie.php");

$categoria = new Categoria();
$especie = new Especie();
//$resultCat = $categoria->obtenerTodos();
$resultEsp = $especie->obtenerTodos();



if(isset($_POST['submit']) && isset($_POST['marca']) && isset($_POST['categoria']) && isset($_POST['precio'])&& isset($_POST['descripcion'])&& isset($_POST['stock']) && isset($_POST['nombre']) && isset($_POST['talla']) ){
	$producto = new tProducto();
	$claseProducto = new Producto(); 
	$producto->setMarca($_POST["marca"]);
	$producto->setCategoria($_POST["categoria"]);
	$producto->setPrecio($_POST["precio"]);
	$producto->setDescripcion($_POST["descripcion"]);
	$producto->setStock($_POST["stock"]);
	$producto->setNombre($_POST["nombre"]);
	$producto->setTalla($_POST["talla"]);
	$result = $claseProducto->insertarProducto($producto, $_FILES['fileToUpload']);
	if(!hayError($result))
			echo "Se ha insertado un producto nuevo";
	else{
			echo "No se ha podido insertar el producto<br>";
		}
}
?>
<!DOCTYPE html>
<html lang="es">
<head> <title>AltaProducto</title>
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
			<h1>Alta Producto</h1> 
			<?php
				if(isset($result) && hayError($result))
					echo $result["errors"][0]; // solo mostramos el primero
			?>
			<fieldset>
				<legend>Formulario de alta</legend>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
					<div class="row">
						<h4>Nombre:</h4>
						<input name = "nombre" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
						<h4>Marca:</h4>
						<input name = "marca" class="input" type="text"  size="20" /> 
					</div>
					<div class="row">
						<h4>Categoria-Especie:</h4>
						<select name="categoria">
								<?php 

									foreach($resultEsp as $key=> $value){
										//$num1=1;
										$resultCat = $categoria->buscarPorEspecie($resultEsp[$key]->getId());

										foreach($resultCat as $key2=> $value2){	
									?> 
											<option value= "<?php echo $resultCat[$key2]->getId()  ?>" >
												<?php	echo $resultCat[$key2]->getNombre() . "-" . $resultEsp[$key]->getNombre() ?></option><?php
										}
	
										//$num1++;
									}
						?>
						</select>
					</div>
					<div class="row">
						<h4>Talla:</h4>
						<input name = "talla" class="input" type="text"  size="10" /> 
					</div>
					<div class="row">
						<h4>Precio:</h4>
						<input name = "precio" class="input" type="text"  size="30" /> 
					</div>
					<div class="row">
						<h4>Descripcion:</h4>
						<textarea name="descripcion" rows="4" cols="50">Escribe aqui</textarea>					
					</div>
					<div class="row">
						<h4>Stock:</h4>
						<input name ="stock" class="input" type="text"  value="1" size="1" /> 
					</div>
					<h4>Foto del Objeto:</h4>
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