<?php
include_once("../../modelo/conexion.php");
class Usuario_Model{
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

			$stm = $this->conexion->prepare("SELECT 
									  usuario.usuario,
									  usuario.roles_id,
									  roles.det AS roles_det,
									  usuario.empleados_id,
									  empleados.cargo AS empleados_cargo,
									  persona.nombres AS empleados_nombres
									FROM
									  usuario
									  INNER JOIN roles ON (usuario.roles_id = roles.id)
									  INNER JOIN empleados ON (usuario.empleados_id = empleados.id)
									  INNER JOIN persona ON (empleados.persona_id = persona.id)
									WHERE
									  usuario.estado_id = '1'");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almUsuario = new Usuario();
				$almUsuario->__SET('usuario', $r->usuario);
				$almUsuario->__SET('roles_id', $r->roles_id);
				$almUsuario->__SET('roles_det', $r->roles_det);
				$almUsuario->__SET('empleados_id', $r->empleados_id);
				$almUsuario->__SET('empleados_cargo', $r->empleados_cargo);
				$almUsuario->__SET('empleados_nombres', $r->empleados_nombres);
				$result[] = $almUsuario;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function Listar_Todos(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT 
											  usuario.usuario,
											  usuario.roles_id,
											  roles.det AS roles_det,
											  usuario.empleados_id,
											  empleados.cargo AS empleados_cargo,
											  persona.nombres AS empleados_nombres,
											  usuario.estado_id,
											  estado.det AS estado_det
											FROM
											  usuario
											  INNER JOIN roles ON (usuario.roles_id = roles.id)
											  INNER JOIN empleados ON (usuario.empleados_id = empleados.id)
											  INNER JOIN persona ON (empleados.persona_id = persona.id)
											  INNER JOIN estado ON (usuario.estado_id = estado.id)");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almUsuario = new Usuario();
				$almUsuario->__SET('usuario', $r->usuario);
				$almUsuario->__SET('roles_id', $r->roles_id);
				$almUsuario->__SET('roles_det', $r->roles_det);
				$almUsuario->__SET('empleados_id', $r->empleados_id);
				$almUsuario->__SET('empleados_cargo', $r->empleados_cargo);
				$almUsuario->__SET('empleados_nombres', $r->empleados_nombres);
				$almUsuario->__SET('estado_id', $r->estado_id);
				$almUsuario->__SET('estado_det', $r->estado_det);
				$result[] = $almUsuario;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}*/

	public function Existe($det){
		try {
			$stm = $this->conexion->prepare("SELECT estado_id FROM usuario WHERE usuario = ?");
			$stm->execute(array($det));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->estado_id)) {				
				if(is_null($r->estado_id)){
					return null;
				}else{
					return $r->estado_id;
				}
			}else{
				return null;
			}
		} catch (Exception $e) {
			return null;
		}
	}

	public function Existe_Empleado($id){
		try {
			$stm = $this->conexion->prepare("SELECT estado_id FROM empleados WHERE id = ?");
			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->estado_id)) {				
				if(is_null($r->estado_id)){
					return false;
				}else{
					return true;
				}
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	public function Eliminar($id){
		try {
			$stm = $this->conexion->prepare("UPDATE usuario SET estado_id = 2 WHERE usuario = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Usuario $data){
		try {
			$form_pass = $data->__GET('clave');
			$hash = password_hash($form_pass, PASSWORD_BCRYPT); 
			$sql = "UPDATE
					  usuario
					SET
					  clave = '$hash',
					  roles_id = ?,
					  empleados_id = ?,
					  estado_id = ?
					WHERE
					  usuario.usuario = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('roles_id'),
						$data->__GET('empleados_id'),
						$data->__GET('estado_id'),
						$data->__GET('usuario')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar_Otros(Usuario $data){
		try {
			$sql = "UPDATE
					  usuario
					SET
					  roles_id = ?,
					  empleados_id = ?
					WHERE
					  usuario.usuario = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('roles_id'),
						$data->__GET('empleados_id'),
						$data->__GET('usuario')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar_Clave(Usuario $data){
		try {
			$form_pass = $data->__GET('clave');
			$hash = password_hash($form_pass, PASSWORD_BCRYPT); 
			$sql = "UPDATE usuario SET clave = '$hash' WHERE usuario = ?";
			$this->conexion->prepare($sql)->execute(array($data->__GET('usuario')));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar(Usuario $data){
		try {
			$form_pass = $data->__GET('clave');
			$hash = password_hash($form_pass, PASSWORD_BCRYPT); 
			$sql = "INSERT INTO usuario(usuario,clave,roles_id,empleados_id,estado_id) VALUES(?,'$hash',?,?,1)";

		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('usuario'),
			$data->__GET('roles_id'),
			$data->__GET('empleados_id')
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>