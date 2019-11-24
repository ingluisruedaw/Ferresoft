<?php
/*
estados
0=activo
1=eliminado
*/
include_once("../../modelo/conexion.php");
class Factura_Model{
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
											  factura.id,
											  factura.empleados_id,
											  persona.nombres AS empleados_nombres,
											  factura.clientes_id,
											  persona1.nombres AS clientes_nombres,
											  factura.fecha,
											  factura.total
											FROM
											  factura
											  INNER JOIN empleados ON (factura.empleados_id = empleados.id)
											  INNER JOIN clientes ON (factura.clientes_id = clientes.id)
											  INNER JOIN persona ON (empleados.persona_id = persona.id)
											  INNER JOIN persona persona1 ON (clientes.persona_id = persona1.id)
											WHERE
											  factura.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('id', $r->id);
				$almFactura->__SET('empleados_id', $r->empleados_id);
				$almFactura->__SET('empleados_nombres', $r->empleados_nombres);
				$almFactura->__SET('clientes_id', $r->clientes_id);
				$almFactura->__SET('clientes_nombres', $r->clientes_nombres);
				$almFactura->__SET('fecha', $r->fecha);
				$almFactura->__SET('total', $r->total);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar_ActivosPorEmpleado($data){
		try{
			$result = array();
			$fecha = date("Y-m-d");
			$stm = $this->conexion->prepare("SELECT 
											  factura.id,
											  persona1.nombres AS clientes_nombres,
											  factura.fecha,
											  factura.total
											FROM
											  factura
											  INNER JOIN clientes ON (factura.clientes_id = clientes.id)
											  INNER JOIN persona persona1 ON (clientes.persona_id = persona1.id)
											WHERE
											  factura.estado_id = 1 AND 
											  factura.empleados_id = ? AND 
											  factura.fecha >= ? ");
			$stm->execute(
				array(
					$data,
					$fecha
				)
			);

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('id', $r->id);
				$almFactura->__SET('clientes_nombres', $r->clientes_nombres);
				$almFactura->__SET('fecha', $r->fecha);
				$almFactura->__SET('total', $r->total);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar_Temporales($data){
		try{
			$result = array();
			$stm = $this->conexion->prepare("SELECT 
											  det_factura.id,
											  categorias.det AS categoria_det,
											  embalaje.det AS embalaje_det,
											  productos.nombre AS productos_nombre,
											  iva.det AS iva_det,
											  precio_venta.neto AS precio_venta_neto,
											  det_factura.cantidad,
											  (precio_venta.neto * det_factura.cantidad) AS total
											FROM
											  det_factura
											  INNER JOIN precio_venta ON (det_factura.precio_venta_id = precio_venta.id)
											  INNER JOIN productos ON (precio_venta.productos_id = productos.id)
											  INNER JOIN embalaje ON (productos.embalaje_id = embalaje.id)
											  INNER JOIN categorias ON (productos.categorias_id = categorias.id)
											  INNER JOIN iva ON (precio_venta.iva_id = iva.id)
											WHERE
											  det_factura.factura_id = ?");
			$stm->execute(array($data));
			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('id', $r->id);
				$almFactura->__SET('categoria_det', $r->categoria_det);
				$almFactura->__SET('embalaje_det', $r->embalaje_det);
				$almFactura->__SET('productos_nombre', $r->productos_nombre);
				$almFactura->__SET('iva_det', $r->iva_det);
				$almFactura->__SET('precio_venta_neto', $r->precio_venta_neto);
				$almFactura->__SET('cantidad', $r->cantidad);
				$almFactura->__SET('total', $r->total);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar_Detalle_Factura($id_factura){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT 
											  det_factura.id,
											  embalaje.det AS embalaje_det,
											  productos.nombre AS productos_nombre,
											  iva.det AS iva_det,
											  precio_venta.neto AS precio_venta_neto,
											  det_factura.cantidad,
											  (precio_venta.neto * det_factura.cantidad) AS total
											FROM
											  det_factura
											  INNER JOIN precio_venta ON (det_factura.precio_venta_id = precio_venta.id)
											  INNER JOIN iva ON (precio_venta.iva_id = iva.id)
											  INNER JOIN productos ON (precio_venta.productos_id = productos.id)
											  INNER JOIN embalaje ON (productos.embalaje_id = embalaje.id)
											WHERE
											  det_factura.factura_id = ?");
			$stm->execute(array($id_factura));

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('id', $r->id);
				$almFactura->__SET('embalaje_det', $r->embalaje_det);
				$almFactura->__SET('productos_nombre', $r->productos_nombre);
				$almFactura->__SET('iva_det', $r->iva_det);
				$almFactura->__SET('precio_venta_neto', $r->precio_venta_neto);
				$almFactura->__SET('cantidad', $r->cantidad);
				$almFactura->__SET('total', $r->total);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function Listar_Activos_Por_Fechas($f_ini, $f_fin){
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT 
											  factura.id,
											  factura.empleados_id,
											  persona.nombres AS empleados_nombres,
											  factura.clientes_id,
											  persona1.nombres AS clientes_nombres,
											  factura.fecha,
											  factura.total 
											FROM
											  factura
											  INNER JOIN empleados ON (factura.empleados_id = empleados.id)
											  INNER JOIN clientes ON (factura.clientes_id = clientes.id)
											  INNER JOIN persona ON (empleados.persona_id = persona.id)
											  INNER JOIN persona persona1 ON (clientes.persona_id = persona1.id)
											WHERE
											  factura.estado_id = 1 AND 
											  factura.fecha BETWEEN ? AND ?");
			$stm->execute(
				array(
					$f_ini,
					$f_fin
				)
			);

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('id', $r->id);
				$almFactura->__SET('empleados_id', $r->empleados_id);
				$almFactura->__SET('empleados_nombres', $r->empleados_nombres);
				$almFactura->__SET('clientes_id', $r->clientes_id);
				$almFactura->__SET('clientes_nombres', $r->clientes_nombres);
				$almFactura->__SET('fecha', $r->fecha);
				$almFactura->__SET('total', $r->total);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function BuscarIdTemporal(Factura $data){//facturas temporales
		try{
			$stm = $this->conexion->prepare("SELECT 
											  factura.id
											FROM
											  factura
											WHERE
											  factura.empleados_id = ? AND 
											  factura.clientes_id = ? AND 
											  factura.fecha = ? AND 
											  factura.total = 0 AND 
											  factura.estado_id = 5");
			$stm->execute(
				array(
					$data->__GET('empleados_id'),
					$data->__GET('clientes_id'),
					$data->__GET('fecha')
				)
			);
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->id)) {				
				return $r->id;
			}else{
				return null;
			}
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function BuscarTotalTemporal($data){//total de la factura temporal recibe id factura
		try{
			$stm = $this->conexion->prepare("SELECT 
											  sum(det_factura.cantidad * precio_venta.neto) AS total
											FROM
											  det_factura
											  INNER JOIN precio_venta ON (det_factura.precio_venta_id = precio_venta.id)
											WHERE
											  det_factura.factura_id = ?");
			$stm->execute(array($data));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->total)) {				
				return $r->total;
			}else{
				return null;
			}
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function ListarCompradorPDF($data){//total de la factura temporal recibe id factura
		try{
			$result = array();
			$stm = $this->conexion->prepare("select 
												`persona`.`nombres` AS `empleado`,
												`persona1`.`nombres` AS `cliente`,
												`factura`.`fecha` AS `fecha` 
											from ((((`factura` join `empleados` 
												on((`factura`.`empleados_id` = `empleados`.`id`))) join `clientes` on((`factura`.`clientes_id` = `clientes`.`id`))) join `persona` on((`empleados`.`persona_id` = `persona`.`id`))) join `persona` `persona1` on((`clientes`.`persona_id` = `persona1`.`id`))) where (`factura`.`id` = ?)");
			$stm->execute(array($data));
			$r = $stm->fetch(PDO::FETCH_OBJ);
			if (isset($r->empleado)) {				
				$almFactura = new Factura();
				$almFactura->__SET('empleados_nombres', $r->empleado);
				$almFactura->__SET('clientes_nombres', $r->cliente);
				$almFactura->__SET('fecha', $r->fecha);
				$result[] = $almFactura;
				return $result;
			}else{
				return null;
			}
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	

	public function Anular($factura_id){
		try {
			$sql = "UPDATE factura SET estado_id = 4 WHERE id = ?";
			$this->conexion->prepare($sql)->execute(array($factura_id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function InsertarTemporal(Factura $data){//INSERTA LA FACTURA SIEMPRE CON ESTADO POR PROCESAR
		try {
		$sql = "INSERT INTO
				  factura(
				  empleados_id,
				  clientes_id,
				  fecha,
				  total,
				  estado_id)
				VALUES(
				  ?,
				  ?,
				  ?,
				  0,
				  5)";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('empleados_id'),
			$data->__GET('clientes_id'),
			$data->__GET('fecha')
			)
		);
		return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function InsertarDetalleFacturaTemporal(Factura $data){//INSERTA LA FACTURA SIEMPRE CON ESTADO POR PROCESAR
		try {
		$sql = "INSERT INTO det_factura( factura_id, precio_venta_id, cantidad, estado_id) VALUES( ?, ?, ?, 5)";
		$this->conexion->prepare($sql)->execute(array(
			$data->__GET('id'),
			$data->__GET('precio_venta_id'),
			$data->__GET('cantidad')
			)
		);
		return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function Listar_ProductosFacturaTemporal(){//listo los precios de ventas de productos para agregar
		try{
			$result = array();

			$stm = $this->conexion->prepare("SELECT 
											  precio_venta.id as precio_venta_id,
											  embalaje.det as embalaje_det,
											  productos.nombre as productos_nombre,
											  iva.det as iva_det,
											  precio_venta.neto as precio_venta_neto
											FROM
											  precio_venta
											  INNER JOIN productos ON (precio_venta.productos_id = productos.id)
											  INNER JOIN embalaje ON (productos.embalaje_id = embalaje.id)
											  INNER JOIN iva ON (precio_venta.iva_id = iva.id)
											WHERE
											  precio_venta.estado_id = 1");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
				$almFactura = new Factura();
				$almFactura->__SET('precio_venta_id', $r->precio_venta_id);
				$almFactura->__SET('embalaje_det', $r->embalaje_det);
				$almFactura->__SET('productos_nombre', $r->productos_nombre);
				$almFactura->__SET('iva_det', $r->iva_det);
				$almFactura->__SET('precio_venta_neto', $r->precio_venta_neto);
				$result[] = $almFactura;
			}
			return $result;
		} catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function ConfirmarFacturaTemporal($data, $totalfactura){//actualiza el estado de la factura temporal a activa
		try {
			$sql = "UPDATE factura SET estado_id = 1, total = ? WHERE factura.id = ?";
			$this->conexion->prepare($sql)->execute(array($totalfactura,$data));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	/*public function agregarTotalFactura($total, $factura_id){//actualiza el total de la factura
		try {
			$sql = "UPDATE factura SET total = ? WHERE factura.id = ?";
			$this->conexion->prepare($sql)->execute(array($total,$factura_id));
			return true;
		} catch (Exception $e) {
			return false;
		}
	}*/


	/*public function Existe($det){
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

	*/
}
?>