<?php
/*
estados
1=activo
2=eliminado
*/
include_once("../../modelo/conexion.php");
class Cliente_Model{
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
				  clientes.id,
				  clientes.persona_id,
				  persona.nombres AS persona_nombres,
				  persona.direccion,
				  persona.telefono,
				  persona.correo
				FROM
				  clientes
				  INNER JOIN persona ON (clientes.persona_id = persona.id)
				WHERE
				  clientes.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almCliente = new Cliente();
				$almCliente->__SET('id', $r->id);
				$almCliente->__SET('persona_id', $r->persona_id);
				$almCliente->__SET('persona_nombres', $r->persona_nombres);
				$almCliente->__SET('direccion', $r->direccion);
				$almCliente->__SET('telefono', $r->telefono);
				$almCliente->__SET('correo', $r->correo);
				$result[] = $almCliente;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function Listar_Todos(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("
				SELECT 
					c.id, 
					c.persona_id AS persona_id,
					p.nombres AS persona_nombres, 
					e.det AS estado_det 
				from 
					clientes c 
					INNER JOIN persona p 
						ON (c.persona_id = p.id) 
					INNER JOIN estado e 
						ON (c.estado_id = e.id)");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almCliente = new Cliente();
				$almCliente->__SET('id', $r->id);
				$almCliente->__SET('persona_id', $r->persona_id);
				$almCliente->__SET('persona_nombres', $r->persona_nombres);
				$almCliente->__SET('estado_det', $r->estado_det);
				$result[] = $almCliente;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}*/

	public function ExisteCliente($id){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM clientes WHERE persona_id = ? AND estado_id = 1");
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

	public function ExistePersona($data){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM persona WHERE id = ?");
			$stm->execute(array($data));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->id)) {				
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return true;
		}
	}

	public function Eliminar($id){
		try {
			$stm = $this->conexion->prepare("UPDATE clientes SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ActualizarPersona(Cliente $data){
		try {
			$sql = "UPDATE
					  persona
					SET
					  nombres = ?,
					  direccion = ?,
					  telefono = ?,
					  correo = ?
					WHERE
					  persona.id = ?";

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

	public function RegistrarPersona(Cliente $data){
		try {
		$sql = "INSERT INTO
				  persona(
				  id,
				  nombres,
				  direccion,
				  telefono,
				  correo)
				VALUES(
				  ?,
				  ?,
				  ?,
				  ?,
				  ?)";

		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('persona_id'),
			$data->__GET('persona_nombres'),
			$data->__GET('direccion'),
			$data->__GET('telefono'),
			$data->__GET('correo')
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function RegistrarCliente($id){
		try {
		$sql = "INSERT INTO clientes(persona_id,estado_id) VALUES(?,'1')";
		$this->conexion->prepare($sql)->execute(array($id));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}

	/*public function Actualizar(Cliente $data){
		try {
			$sql = "UPDATE clientes SET persona_id = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('persona_id'),
						$data->__GET('id')
			));
		} catch (Exception $e) {
			//die($e->getMessage());
		}
	}*/
}
?>