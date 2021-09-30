<?php
class tCategoria {
	
    private $id = "";
    private $id_especie = "";
    private $nombre = "";
		
	// setters
	public function setId( $id ){ $this->id = $id; }
	public function setIdEspecie( $id_especie ){ $this->id_especie = $id_especie; }
	public function setNombre( $nombre ){  $this->nombre = $nombre;}
	
	// getters
	public function getId(){ return $this->id; }
	public function getNombre(){ return $this->nombre; }
	public function getIdEspecie(){ return $this->id_especie; }
	
}
?>