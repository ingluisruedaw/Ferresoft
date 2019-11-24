<?php
class Persona{
	private $id;
	private $nombres;
	private $direccion;
	private $telefono;
	private $correo;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>