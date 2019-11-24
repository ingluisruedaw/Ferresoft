<?php
class Iva{
	private $id;
	private $det;
	private $estado_id;
	private $estado_det;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
?>