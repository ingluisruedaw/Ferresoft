<?php
/*
estados
0=activo
1=eliminado



*/
include_once("../../modelo/conexion.php");
class Iva_Model{
	public $conexion;

	public function __CONSTRUCT(){
		try{
			$this->conexion = new conexion(); //instanciamos la clase	        
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar_Activos(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT id, det FROM iva WHERE estado_id=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almIva = new Iva();
				$almIva->__SET('id', $r->id);
				$almIva->__SET('det', $r->det);

				$result[] = $almIva;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function Listar_Todos(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT i.id, i.det, e.det as estado_det FROM iva i INNER JOIN estado e ON(i.estado_id=e.id)");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almIva = new Iva();
				$almIva->__SET('id', $r->id);
				$almIva->__SET('det', $r->det);
				$almIva->__SET('estado_det', $r->estado_det);
				$result[] = $almIva;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}*/


	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM iva WHERE det = ? AND estado_id = 1");
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
			$stm = $this->conexion->prepare("UPDATE iva SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Iva $data){
		try {
			$sql = "UPDATE iva SET det = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('det'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar($data){
		try {
		$sql = "INSERT INTO iva(det,estado_id) VALUES(?,'1')";
		$this->conexion->prepare($sql)->execute(array(
			$data
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>