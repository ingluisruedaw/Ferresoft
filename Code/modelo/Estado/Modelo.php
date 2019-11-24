<?php
include_once("../../modelo/conexion.php");
class Estado_Model{
	public $conexion;

	public function __CONSTRUCT(){
		try{
			$this->conexion = new conexion();        
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar(){
		try{
			$result = array();
			$stm = $this->conexion->prepare("SELECT id, det FROM estado");
			$stm->execute();
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almEstado = new Estado();
				$almEstado->__SET('id', $r->id);
				$almEstado->__SET('det', $r->det);
				$result[] = $almEstado;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM estado WHERE det = ?");
			$stm->execute(array($det));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->id)) {
				if(is_null($r->id)){
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function Eliminar($id){
		try {
			$stm = $this->conexion->prepare("DELETE FROM estado WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Estado $data){
		try {
			$sql = "UPDATE estado SET det = ? WHERE id = ?";
			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('det'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar(Estado $data){
		try {
			$sql = "INSERT INTO estado(det) VALUES(?)";
			$this->conexion->prepare($sql)->execute(array($data->__GET('det')));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>