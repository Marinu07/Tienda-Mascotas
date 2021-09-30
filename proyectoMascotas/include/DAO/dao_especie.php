<?php

require_once(dirname(__DIR__)."/class_bd.php");

class DAOEspecie
{
	private $db;
	private $table = "especie";
	
	public function __construct()
	{
		$this->db = DB::getInstance();
	}
    public function insert(tEspecie $especie)
	{
		
		$pdo = $this->db->getConnection();
		
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, $especie->getNombre());
		
		if($stmt->execute())
			return $pdo->lastInsertId();
		else
			return false;
	}
    function getById(tEspecie $especie)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $especie->getId());
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$p = new tEspecie();
			$p->setId($fila['id']);
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
		$array_especies = array();
		
		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tEspecie();
				$p->setId($fila['id']);
				$p->setNombre($fila['nombre']);
				array_push($array_especies,$p);
			}
			return $array_especies;
		}
		else
			return false;
	}
	
    function update(tEspecie $especie)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET 
			nombre=:nombre
		WHERE
			id=:id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':nombre', $producto->getNombre());
		$stmt->bindValue(':id', $producto->getId());
		
		return $stmt->execute();
		
	}
    function delete(tEspecie $especie)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $especie->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}
}
?>