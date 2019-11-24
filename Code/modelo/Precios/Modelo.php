<?php
include_once("../../modelo/conexion.php");
class Precio_venta_Model{
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
											  precio_venta.id,
											  embalaje.det AS embalaje_det,
											  categorias.det AS categorias_det,
											  precio_venta.productos_id,
											  productos.nombre AS productos_nombre,
											  precio_venta.iva_id,
											  iva.det AS iva_det,
											  precio_venta.precio,
											  precio_venta.neto
											FROM
											  precio_venta
											  LEFT OUTER JOIN productos ON (precio_venta.productos_id = productos.id)
											  LEFT OUTER JOIN iva ON (precio_venta.iva_id = iva.id)
											  INNER JOIN embalaje ON (productos.embalaje_id = embalaje.id)
											  INNER JOIN categorias ON (productos.categorias_id = categorias.id)
											WHERE
											  precio_venta.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almPrecio_venta = new Precio_venta();
				$almPrecio_venta->__SET('id', $r->id);
				$almPrecio_venta->__SET('embalaje_det', $r->embalaje_det);
				$almPrecio_venta->__SET('categorias_det', $r->categorias_det);
				$almPrecio_venta->__SET('productos_id', $r->productos_id);
				$almPrecio_venta->__SET('productos_nombre', $r->productos_nombre);
				$almPrecio_venta->__SET('iva_id', $r->iva_id);
				$almPrecio_venta->__SET('iva_det', $r->iva_det);
				$almPrecio_venta->__SET('precio', $r->precio);
				$almPrecio_venta->__SET('neto', $r->neto);
				$result[] = $almPrecio_venta;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Desactivar($data){
		try {
			$sql = "UPDATE precio_venta SET estado_id = 3, fecha_cancelado = (select CURRENT_TIMESTAMP()) WHERE precio_venta.id = ?";
			$this->conexion->prepare($sql)->execute(array($data));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}
?>