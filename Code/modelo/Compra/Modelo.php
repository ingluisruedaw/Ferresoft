<?php
include_once("../../modelo/conexion.php");
class Compras_Model{
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
											  compras.id,
											  compras.productos_id,
											  productos.nombre AS productos_nombre,
											  productos.categorias_id AS productos_categorias_id,
											  categorias.det AS productos_categorias_det,
											  compras.proveedores_id,
											  proveedores.det AS proveedores_det,
											  compras.precio,
											  compras.iva_id,
											  iva.det AS iva_det,
											  compras.cantidad,
											  compras.fecha
											FROM
											  compras
											  INNER JOIN proveedores ON (compras.proveedores_id = proveedores.id)
											  INNER JOIN productos ON (compras.productos_id = productos.id)
											  INNER JOIN categorias ON (productos.categorias_id = categorias.id)
											  INNER JOIN iva ON (compras.iva_id = iva.id)
											WHERE
											  compras.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almCompras = new Compras();
				$almCompras->__SET('id', $r->id);
				$almCompras->__SET('productos_id', $r->productos_id);
				$almCompras->__SET('productos_nombre', $r->productos_nombre);
				$almCompras->__SET('productos_categorias_id', $r->productos_categorias_id);
				$almCompras->__SET('productos_categorias_det', $r->productos_categorias_det);
				$almCompras->__SET('proveedores_id', $r->proveedores_id);
				$almCompras->__SET('proveedores_det', $r->proveedores_det);
				$almCompras->__SET('precio', $r->precio);
				$almCompras->__SET('iva_id', $r->iva_id);
				$almCompras->__SET('iva_det', $r->iva_det);
				$almCompras->__SET('cantidad', $r->cantidad);
				$almCompras->__SET('fecha', $r->fecha);
				$result[] = $almCompras;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	/*public function Existe(Productos $data){
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
	}*/

	public function Registrar(Compras $data){
		try {
		$sql = "INSERT INTO
				  compras(
				  productos_id,
				  proveedores_id,
				  precio,
				  iva_id,
				  cantidad,
				  fecha,
				  estado_id)
				VALUES(
				  ?,
				  ?,
				  ?,
				  ?,
				  ?,
				  ?,
				  1)";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('productos_id'),
			$data->__GET('proveedores_id'),
			$data->__GET('precio'),
			$data->__GET('iva_id'),
			$data->__GET('cantidad'),
			$data->__GET('fecha')
		));
		return true;
		} catch (Exception $e) {
			//echo $e->getMessage();
			return false;
		}
	}
}
?>