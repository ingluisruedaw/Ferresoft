<?php
class Empleado{
	private $id;
	private $cargo;
	private $fingreso;
	private $persona_id;
	private $persona_nombres;
	private $direccion;
	private $telefono;
	private $correo;
	private $estado_id;
	private $estado_det;
	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>