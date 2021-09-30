<?php
class tProducto {
	
    private $id = "";
    private $marca = "";
	private $categoria = "";
    private $precio = "";
	private $descripcion = "";
	private $stock = "";
	private $nombre = "";
	private $talla = "";
	private $foto = "";	
	// setters
	public function setId( $id ){ $this->id = $id; }
	public function setMarca( $marca ){ $this->marca = $marca; }
	public function setCategoria( $categoria ){ $this->categoria = $categoria; }
	public function setPrecio( $precio ){ $this->precio = $precio; }
	public function setDescripcion( $descripcion ){ $this->descripcion = $descripcion; }
	public function setStock( $stock ){ $this->stock = $stock; }
	public function setNombre( $nombre ){ $this->nombre = $nombre; }
	public function setTalla( $talla ){ $this->talla = $talla; }
	public function setFoto( $foto ){ $this->foto = $foto; }
	
	// getters
	public function getId(){ return $this->id; }
	public function getMarca(){ return $this->marca; }
	public function getCategoria(){ return $this->categoria; }
	public function getPrecio(){ return $this->precio; }
	public function getDescripcion(){ return $this->descripcion; }
	public function getStock(){ return $this->stock; }
	public function getNombre(){ return $this->nombre; }
	public function getTalla(){ return $this->talla; }
	public function getFoto(){ return $this->foto; }
}
?>