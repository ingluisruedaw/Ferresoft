<?php
class Compras{
	private $id;
	private $productos_id;
	private $productos_nombre;
	private $productos_categorias_id;
	private $productos_categorias_det;
	private $proveedores_id;
	private $proveedores_det;	
	private $precio;
	private $iva_id;
	private $iva_det;
	private $cantidad;
	private $fecha;
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