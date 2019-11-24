<?php
class conexion extends PDO{
	private $tipo_de_base='mysql';
	private $host='mysql.hostinger.es';
	private $nombre_de_base='ferresoft';
	private $usuario='ferresoft';
	private $contrasena='';
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

//ya correlo