<?php
/*
estados
1=activo
2=eliminado
*/
include_once("../../modelo/conexion.php");
class Empleado_Model{
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

			$stm = $this->conexion->prepare(
				"SELECT 
				    empleados.id,
				    empleados.cargo,
				    empleados.fingreso,
				    empleados.persona_id,
				    persona.nombres AS persona_nombres,
				    persona.direccion,
				    persona.telefono,
				    persona.correo 
				FROM 
					empleados
					INNER JOIN persona ON (empleados.persona_id = persona.id)
				WHERE 
					empleados.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almEmpleado = new Empleado();
				$almEmpleado->__SET('id', $r->id);
				$almEmpleado->__SET('cargo', $r->cargo);
				$almEmpleado->__SET('fingreso', $r->fingreso);
				$almEmpleado->__SET('persona_id', $r->persona_id);
				$almEmpleado->__SET('persona_nombres', $r->persona_nombres);
				$almEmpleado->__SET('direccion', $r->direccion);
				$almEmpleado->__SET('telefono', $r->telefono);
				$almEmpleado->__SET('correo', $r->correo);
				$result[] = $almEmpleado;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Eliminar($id){
		try {
			$stm = $this->conexion->prepare("UPDATE empleados SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ActualizarPersona(Empleado $data){
		try {
			$sql = "UPDATE
					  persona
					SET
					  nombres = ?,
					  direccion = ?,
					  telefono = ?,
					  correo = ?
					WHERE
					  id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('persona_nombres'),
						$data->__GET('direccion'),
						$data->__GET('telefono'),
						$data->__GET('correo'),
						$data->__GET('persona_id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ActualizarEmpleado(Empleado $data){
		try {
			$sql = "UPDATE empleados SET cargo = ?, fingreso = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('cargo'),
						$data->__GET('fingreso'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ExisteEmpleado($id){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM empleados WHERE persona_id = ? AND estado_id = 1");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->id)) {				
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function ExistePersona($id){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM persona WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->id)) {				
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function RegistrarEmpleado(Empleado $data){
		try {
		$sql = "INSERT INTO empleados( cargo, fingreso, persona_id, estado_id) VALUES( ?, ?, ?, '1')";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('cargo'),
			$data->__GET('fingreso'),
			$data->__GET('persona_id')
			)
		);
		return true;
		} catch (Exception $e) {
			//echo $e->getMessage();
			return false;
		}
	}
}
?>