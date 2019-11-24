<?php
class Precio_venta{
	private $id;
	private $embalaje_det;
	private $categorias_det;
	private $productos_id;
	private $productos_nombre;
	private $iva_id;
	private $iva_det;	
	private $precio;
	private $neto;
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