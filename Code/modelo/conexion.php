<?php
class conexion extends PDO{
	private $tipo_de_base='mysql';
	private $host='IP_ADDRESS';
	private $nombre_de_base='NAME_DATABASE';
	private $usuario='USERNAME';
	private $contrasena='PASSWORD';
	public function __construct(){
		try{
			parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base,$this->usuario, $this->contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		}catch(PDOException $e){
			die($e->getMessage());
			exit;
		}
	}
}
?>