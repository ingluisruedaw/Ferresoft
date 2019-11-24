<?php
/*
estados
0=activo
1=eliminado
*/
include_once("../../modelo/conexion.php");
class Embalaje_Model{
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

			$stm = $this->conexion->prepare("SELECT id, det FROM embalaje WHERE estado_id=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almEmbalaje = new Embalaje();
				$almEmbalaje->__SET('id', $r->id);
				$almEmbalaje->__SET('det', $r->det);

				$result[] = $almEmbalaje;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM embalaje WHERE det = ? AND estado_id = 1");
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
			$stm = $this->conexion->prepare("UPDATE embalaje SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Embalaje $data){
		try {
			$sql = "UPDATE embalaje SET det = ? WHERE id = ?";
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
		$sql = "INSERT INTO embalaje(det,estado_id) VALUES(?,'1')";
		$this->conexion->prepare($sql)->execute(array($data));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>