<?php

require_once("include/class.bd.php");

class DAOGrupo
{
	private $db;
	private $table = "grupo";
	
	public function __construct()
	{
		$this->db = DB::getInstance();
	}
    public function insert(tGrupo $grupo)
	{
		
		$pdo = $this->db->getConnection();
		
		$query = "INSERT INTO " . $this->table . " VALUES (NULL,?)";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(1, $grupo->getNombre());
		
		if($stmt->execute())
			return $pdo->lastInsertId();
		else
			return false;
	}
    function getById(tGrupo $grupo)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $grupo->getId());
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$p = new tGrupo();
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
		$array_grupos = array();
		
		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$p = new tGrupo();
				$p->setId($fila['id']);
				$p->setNombre($fila['nombre']);
				array_push($array_grupos,$p);
			}
			return $array_grupos;
		}
		else
			return false;
	}
	
    function update(tGrupo $grupo)
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
    function delete(tGrupo $grupo)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $grupo->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}
}
?>