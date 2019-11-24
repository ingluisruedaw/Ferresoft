<?php
class Proveedor{
	private $id;
	private $det;
	private $direccion;
	private $telefono;
	private $email;
	private $estado_id;
	private $estado_det;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>