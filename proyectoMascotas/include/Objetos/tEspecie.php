<?php
class tEspecie {
	
    private $id = "";
    private $nombre = "";
		
	// setters
	public function setId( $id ){ $this->id = $id; }
	public function setNombre( $nombre ){ $this->nombre = $nombre; }
	
	// getters
	public function getId(){ return $this->id; }
	public function getNombre(){ return $this->nombre; }
	
}
?>