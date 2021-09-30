<?php

require_once("include/class_bd.php");

class DAOCategoria
{
	private $db;
	private $table = "categoria";
	
	public function __construct()
	{
		$this->db = DB::getInstance();
	}
    public function insert(tCategoria $categoria)
	{
		
		$pdo = $this->db->getConnection();
		$id_especie = $categoria->getIdEspecie();
		$nombre = $categoria->getNombre();
		$query = "INSERT INTO " . $this->table . " VALUES ('','$id_especie','$nombre')";

		if(mysqli_query($pdo,$query)){
			return true;
		}else{
			return false;
		}
	}
    function getById(tCategoria $categoria)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $categoria->getId());
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$p = new tCategoria();
			$p->setId($fila['id']);
			$p->setIdEspecie($fila['id_especie']);
			$p->setNombre($fila['nombre']);
				
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
		$array_categorias = array();
		
		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tCategoria();
				$p->setId($fila['id']);
				$p->setIdEspecie($fila['id_especie']);
				$p->setNombre($fila['nombre']);
				array_push($array_categorias,$p);
			}
			return $array_categorias;
		}
		else
			return false;
	}
	
    function update(tCategoria $categoria)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET 
			nombre=:nombre
			id_especie=:id_especie
		WHERE
			id=:id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':nombre', $producto->getNombre());
		$stmt->bindValue(':id', $producto->getId());
		$stmt->bindValue(':id_especie', $producto->getIdEspecie());
		return $stmt->execute();
		
	}
    function delete(tCategoria $categoria)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $categoria->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}

	function findByIdEspecie($id_especie)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id_especie = :id_especie";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id_especie', $id_especie);
		$resultado = $stmt->execute();
		$array_categorias = array();
		if($resultado)
		{
			while($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$c = new tCategoria();
				$c->setId($fila['id']);
				$c->setIdEspecie($fila['id_especie']);
				$c->setNombre($fila['nombre']);

				array_push($array_categorias, $c);
			}
			return $array_categorias;
		}
		return false;
	}
}
?>