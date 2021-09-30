<?php
class tPedido {
	
    private $id_usuario = "";
    private $precio_total = "";
	private $fecha = "";
	private $id_pedido = "";
		
	// setters
	public function setidUsuario( $id_us ){ $this->id_usuario = $id_us; }
	public function setPrecioTotal( $precio ){ $this->precio_total = $precio; }
	public function setFecha( $fecha ){ $this->fecha = $fecha; }
	public function setId_pedido($id_pedido) {$this->id_pedido=$id_pedido;}
	
	// getters
	public function getidUsuario(){ return $this->id_usuario; }
	public function getPrecioTotal(){ return $this->precio_total; }	
	public function getFecha(){ return $this->fecha; }
	public function getId_pedido(){ return $this->id_pedido;}
}
?>