<?php	

require_once("Objetos/tEspecie.php");
require_once("DAO/dao_especie.php");

class Especie
{
	private $dao;
	
	public function __construct()
	{
		$this->dao = new DAOEspecie();
	}
	public function insertarEspecie(tEspecie $especie)
	{
		return $this->dao->insert($especie);
	}
	public function obtenerTodos()
	{
		return $this->dao->getAll();
	}
	public function obtenerEspecie($id)
	{
		return $this->dao->getById($id);
	}
	public function actualizarEspecie($categoria)
	{
		return $this->dao->update($categoria);
	}
	public function borrarEspecie($id)
	{
		return $this->dao->delete($id);
	}
}
?>