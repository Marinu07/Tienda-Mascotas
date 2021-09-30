<?php

require_once("include/class_bd.php");

class DAOArticulosPedido
{
	private $db;
	private $table = "articulospedido";

	public function __construct()
	{
		$this->db = DB::getInstance();
	}

	public function insert(tArticuloPedido $articuloPedido)
	{
		$id_orden = $articuloPedido->getIdOrden();
		$id_producto = $articuloPedido->getIdProducto();
		$cantidad = $articuloPedido->getCantidad();
		$precio = $articuloPedido->getPrecio();

		$pdo = mysqli_connect('localhost', 'root', '', 'mascotas');
		$query = "INSERT INTO " . $this->table . " VALUES('','$cantidad','$id_producto','$id_orden','$precio')";
		if(mysqli_query($pdo, $query))
		{
			return true;
		}
		else{
			return false;
		}
	}

	function getById($id)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		
		$stmt = $pdo->prepare($query);
		echo "El id es: ".$id;
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();

			$a = new tArticuloPedido();
			$a->setId($fila['id']);
			$a->setIdOrden($fila['id_orden']);
			$a->setIdProducto($fila['id_producto']);
			$a->setCantidad($fila['cantidad']);
			$a->setPrecio($fila['precio']);
			return $a;
		}
		return false;
	}

	function getAll()
	{
		$query = "SELECT * FROM " . $this->table;
		$pdo = $this->db->getConnection();
		$query = $pdo->query($query);
		$array_articulosPedidos = array();

		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$a = new tArticuloPedido();
				$a->setId($fila['id']);
				$a->setIdOrden($fila['id_orden']);
				$a->setIdProducto($fila['id_producto']);
				$a->setCantidad($fila['cantidad']);
				$a->setPrecio($fila['precio']);

				array_push($array_articulosPedidos, $a);
			}
			return $array_articulosPedidos;
		}
		return false;
	}

	function update(tArticuloPedido $articuloPedido)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET 
			id_orden=:id_orden, id_producto=:id_producto, cantidad=:cantidad, precio=:precio
		WHERE
			id=:id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_orden',$articuloPedido->getIdOrden());
		$stmt->bindValue(':id_producto',$articuloPedido->getIdProducto());
		$stmt->bindValue(':cantidad',$articuloPedido->getCantidad());
		$stmt->bindValue(':precio',$articuloPedido->getPrecio());
		return $stmt->execute();
	}

	function delete(tArticuloPedido $articuloPedido)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $articuloPedido->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}

	function findByIdOrden($id_orden)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id_orden = :id_orden";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_orden', $id_orden);
		$resultado = $stmt->execute();
		$array_articulosPedidos = array();
		if($resultado)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$a = new tArticuloPedido();
				$a->setId($fila['id']);
				$a->setIdOrden($fila['id_orden']);
				$a->setIdProducto($fila['id_producto']);
				$a->setCantidad($fila['cantidad']);
				$a->setPrecio($fila['precio']);


				array_push($array_articulosPedidos, $a);
			}
			return $array_articulosPedidos;
		}
		return false;
	}

	function findByIdProducto($id_producto)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id_producto = :id_producto";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_producto', $id_producto);
		$resultado = $stmt->execute();
		$array_articulosPedidos = array();
		if($resultado)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$a = new tArticuloPedido();
				$a->setId($fila['id']);
				$a->setIdOrden($fila['id_orden']);
				$a->setIdProducto($fila['id_producto']);
				$a->setCantidad($fila['cantidad']);
				$a->setPrecio($fila['precio']);


				array_push($array_articulosPedidos, $a);
			}
			return $array_articulosPedidos;
		}
		return null;
	}



}

