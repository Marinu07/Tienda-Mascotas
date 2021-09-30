
<?php
require_once("include/class_especie.php");
require_once("include/config.php");
$especie = new Especie();
$es = $especie->obtenerTodos(); 
?>
<div id="sidebar-left">
	<form action='index.php'class='busqueda' method='POST'>
		  <input type='text' name='buscarNom' id="buscarNom">
		  <button type='Submit'>Buscar</button>
	</form>

	<li class ="especie">
		<a class = "botonSubmenu" href= "index.php">Todos</a></li>
	<?php 	
			foreach($es as $esp)
			{
				echo "<li class='especie'><a class=\"botonSubmenu\" href=\"index.php?especie={$esp->getId()}\">{$esp->getNombre()}</a></li>";
			}
		?>
</div>