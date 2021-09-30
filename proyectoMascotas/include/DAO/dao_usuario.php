<?php

require_once("include/class_bd.php");

class DAOUsuario
{
	private $db;
	private $table = "usuario";

	public function __construct()
	{
		$this->db = DB::getInstance();
	}
    public function insert(tUsuario $usuario)
	{
		$username = $usuario->getUsername();
		$password = $usuario->getPassword();
		$nivelAcceso = $usuario->getNivel_Acceso();
		$email = $usuario->getEmail();
		$nombre = $usuario->getNombre();
		$apellido = $usuario->getApellido();	
		$fotoPerfil = $usuario->getFotoPerfil();
		$pdo = mysqli_connect('localhost', 'root', '', 'mascotas');
		$query = "INSERT INTO " . $this->table . " VALUES ('','$nombre','$apellido','$email','$fotoPerfil','$nivelAcceso','$password','$username')";
		//echo $query;
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
		$query = "SELECT * FROM " . $this->table . " where id = :id";
		
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if($resultado && $stmt->rowCount() > 0)
		{
			$fila = $stmt->fetch();
			
			$u = new tUsuario();
			$u->setId($fila['id']);
			$u->setUsername($fila['usuario']);
			$u->setPassword($fila['pasw']);
			$u->setNivel_Acceso($fila['nivelAcceso']);
			$u->setEmail($fila['email']);
			$u->setNombre($fila['nombre']);
			$u->setApellido($fila['apellidos']);
			$u->setFotoPerfil($fila['fotoPerfil']);
			return $u;
		}
		return false;
	}
    function getAll()
	{
		$query = "SELECT * FROM " . $this->table;
		$pdo = $this->db->getConnection();
		$query = $pdo->query($query);
		$array_usuarios = array();
		
		if($query)
		{
			while($fila = $query->fetch(PDO::FETCH_ASSOC))
			{
				$u = new tUsuario();
				$u->setId($fila['id']);
				$u->setUsername($fila['usuario']);
				$u->setPassword($fila['pasw']);
				$u->setNivel_Acceso($fila['nivelAcceso']);
				$u->setEmail($fila['email']);
				$u->setNombre($fila['nombre']);
				$u->setApellido($fila['apellidos']);
				$u->setFotoPerfil($fila['fotoPerfil']);
				
				array_push($array_usuarios,$u);
			}
			return $array_productos;
		}
		return false;
	}
	
    function update(tUsuario $usuario)
	{
		$pdo = $this->db->getConnection();
		$query = 
		"UPDATE " . 
			$this->table . " 
		SET 
			usuario=:username, pasw=:password, nivelAcceso=:nivel_acceso, email=:email,nombre=:nombre,apellidos=:apellido,fotoPerfil=:foto_perfil
		WHERE
			id=:id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':username', $usuario->getUsername());
		$stmt->bindValue(':password', $usuario->getPassword());
		$stmt->bindValue(':nivel_acceso', $usuario->getNivel_Acceso());
		$stmt->bindValue(':email', $usuario->getEmail());
		$stmt->bindValue(':nombre', $usuario->getNombre());
		$stmt->bindValue(':apellido', $usuario->getApellido());
		$stmt->bindValue(':foto_perfil', $usuario->getFotoPerfil());
		$stmt->bindValue(':id', $usuario->getId());
		return $stmt->execute();
		
	}
    function delete(tUsuario $usuario)
	{
		$pdo = $this->db->getConnection();
		$query = "DELETE FROM " . $this->table . " WHERE id = :id";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':id', $usuario->getId());
		$stmt->execute();
		return $stmt->rowCount();
	}
	
    function findByName($username)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where usuario = :username";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':username', $username);
		$resultado = $stmt->execute();
		if($resultado)
		{
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$usu = new tUsuario();
				$usu->setId($fila['id']);
				$usu->setUsername($fila['usuario']);
				$usu->setPassword($fila['pasw']);
				$usu->setNivel_Acceso($fila['nivelAcceso']);
				$usu->setEmail($fila['email']);
				$usu->setNombre($fila['nombre']);
				$usu->setApellido($fila['apellidos']);
				$usu->setFotoPerfil($fila['fotoPerfil']);
				
				return $usu;
			}
		}
		return null;	
	}	
	 function findByEmail($email)
	{
		$pdo = $this->db->getConnection();
		$query = "SELECT * FROM " . $this->table . " where email = :email";
		$stmt = $pdo->prepare($query);
		$stmt->bindValue(':email', $email);
		$resultado = $stmt->execute();
		if($resultado)
		{
			if($fila = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$usu = new tUsuario();
				$usu->setId($fila['id']);
				$usu->setUsername($fila['usuario']);
				$usu->setPassword($fila['pasw']);
				$usu->setNivel_Acceso($fila['nivelAcceso']);
				$usu->setEmail($fila['email']);
				$usu->setNombre($fila['nombre']);
				$usu->setApellido($fila['apellidos']);
				$usu->setFotoPerfil($fila['fotoPerfil']);
				
				return $usu;
			}
		}
		return null;	
	}
}
?>
