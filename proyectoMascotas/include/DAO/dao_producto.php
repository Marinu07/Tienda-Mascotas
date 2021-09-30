<?php

require_once("include/class_bd.php");

class DAOProducto
{
	private $db;
	private $table = "producto";

	public function __construct()
	{
		$this->db = DB::getInstance();
	}

	public function insert(tProducto $producto)
	{
		$marca = $producto->getMarca();
		$categoria = $producto->getCategoria();
		$precio = $producto->getPrecio();
		$descripcion = $producto->getDescripcion();
		$stock = $producto->getStock();
		$nombre = $producto->getNombre();
		$talla = $producto->getTalla();
		$foto = $producto->getFoto();

		$pdo = mysqli_connect('localhost', 'root', '', 'mascotas');
		$query = "INSERT INTO " . $this->table . " VALUES ('$categoria','$descripcion','','$precio','$stock','$marca','$nombre','$talla','$foto')";

		if(mysqli_query($pdo,$query)){
			return true;
		}else{
			return false;
		}
	}

	function getById($id)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$p = new tProducto();
			$p->setId($fila['id']);
			$p->setMarca($fila['marca']);
			$p->setCategoria($fila['categoria']);
			$p->setPrecio($fila['precio']);
			$p->setDescripcion($fila['descripcion']);
			$p->setStock($fila['stock']);
			$p->setNombre($fila['nombre']);
			$p->setTalla($fila['talla']);
			$p->setFoto($fila['foto']);

			return $p;
		}
		return false;

	}

	function getAll() 
	{
		$query = "SELECT * FROM " . $this->table;
		$pdo = $this->db->getConnection();
		$query = $pdo->query($query);
		$array_productos = array();

		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tProducto();
				$p->setId($fila['id']);
				$p->setMarca($fila['marca']);
				$p->setCategoria($fila['categoria']);
				$p->setPrecio($fila['precio']);
				$p->setDescripcion($fila['descripcion']);
				$p->setStock($fila['stock']);
				$p->setNombre($fila['nombre']);
				$p->setTalla($fila['talla']);
				$p->setFoto($fila['foto']);

				array_push($array_productos, $p);
			}
			return $array_productos;
		}
		return false;
	}

	function update(tProducto $producto)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET
			 marca=:marca, categoria=:categoria, precio=:precio, descripcion=:descripcion, stock=:stock, nombre=:nombre, talla=:talla, foto=:foto
		WHERE
			id=:id";
		$stmt = $pdo->prepare($query);

		$stmt->bindValue(':id', $producto->getId());
		$stmt->bindValue(':marca', $producto->getMarca());
		$stmt->bindValue(':categoria', $producto->getCategoria());
		$stmt->bindValue(':precio', $producto->getPrecio());
		$stmt->bindValue(':descripcion', $producto->getDescripcion());
		$stmt->bindValue(':stock', $producto->getStock());
		$stmt->bindValue(':nombre', $producto->getNombre());
		$stmt->bindValue(':talla', $producto->getTalla());
		$stmt->bindValue(':foto',$producto->getFoto());

		return $stmt->execute();
	}

	function delete(tProducto $producto)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $usuario->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}

	function findByMarca($marca){
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where marca = :marca";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':marca', $marca);
		$resultado = $stmt->execute();
		if($resultado)
		{
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tProducto();
				$p->setId($fila['id']);
				$p->setMarca($fila['marca']);
				$p->setCategoria($fila['categoria']);
				$p->setPrecio($fila['precio']);
				$p->setDescripcion($fila['descripcion']);
				$p->setStock($fila['stock']);
				$p->setNombre($fila['nombre']);
				$p->setTalla($fila['talla']);
				$p->setFoto($foto['foto']);

				return $p;
			}
		}
		return null;
	}

	function findByName($nombre){
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where nombre = :nombre";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':nombre', $nombre);
		$resultado = $stmt->execute();
		if($resultado)
		{
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tProducto();
				$p->setId($fila['id']);
				$p->setMarca($fila['marca']);
				$p->setCategoria($fila['categoria']);
				$p->setPrecio($fila['precio']);
				$p->setDescripcion($fila['descripcion']);
				$p->setStock($fila['stock']);
				$p->setNombre($fila['nombre']);
				$p->setTalla($fila['talla']);
				$p->setFoto($fila['foto']);

				return $p;
			}
		}
		return null;
	}

	function findByCategoria($categoria){
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where categoria = :categoria";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':categoria', $categoria);
		$resultado = $stmt->execute();
		$array_productos = array();
		if($resultado)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tProducto();
				$p->setId($fila['id']);
				$p->setMarca($fila['marca']);
				$p->setCategoria($fila['categoria']);
				$p->setPrecio($fila['precio']);
				$p->setDescripcion($fila['descripcion']);
				$p->setStock($fila['stock']);
				$p->setNombre($fila['nombre']);
				$p->setTalla($fila['talla']);
				$p->setFoto($fila['foto']);

				array_push($array_productos, $p);
			}
			return $array_productos;
		}
		return false;
	}

	function findByWords($word){
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " WHERE nombre LIKE '%$word%'";
		$stmt = $pdo->query($query);
		$array_productos = array();
		if($stmt)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tProducto();
				$p->setId($fila['id']);
				$p->setMarca($fila['marca']);
				$p->setCategoria($fila['categoria']);
				$p->setPrecio($fila['precio']);
				$p->setDescripcion($fila['descripcion']);
				$p->setStock($fila['stock']);
				$p->setNombre($fila['nombre']);
				$p->setTalla($fila['talla']);
				$p->setFoto($fila['foto']);
				array_push($array_productos, $p);
			}
			return $array_productos;
		}
		return false;
	}


}
?>