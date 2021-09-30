<?php
class tArticuloPedido {
	
    private $id_orden = "";
	private $id = "";
    private $id_producto = "";
    private $cantidad = "";
    private $precio = "";
		
	// setters
	public function setIdOrden( $id_ord ){ $this->id_orden = $id_ord; }
	public function setId( $id ){ $this->id = $id; }
	public function setidProducto( $id_prod ){ $this->id_producto = $id_prod; }
	public function setCantidad( $cant ){ $this->cantidad = $cant; }
	public function setPrecio( $precio ){ $this->precio = $precio; }
	
	
	// getters
	public function getIdOrden(){ return $this->id_orden; }
	public function getId(){ return $this->id; }
	public function getidProducto(){ return $this->id_producto; }
	public function getCantidad(){ return $this->cantidad; }
	public function getPrecio(){ return $this->precio ; }
}
?>