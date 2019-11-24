<?php
include_once("../../modelo/conexion.php");
class Productos_Model{
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
											  productos.id,
											  productos.nombre,
											  productos.stockmin,
											  productos.embalaje_id,
											  embalaje.det AS embalaje_det,
											  productos.categorias_id,
											  categorias.det AS categorias_det
											FROM
											  productos
											  INNER JOIN categorias ON (productos.categorias_id = categorias.id)
											  INNER JOIN embalaje ON (productos.embalaje_id = embalaje.id)
											WHERE
											  productos.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almProductos = new Productos();
				$almProductos->__SET('id', $r->id);
				$almProductos->__SET('nombre', $r->nombre);
				$almProductos->__SET('stockmin', $r->stockmin);
				$almProductos->__SET('embalaje_id', $r->embalaje_id);
				$almProductos->__SET('embalaje_det', $r->embalaje_det);
				$almProductos->__SET('categorias_id', $r->categorias_id);
				$almProductos->__SET('categorias_det', $r->categorias_det);
				$result[] = $almProductos;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Existe(Productos $data){
		try {
			$stm = $this->conexion->prepare("SELECT id FROM productos WHERE nombre = ? AND embalaje_id = ? AND estado_id = 1");
			$stm->execute(array(
						$data->__GET('nombre'),
						$data->__GET('embalaje_id')
			));
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
			$stm = $this->conexion->prepare("UPDATE productos SET estado_id = 2 WHERE id = ?");	          
			$stm->execute(array($id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Actualizar(Productos $data){
		try {
			$sql = "UPDATE
					  productos
					SET
					  nombre = ?,
					  embalaje_id = ?,
					  categorias_id = ?
					WHERE
					  productos.id = ?";
			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('nombre'),
						$data->__GET('embalaje_id'),
						$data->__GET('categorias_id'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ActualizarStock(Productos $data){
		try {
			$sql = "UPDATE
					  productos
					SET
					  stockmin = ? 
					WHERE
					  productos.id = ?";
			$this->conexion->prepare($sql)->execute(array(
						$data->__GET('stockmin'),
						$data->__GET('id')
			));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Registrar(Productos $data){
		try {
		$sql = "INSERT INTO productos( nombre, stockmin, embalaje_id, categorias_id, estado_id)	VALUES(?,?,?,?,'1')";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('nombre'),
			$data->__GET('stockmin'),
			$data->__GET('embalaje_id'),
			$data->__GET('categorias_id')
		));
		return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>