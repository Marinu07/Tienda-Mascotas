<?php	

require_once("Objetos/tProducto.php");
require_once("DAO/dao_producto.php");

class Producto
{
	
	private $dao;
	
	public function __construct()
	{
		$this->dao = new DAOProducto();
	}
	public function insertarProducto(tProducto $producto,$fotoPerfil)
	{
		$errores = array();
		if (!is_numeric($producto->getPrecio()))
			$errores[] = "El precio es incorrecto";
		
		if (!is_numeric($producto->getStock()))
			$errores[] = "El stock es incorrecto";
			
		if(empty($errores) && file_exists($fotoPerfil['tmp_name']) && is_uploaded_file($fotoPerfil['tmp_name'])) 
		{
			$rutaTemporal = $fotoPerfil["tmp_name"];
			$extension = strtolower(pathinfo($fotoPerfil['name'],PATHINFO_EXTENSION));
			$producto->setFoto($extension);
			
			if ($fotoPerfil["size"] > 50000000)
				$errores[] = "La imagen de perfil supera el tamaño maximo permitido";

			if(!getimagesize($rutaTemporal))
				$errores[] = "El archivo no contiene una imagen valida";
			
			if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif")
				$errores[] = "La extension de la imagen no esta soportada, solo jpg";	
		}
		if(empty($errores))
		{	
			$idProducto = $this->dao->insert($producto);
			//$prod = new tProducto();
			$prod = $this->dao->findByName($producto->getNombre());
			$id = $prod->getId();
			$rutadestino = 'img/products/'.$id.'.'.$extension;
			if(!$idProducto)
				$errores[] = "Se ha producido un error al dar de alta el producto";
			
			if(empty($errores) && !move_uploaded_file($rutaTemporal,$rutadestino)) // el fichero se ha copiado correctamente.
				$errores[] = "Se ha producido un error al dar de alta la imagen del producto";
		}
		if(empty($errores)){
			return true;
		}
		else{
			$result = array	('errors' => $errores,'data' => null);
			return $result;	
		}
	}
	public function obtenerTodos()
	{
		return $this->dao->getAll();
	}
	public function obtenerProducto($id)
	{
		return $this->dao->getById($id);
	}
	public function actualizarProducto($producto)
	{
		return $this->dao->update($producto);
	}
	public function borrarProducto($id)
	{
		return $this->dao->delete($id);
	}
	public function buscarPorCategoria($id)
	{
		return $this->dao->findByCategoria($id);
	}
	public function buscar($nombre)
	{
		return $this->dao->findByName($nombre);
	}

	public function buscarPorEspecie($id){

		return $this->dao->findByEspecie($id);
	}
	public function buscarPorStock($stock)
	{
		return $this->dao->findByStock($stock);
	}
	function findByWords($word){
		return $this->dao->findByWords($word);
	}
}
?>