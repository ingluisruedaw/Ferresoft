<?php
/*
estados
0=activo
1=eliminado
*/
include_once("../../modelo/conexion.php");
class Proveedor_Model{
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

			$stm = $this->conexion->prepare("SELECT id, det, direccion, telefono, email FROM proveedores WHERE estado_id=1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almProveedor = new Proveedor();
				$almProveedor->__SET('id', $r->id);
				$almProveedor->__SET('det', $r->det);
				$almProveedor->__SET('direccion', $r->direccion);
				$almProveedor->__SET('telefono', $r->telefono);
				$almProveedor->__SET('email', $r->email);
				$result[] = $almProveedor;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function Listar_Todos(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT p.id, p.det, p.direccion, p.telefono, p.email, e.det as estado_det FROM proveedores p INNER JOIN estado e ON (p.estado_id = e.id)");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almProveedor = new Proveedor();
				$almProveedor->__SET('id', $r->id);
				$almProveedor->__SET('det', $r->det);
				$almProveedor->__SET('direccion', $r->direccion);
				$almProveedor->__SET('telefono', $r->telefono);
				$almProveedor->__SET('email', $r->email);
				$almProveedor->__SET('estado_det', $r->estado_det);
				$result[] = $almProveedor;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}*/


	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM proveedores WHERE det = ? AND estado_id = 1");
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
			$stm = $this->conexion->prepare("UPDATE proveedores SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Proveedor $data){
		try {
			$sql = "UPDATE proveedores SET det = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('det'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ActualizarOtros(Proveedor $data){
		try {
			$sql = "UPDATE proveedores SET direccion = ?, telefono = ?, email = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('direccion'),
						$data->__GET('telefono'),
						$data->__GET('email'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar(Proveedor $data){
		try {
		$sql = "INSERT INTO proveedores(det,direccion,telefono,email,estado_id) VALUES(?,?,?,?,'1')";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('det'),
			$data->__GET('direccion'),
			$data->__GET('telefono'),
			$data->__GET('email')
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>