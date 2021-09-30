<?php	
require_once("Objetos/tPedido.php");
require_once("Objetos/tArticuloPedido.php");
require_once("DAO/dao_pedido.php");
require_once("DAO/dao_articuloPedido.php");
require_once("include/class_cesta.php");
class Pedido
{
	
	private $dao;
	private $daoArticuloPedido;
	
	public function __construct()
	{
		$this->dao = new DAOPedido();
		$this->daoArticuloPedido = new DAOArticulosPedido();
	}
	public function crearPedido($userId)
	{
		$errores = array();
		$cesta = new Cesta(); 
		$listaCesta = $cesta->obtenerCesta();
		$precioCesta = $cesta->obtenerPrecioTotalCesta();
		
		$claseUsuario = new Usuario();
		$user = $claseUsuario->obtenerUsuario($userId);
		if(!$user)
			$errores[] = "Se ha producido un error al realizar el pedido, el usuario no existe";
		
		if($precioCesta == 0)
			$errores[] = "La cesta esta vacia";
		
		foreach($listaCesta as $p)
		{
			if($p->getCantidad() > $p->getStock())
				$errores[] = "Stock agotado para el Articulo: " . $p->getMarca() . " Modelo: " . $p->getModelo();
			
		}
		
		if(empty($errores))
		{
			$pedido = new tPedido();
			$pedido->setidUsuario($user->getId());
			$pedido->setPrecioTotal($precioCesta);
			
			if($this->insertarPedido($pedido, $listaCesta)){
				$cesta->vaciarCesta();
			}
			else{
				$errores[] = "Se ha producido un error mientras se generaba el pedido, debes ponerte en contacto con nosotros!";
		
			}
		}	
		return array("errors" => $errores, "data" => null);
	}
	private function insertarPedido(tPedido $pedido, array $listaCesta)
	{
		$pedidoCorrecto = true;
		$idPedido = $this->dao->insert($pedido);
		if($idPedido){
			$pedi = $this->dao->findLast(); 
			if($pedi)
			{
				$ArticuloPedido = new tArticuloPedido();
				$claseArticulo = new Producto();
				$ArticuloPedido->setIdOrden($pedi);

				foreach($listaCesta as $p)
				{
					$ArticuloPedido->setidProducto($p->getId());
					$ArticuloPedido->setCantidad($p->getCantidad());
					$ArticuloPedido->setPrecio(($ArticuloPedido->getCantidad())*($p->getPrecio()));
					$salida = $this->insertarProductoPedido($ArticuloPedido);
					if($salida)
					{
						$up = new tProducto;
						$up = $claseArticulo->obtenerProducto($p->getId());
						$up->setStock($up->getStock() - $ArticuloPedido->getCantidad());
						$claseArticulo->actualizarProducto($up);
					}
					else
						$pedidoCorrecto = false;
				}
			}
			return $pedidoCorrecto && $pedi;
		}else{
			return false;
		}
		
	}
	public function obtenerTodos()
	{
		return $this->dao->getAll();
	}
	public function obtenerPedido($id)
	{
		return $this->dao->getById($id);
	}
	public function actualizarPedido($pedido)
	{
		return $this->dao->update($pedido);
	}
	public function borrarPedido($pedido)
	{
		return $this->dao->delete($pedido);
	}
	public function buscarPedidosPorIdUsuario($id)
	{
		return $this->dao->findByUser($id);
	}
	public function insertarProductoPedido(tArticuloPedido $Articulo_pedido)
	{
		return $this->daoArticuloPedido->insert($Articulo_pedido);
	}
	public function obtenerTodosArticulos()
	{
		return $this->daoArticuloPedido->getAll();
	}
	public function obtenerArticulosPedido($id)
	{
		$Articulo_pedido = new tArticuloPedido();
		$Articulo_pedido->setidOrden($id);
		return $this->daoArticuloPedido->getById($Articulo_pedido);
	}
	public function actualizarArticuloPedido($Articulo_pedido)
	{
		return $this->daoArticuloPedido->update($Articulo_pedido);
	}
	public function borrarArticuloPedido($id)
	{
		return $this->daoArticuloPedido->delete($id);
	}
	public function buscarPorIdPedido($id)
	{
		return $this->daoArticuloPedido->findByIdOrden($id);
	}
	public function buscarPorIdArticulo($idArticulo){
		return $this->daoArticuloPedido->findByIdArticulo($idArticulo);
	}
}
?>
