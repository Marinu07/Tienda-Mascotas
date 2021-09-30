<?php
    class DB {
        private $host = "localhost";
        private $dbName = "mascotas";
        private $dbUser = "root";
        private $dbPassword = "";
		private $conexion = null;
		private static $instance;
		
		public static function getInstance()
		{
			if ( is_null( self::$instance ) )
			{
			  self::$instance = new self();
			}
			return self::$instance;
		}
		
		public function getConnection()
		{
			if(!isset($this->conexion))
			{
				$this->conexion = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->dbUser,$this->dbPassword);
				$this->conexion->query("set names 'utf8'"); 
			}
			return $this->conexion;
		}
	}
?>