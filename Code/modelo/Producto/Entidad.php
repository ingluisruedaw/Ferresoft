<?php
class Productos{
	private $id;
	private $nombre;
	private $stockmin;
	private $embalaje_id;
	private $embalaje_det;
	private $categorias_id;
	private $categorias_det;
	private $estado_id;
	private $estado_det;

	public function __GET($k){ 
		return $this->$k; 
	}
	public function __SET($k, $v){ 
		return $this->$k = $v; 
	}
}
?>