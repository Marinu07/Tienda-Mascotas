<?php	

require_once("Objetos/tCategoria.php");
require_once("DAO/dao_categoria.php");

class Categoria
{
	
	private $dao;
	
	public function __construct()
	{
		$this->dao = new DAOCategoria();
	}
	public function insertarCategoria(tCategoria $producto)
	{
		return $this->dao->insert($producto);
	}
	public function obtenerTodos()
	{
		return $this->dao->getAll();
	}
	public function obtenerCategoria($id)
	{
		return $this->dao->getById($id);
	}
	public function actualizarCategoria($categoria)
	{
		return $this->dao->update($categoria);
	}
	public function borrarCategoria($id)
	{
		return $this->dao->delete($id);
	}
	public function buscarPorEspecie($id_especie)
	{
		return $this->dao->findByIdEspecie($id_especie);
	}
}
?>