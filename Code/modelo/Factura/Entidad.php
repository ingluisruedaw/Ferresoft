<?php
class Factura{
	private $id;
	private $empleados_id;
	private $empleados_nombres;
	private $clientes_id;
	private $clientes_nombres;
	private $fecha;
	private $total;
	private $estado_id;
	private $estado_det;

	private $embalaje_det;
	private $productos_nombre;
	private $iva_det;
	private $precio_venta_neto;
	private $cantidad;
	private $categoria_det;

	private $precio_venta_id;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>