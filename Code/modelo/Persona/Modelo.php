<?php
/*
estados
0=activo
1=eliminado



*/
include_once("./modelo/conexion.php");
class Persona_Model{
	public $conexion;

	public function __CONSTRUCT(){
		try{
			$this->conexion = new conexion(); //instanciamos la clase	        
		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar(){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT id, nombres, direccion, telefono, correo FROM persona");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almPersona = new Persona();
				$almPersona->__SET('id', $r->id);
				$almPersona->__SET('nombres', $r->nombres);
				$almPersona->__SET('direccion', $r->direccion);
				$almPersona->__SET('telefono', $r->telefono);
				$almPersona->__SET('correo', $r->correo);
				$result[] = $almPersona;
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
				$almPersona = new Proveedor();
				$almPersona->__SET('id', $r->id);
				$almPersona->__SET('det', $r->det);
				$almPersona->__SET('direccion', $r->direccion);
				$almPersona->__SET('telefono', $r->telefono);
				$almPersona->__SET('email', $r->email);
				$almPersona->__SET('estado_det', $r->estado_det);
				$result[] = $almPersona;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}*/

	/*public function Obtener($id){
		try {
			$stm = $this->conexion
			          ->prepare("SELECT 
								  pais.det
								FROM
								  pais
								WHERE
								  pais.id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$almPersona = new Pais();
			$almPersona->__SET('det', $r->det);

			return $almPersona;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}*/

	/*public function Contar_registros(){
		try {
			$stm = $this->conexion
			          ->prepare("SELECT 
								  count(*) AS cantidad
								FROM
								  pais");		          
			$stm->execute();
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$almPersona = new Pais();
			$almPersona->__SET('cantidad', $r->cantidad);

			return $almPersona;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}*/

	/*public function Eliminar($id){
		try {
			$stm = $this->conexion->prepare("UPDATE persona SET estado_id = 1 WHERE id = ?");	          
			$stm->execute(array($id));
		} catch (Exception $e) {
			//echo"<script type=\"text/javascript\">alert('Error Al Eliminar'); window.location='?action=Form_Pais_eliminar';</script>";
		}
	}*/

	public function Actualizar(Persona $data){
		try {
			$sql = "UPDATE persona SET nombres = ?, direccion = ?, telefono = ?, correo = ? WHERE id = ?";

			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('nombres'),
						$data->__GET('direccion'),
						$data->__GET('telefono'),
						$data->__GET('correo'),
						$data->__GET('id')
			));
		} catch (Exception $e) {
			//die($e->getMessage());
		}
	}

	public function Registrar(Persona $data){
		try {
		$sql = "INSERT INTO persona(id,nombres,direccion,telefono,correo) VALUES(?,?,?,?,?)";

		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('id'),
			$data->__GET('nombres'),
			$data->__GET('direccion'),
			$data->__GET('telefono'),
			$data->__GET('correo')
		));
		} catch (Exception $e) {
			//echo"<script type=\"text/javascript\">alert('Error. Datos Existentes'); window.location='?action=Pais';</script>";
		}
	}
}
?>

