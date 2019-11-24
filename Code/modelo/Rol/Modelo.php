<?php
include_once("../../modelo/conexion.php");
class Roles_Model{
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

			$stm = $this->conexion->prepare("SELECT id, det FROM roles WHERE estado_id = 1");
			$stm->execute();
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almRoles = new Roles();
				$almRoles->__SET('id', $r->id);
				$almRoles->__SET('det', $r->det);

				$result[] = $almRoles;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM roles WHERE det = ? AND estado_id = 1");
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
			$stm = $this->conexion->prepare("UPDATE roles SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Roles $data){
		try {
			$sql = "UPDATE roles SET det = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('det'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar(Roles $data){
		try {
		$sql = "INSERT INTO roles(det,estado_id) VALUES(?,'1')";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('det')
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>