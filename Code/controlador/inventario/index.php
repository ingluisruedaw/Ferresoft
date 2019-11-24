<?php 
	if (!isset($_SESSION)) session_start();
	require_once '../../modelo/Usuario/Entidad.php';
	require_once '../../modelo/Usuario/Modelo.php';
	$almUsuario = new Usuario();
	$modelUsuario = new Usuario_Model();

    require_once '../../modelo/Producto/Entidad.php';
    require_once '../../modelo/Producto/Modelo.php';
    $almProductos = new Productos();
    $modelProductos = new Productos_Model();

    require_once '../../modelo/Precios/Entidad.php';
    require_once '../../modelo/Precios/Modelo.php';
    $almPrecio_venta = new Precio_venta();
    $modelPrecio_venta = new Precio_venta_Model();

    require_once '../../modelo/Factura/Entidad.php';
    require_once '../../modelo/Factura/Modelo.php';
    $almFactura = new Factura();
    $modelFactura = new Factura_Model();

    require_once '../../modelo/Compra/Entidad.php';
    require_once '../../modelo/Compra/Modelo.php';
    $almCompras = new Compras();
    $modelCompras = new Compras_Model();

if(isset($_REQUEST['action'])){
    switch($_REQUEST['action']){
        case 'inventario'://home de la aplicacion
            include 'inventario.php';
            break;
        case 'logout'://home de la aplicacion
            include '../../modelo/Login/logout.php';
            break;
        case 'redirigir':
        	include 'modelo/Login/redirigir.php';
        	break;

        case 'listado_estados':
        	include('Estado/index.php');
        	break;

        case '9fG6XRoOMAluWAPHffJ2'://cambiar clave
            if (!isset($_REQUEST['modal_usuario'])) header('Location: ?action=dashboard');
            $almUsuario->__SET('usuario',$_REQUEST['modal_usuario']);
            $almUsuario->__SET('clave',$_REQUEST['modal_clave']);
            if ($modelUsuario->Actualizar_Clave($almUsuario)) {
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=inventario'; });</script>";
                
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=inventario'; });</script>";
            }
            break;

        case 'listado_productos':
            include('Producto/index.php');
            break;

        case 'listado_precios_de_venta_de_productos':
            include('Precios/index.php');
            break;

        case 'listado_ventas_activas':
            include('Factura/index.php');
            break;

        case 'listado_detalle_facturas':
            include('Factura/detalle/index.php');
            break;

        case 'listado_ventas_activas_por_fechas':
            include('Factura/filtrar/index.php');
            break;

        case 'listado_compras_activas':
            include('Compra/index.php');
            break;


        case '404':
           include 'views/404.php';
            break;
                
        default:
            header('Location: ?action=404');
    }
}else{
    header('Location: ?action=inventario');
    exit;
}           
?>