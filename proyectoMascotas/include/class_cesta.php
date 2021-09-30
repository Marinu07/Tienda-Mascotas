<?php	

require_once("include/Objetos/tCesta.php");
require_once("include/class_producto.php");

class Cesta
{
	public function __construct()
	{
		if(!isset($_SESSION['CESTA']))
		{
			$_SESSION['CESTA'] = array();
		}
	}
	public function insertarEnCesta($id)
	{
		$producto = new Producto();
		$tp = $producto->obtenerProducto($id);
		if($tp)
		{
			if(!array_key_exists($id,$_SESSION['CESTA'])){
				$_SESSION['CESTA'][$id] = 1;

				echo "se ha metido".$id;
			}
			return true;
		}
		return false;
	}
	public function obtenerCesta()
	{
		$producto = new Producto();
		$array_cesta = array();
		foreach($_SESSION['CESTA'] as $idProducto => $valor)
		{
			$p = $producto->obtenerProducto($idProducto);
			$np = $this->conCantidad($p,$valor);
			array_push($array_cesta, $np);
		}
		return $array_cesta;
	}
	public function aumentarCantidad($id)
	{
		if(array_key_exists($id,$_SESSION['CESTA']))
			$_SESSION['CESTA'][$id]++;
	}
	public function disminuirCantidad($id)
	{
		if(array_key_exists($id,$_SESSION['CESTA']))
		{
			
			if ($_SESSION['CESTA'][$id] == 1)
				$this->borrarProductoCesta($id);
			else
				$_SESSION['CESTA'][$id]--;
		}
	}
	public function borrarProductoCesta($id)
	{
		unset($_SESSION['CESTA'][$id]);
	}
	public function vaciarCesta(){
		
		unset($_SESSION['CESTA']);
		$_SESSION['CESTA'] = array();
	}
	private function conCantidad($tp,$cantidad)
	{
		$c = new tCesta();
		
		$c->setId($tp->getId());
		$c->setMarca($tp->getMarca());
		$c->setCategoria($tp->getCategoria());
		$c->setPrecio($tp->getPrecio());
		$c->setDescripcion($tp->getDescripcion());
		$c->setStock($tp->getStock());
		$c->setNombre($tp->getNombre());
		$c->setTalla($tp->getTalla());
		$c->setFoto($tp->getFoto());
		$c->setCantidad($cantidad);

		
		return $c;
	}
	public function obtenerPrecioTotalCesta()
	{
		$precioCesta = 0;
		$listaCesta = $this->obtenerCesta();
		foreach($listaCesta as $p)
			$precioCesta += $p->getPrecio() * $p->getCantidad();
		return $precioCesta;
	}
}
?>