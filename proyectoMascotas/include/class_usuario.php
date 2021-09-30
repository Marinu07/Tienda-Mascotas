<?php	

require_once("Objetos/tUsuario.php");
require_once("DAO/dao_usuario.php");

class Usuario
{
	private $daoUsuario;
	
	public function __construct()
	{
		$this->daoUsuario = new DAOUsuario();
	}
	public function insertarUsuario(tUsuario $usuario, $claveConfirmacion , $fotoPerfil)
	{
		$errores = array();

		if(empty($usuario->getUsername()) || empty($usuario->getPassword()) || empty($usuario->getNivel_Acceso()) || empty($usuario->getEmail()) || empty($usuario->getNombre()) || empty($usuario->getApellido()))
			$errores[] = "No se han introducido todos los datos necesarios";

		if($this->buscarUsuarioPorNombre($usuario->getUsername()))
			$errores[] = "El usuario ya esta dado de alta";

		if($this->buscarUsuarioPorEmail($usuario->getEmail()))
			$errores[] = "La direccion de correo electronico ya se encuentra en uso";

		if(strlen($usuario->getPassword()) < 6)
			$errores[] = "La contraseña debe contener al menos 6 caracteres";

		if (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL))
			$errores[] = "El formato de la direccion de correo electronico no es correto";

		if ($usuario->getPassword() != $claveConfirmacion)
			$errores[] = "Las contraseñas no coinciden";
		
		/*if (!is_numeric($usuario->getTelefono()))
			$errores[] = "El numero de telefono es incorrecto";*/


		if(empty($errores) && file_exists($fotoPerfil['tmp_name']) && is_uploaded_file($fotoPerfil['tmp_name'])) // si no hay errores anteriores comprobamos si el usuario quiere utilizar una foto propia de perfil
		{
			$rutaTemporal = $fotoPerfil["tmp_name"];
			$extension = strtolower(pathinfo($fotoPerfil['name'],PATHINFO_EXTENSION));
			
			if ($fotoPerfil["size"] > 50000000)
				$errores[] = "La imagen de perfil supera el tamaño maximo permitido";

			if(!getimagesize($rutaTemporal))
				$errores[] = "El archivo no contiene una imagen valida";
			
			if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif")
				$errores[] = "La extension de la imagen no esta soportada";
			
			if(empty($errores)) 
			{
				$usuario->setFotoPerfil($extension);
				$usoFoto = true;
			}
		}
		
		if(empty($errores))
		{
			$usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT)); 
			$idUsuario = $this->daoUsuario->insert($usuario);
			$id = $this->daoUsuario->findByName($usuario->getUsername());
			$id = $id->getId(); 
			if(!$idUsuario)
				$errores[] = "Se ha producido un error al dar de alta al usuario";

			if(empty($errores) && isset($usoFoto) && $usoFoto == true && !move_uploaded_file($rutaTemporal, RUTA_IMAGEN_PERFIL . $id . "." . $extension )) // el fichero se ha copiado correctamente.
				$errores[] = "Se ha producido un error al dar de alta la imagen del usuario";
		}
		$result = array	('errors' => $errores,'data' => null);
		return $result;	
	}
	public function obtenerTodos()
	{
		return $this->daoUsuario->getAll();
	}
	public function obtenerUsuario($id)
	{
		return $this->daoUsuario->getById($id);
	}
	public function actualizarUsuario(tUsuario $usuario, $claveConfirmacion , $fotoPerfil)
	{
		$errores = array();
		if(empty($usuario->getUsername()) || empty($usuario->getPassword()) || empty($usuario->getNivel_Acceso()) || empty($usuario->getEmail()) || empty($usuario->getNombre()) || empty($usuario->getApellido()) )
			$errores[] = "No se han introducido todos los datos necesarios";

		if(strlen($usuario->getPassword()) < 6)
			$errores[] = "La contraseña debe contener al menos 6 caracteres";

		if (!filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL))
			$errores[] = "El formato de la direccion de correo electronico no es correto". $usuario->getEmail();

		if ($usuario->getPassword() != $claveConfirmacion)
			$errores[] = "Las contraseñas no coinciden";
		

		
		if(empty($errores) && file_exists($fotoPerfil['tmp_name']) && is_uploaded_file($fotoPerfil['tmp_name']))
		{
			$rutaTemporal = $fotoPerfil["tmp_name"];
			$extension = strtolower(pathinfo($fotoPerfil['name'],PATHINFO_EXTENSION));
			
			if ($fotoPerfil["size"] > 50000000)
				$errores[] = "La imagen de perfil supera el tamaño maximo permitido";

			if(!getimagesize($rutaTemporal))
				$errores[] = "El archivo no contiene una imagen valida";
			
			if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif")
				$errores[] = "La extension de la imagen no esta soportada";
			
			if(empty($errores)) 
			{
				$usuario->setFotoPerfil($extension);
				$usoFoto = true;
			}
		}

		if(empty($errores))
		{
			$usuario->setPassword(password_hash($usuario->getPassword(), PASSWORD_DEFAULT)); 
			$idUsuario = $this->daoUsuario->update($usuario);
			if(empty($errores) && isset($usoFoto) && $usoFoto == true && !move_uploaded_file($rutaTemporal, RUTA_IMAGEN_PERFIL . $usuario->getId() . "." . $extension )) 
				$errores[] = "Se ha producido un error al dar de alta la imagen del usuario";
		}
		
		$result = array	('errors' => $errores,'data' => null);
		return $result;	
	}
	public function borrarUsuario($id)
	{
		return $this->daoUsuario->delete($id);
	}
	public function buscarUsuarioPorNombre($nombre)
	{
		return $this->daoUsuario->findByName($nombre);
	}
	public function buscarUsuarioPorEmail($nombre)
	{
		return $this->daoUsuario->findByEmail($nombre);
	}
	public function validaLogin($username, $password)
	{
		$errores = array();
		$usuario="";
		
		if(empty($username))
		{
			$errores[] = "El nombre de usuario no puede estar vacio";
		}
		if(empty($password))
		{
			$errores[] = "La contraseña no puede estar vacia";
		}
		
		if(empty($errores))
		{
			$usuario = $this->buscarUsuarioPorNombre($username);
			if($usuario)
			{
				if(password_verify($password, $usuario->getPassword()))
				{
					$_SESSION['sesion'] = true;
					$_SESSION['userID'] = $usuario->getId();
					$_SESSION['esAdmin'] = ($usuario->getNivel_Acceso() == 1) ? true : false;
					$_SESSION['nombre'] = $usuario->getNombre();
					$_SESSION['fotoPerfil'] = (!empty($usuario->getFotoPerfil())) ? RUTA_IMAGEN_PERFIL . $usuario->getId() .$usuario->getFotoPerfil()  : RUTA_IMAGEN_PERFIL . "foto_perfil_defecto.jpg";
				}
				else
				{
					$errores[] = "El usuario o la contraseña no coinciden"; 
				}
			}	
			else
			{
				$errores[] = "El usuario o la contraseña no coinciden";
			}
		}
		return array('errors' => $errores, 'data' => $usuario);
	}
	public function cerrarSesion()
	{
		if(isset($_SESSION['sesion']))
			$_SESSION['login'] = false;

		if(isset($_SESSION['userID']))
			$_SESSION['userID'] = 0;

		session_destroy();
		header('Location: index.php');
	}
}
?>
