<?php
class Usuario{
	private $usuario;
	private $clave;
	private $roles_id;
	private $roles_det;
	private $empleados_id;
	private $empleados_nombres;
	private $empleados_cargo;
	private $estado_id;
	private $estado_det;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>