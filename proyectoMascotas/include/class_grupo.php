<?php	

require_once("Objeto/tGrupo.php");
require_once("DAO/dao_grupo.php");

class Grupo
{
	private $dao;
	
	public function __construct()
	{
		$this->dao = new DAOGrupo();
	}
	public function insertarGrupo(tGrupo $producto)
	{
		return $this->dao->insert($producto);
	}
	public function obtenerTodos()
	{
		return $this->dao->getAll();
	}
	public function obtenerGrupo($id)
	{
		return $this->dao->getById($id);
	}
	public function actualizarGrupo($categoria)
	{
		return $this->dao->update($categoria);
	}
	public function borrarGrupo($id)
	{
		return $this->dao->delete($id);
	}
}
?>