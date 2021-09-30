<?php
class tUsuario {
	
    private $id = "";
    private $username = "";
    private $password = "";
    private $nivel_acceso = "";
	private $email = "";
	private $nombre = "";
	private $apellido = "";
	private $fotoPerfil = "";
		
	// setters
	public function setId( $id ){ $this->id = $id; }
	public function setUsername( $username ){ $this->username = $username; }//Se va a usar de verdad?
	public function setPassword( $password ){ $this->password = $password; }
	public function setNivel_Acceso( $nivel_acceso ){ $this->nivel_acceso = $nivel_acceso; }
	public function setEmail( $email ){ $this->email = $email; }
	public function setNombre( $nombre ){ $this->nombre = $nombre; }
	public function setApellido( $apellido ){ $this->apellido = $apellido; }
	public function setFotoPerfil( $fotoPerfil ){ $this->fotoPerfil = $fotoPerfil; }	
	
	// getters
	public function getId(){ return $this->id; }
	public function getUsername(){ return $this->username; }
	public function getPassword(){ return $this->password; }
	public function getNivel_Acceso(){ return $this->nivel_acceso; }
	public function getEmail(){ return $this->email; }
	public function getNombre(){ return $this->nombre; }
	public function getApellido(){ return $this->apellido; }
	public function getFotoPerfil(){ return $this->fotoPerfil; }	
	
}



class tUsuarioSesion {
	
	private $id = "";
    private $sesion = false;
    private $esAdmin = false;
	private $nombre = "";
	private $fotoPerfil = "";

	public function __construct($id,$sesion,$esAdmin,$nombre,$fotoPerfil)
	{
		$this->id = $id;
		$this->sesion = $sesion;
		$this->nombre = $nombre;
		$this->fotoPerfil = $fotoPerfil;
		$this->esAdmin = $esAdmin;
	}
	
	// getters
	
	public function getId(){ return $this->id; }
	public function getNombre(){ return $this->nombre; }
	public function getFotoPerfil(){ return $this->fotoPerfil; }
	
	public function logueado()
	{
		return $this->sesion;
	}
	public function esAdmin()
	{
		return $this->esAdmin;
	}
	
}
?>