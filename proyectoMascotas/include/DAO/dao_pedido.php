<?php

require_once("include/class_bd.php");

class DAOPedido
{
	private $db;
	private $table = "pedidos";

	public function __construct()
	{
		$this->db = DB::getInstance();
	}
    public function insert(tPedido $pedido)
	{
		$idUsuario = $pedido->getidUsuario();
		$precioTotal = $pedido->getPrecioTotal();
		$pdo = mysqli_connect('localhost', 'root', '', 'mascotas');
		$hoy = date("Y-m-d");
		$query = "INSERT INTO " . $this->table . " VALUES ('','$idUsuario','$precioTotal','$hoy')";
		echo $query;
		if (mysqli_query($pdo, $query)) {
			return true;
		} 
		else {
			return false;
		}	
	}
    function getById($id)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id_orden = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':id', $id);
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$p = new tPedido();
			$p->setId_pedido($fila['id_pedido']);
			$p->setIdUsuario($fila['id_usuario']);
			$p->setPrecioTotal($fila['precio_total']);
			$p->setFecha($fila['fecha']);
			return $p;
		}
		else
			return false;
	}
    function getAll()
	{
		$query = "SELECT * FROM " . $this->table;
		$pdo = $this->db->getConnection();
		$query = $pdo->query($query);
		$array_pedidos = array();
		
		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tPedido();
				$p->setId_pedido($fila['id_pedido']);
				$p->setIdUsuario($fila['id_usuario']);
				$p->setPrecioTotal($fila['precio_total']);
				$p->setFecha($fila['fecha']);
				
				array_push($array_pedidos,$p);
			}
			return $array_pedidos;
		}
		else
			return false;
	}
	
    function update(tPedido $pedido)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET 
			id_usuario=:id_usuario, precioTotal=:precio_total, fecha=:fecha
		WHERE
			id_pedido=:id_pedido";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_usuario', $pedido->getIdUsuario());
		$stmt->bindValue(':precio_total', $pedido->getPrecioTotal());
		$stmt->bindValue(':id_pedido', $pedido->getId_pedido());
		$stmt->bindValue(':fecha', $pedido->getFecha());
		
		return $stmt->execute();
		
	}
    function delete(tPedido $pedido)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id_pedido = :id_pedido";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_pedido',$pedido->getId_pedido());
		$stmt->execute();
		return $stmt->rowCount();
	}
	
    function findByUser($id_usu){
	$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id_usuario = :id_usuario";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_usuario', $id_usu);
		$resultado = $stmt->execute();
		$array_pedidos_usu = array();
		if($resultado)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tPedido();
				$p->setId_pedido($fila['id_pedido']);
				$p->setIdUsuario($fila['id_usuario']);
				$p->setPrecioTotal($fila['precioTotal']);				
				$p->setFecha($fila['fecha']);
			array_push($array_pedidos_usu,$p);
			}
			return $array_pedidos_usu;
		}
		else
			return null;	

	}	
	
	function findLast(){
		$pdo = $this->db->getConnection();
		$query = "SELECT MAX(id_pedido) FROM pedidos";
		$resultado = $pdo->query($query);
		if($resultado)
		{
			$fila = $resultado->fetch(PDO::FETCH_ASSOC);
			$p = $fila['MAX(id_pedido)'];
			return $p;
		}
		else
			return null;
	}


}
?>
