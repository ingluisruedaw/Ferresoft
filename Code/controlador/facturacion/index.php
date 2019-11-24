<?php 
	if (!isset($_SESSION)) session_start();
	require_once '../../modelo/Usuario/Entidad.php';
	require_once '../../modelo/Usuario/Modelo.php';
	$almUsuario = new Usuario();
	$modelUsuario = new Usuario_Model();

    require_once '../../modelo/Precios/Entidad.php';
    require_once '../../modelo/Precios/Modelo.php';
    $almPrecio_venta = new Precio_venta();
    $modelPrecio_venta = new Precio_venta_Model();

    require_once '../../modelo/Cliente/Entidad.php';
    require_once '../../modelo/Cliente/Modelo.php';
    $almCliente = new Cliente();
    $modelCliente = new Cliente_Model();

    require_once '../../modelo/Factura/Entidad.php';
    require_once '../../modelo/Factura/Modelo.php';
    $almFactura = new Factura();
    $modelFactura = new Factura_Model();


if(isset($_REQUEST['action'])){
    switch($_REQUEST['action']){
        case 'facturacion'://facturacion por defecto
            include 'facturacion.php';
            break;
        case 'logout'://home de la aplicacion
            include '../../modelo/Login/logout.php';
            break;
        case 'redirigir':
        	include 'modelo/Login/redirigir.php';
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

        case 'Y2s09AfFnlu4GCmE9eV5'://precio de venta de productos
            include('Precios/index.php');
            break;

        case 'KPFABKH0O0nrsqVpdfWS'://clientes existentes
            include('Cliente/index.php');
            break;

        case '6EPK2aQgvEmYi4hoFY9K'://actualizar cliente
            if (!isset($_REQUEST['modal_id'])) header('Location: ?action=KPFABKH0O0nrsqVpdfWS');
            $almCliente->__SET('persona_id', $_REQUEST['modal_id']);
            $almCliente->__SET('persona_nombres', $_REQUEST['modal_nombres']);
            $almCliente->__SET('direccion', $_REQUEST['modal_direccion']);
            $almCliente->__SET('telefono', $_REQUEST['modal_telefono']);
            $almCliente->__SET('correo', $_REQUEST['modal_correo']);
            if($modelCliente->ActualizarPersona($almCliente)){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
            }
            break;

        case 'u4VNJvpXkkgTaBs8Ne6X'://insertar clientes
            if (!isset($_REQUEST['insercion_documento'])) header('Location: ?action=KPFABKH0O0nrsqVpdfWS');
            if($modelCliente->ExisteCliente($_REQUEST['insercion_documento'])){
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Cliente Existente', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
            }else{//no existe cliente
                if($modelCliente->ExistePersona($_REQUEST['insercion_documento'])==false){//no existe persona
                    $almCliente->__SET('persona_id', $_REQUEST['insercion_documento']);
                    $almCliente->__SET('persona_nombres', $_REQUEST['insercion_nombres']);
                    $almCliente->__SET('direccion', $_REQUEST['insercion_direccion']);
                    $almCliente->__SET('telefono', $_REQUEST['insercion_telefono']);
                    $almCliente->__SET('correo', $_REQUEST['insercion_email']);
                    if($modelCliente->RegistrarPersona($almCliente)){//si registro a la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE INSERTARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }
                    }else{
                        echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR LOS DATOS DE LA PERSONA Y EL CLIENTE', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                    }
                }else{//existe persona
                    $almCliente->__SET('persona_id', $_REQUEST['insercion_documento']);
                    $almCliente->__SET('persona_nombres', $_REQUEST['insercion_nombres']);
                    $almCliente->__SET('direccion', $_REQUEST['insercion_direccion']);
                    $almCliente->__SET('telefono', $_REQUEST['insercion_telefono']);
                    $almCliente->__SET('correo', $_REQUEST['insercion_email']);
                    if($modelCliente->ActualizarPersona($almCliente)){//si actualizo la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE ACTUALIZARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }
                    }else{//si no actualizo la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=KPFABKH0O0nrsqVpdfWS'; });</script>";
                        }
                    }
                }
            }
            break;

        case 'XeF6Z1ui1ErToXu9dj31'://factura listar
            include('Factura/index.php');
            break;

        case 'datos_basicos_preparar_factura'://se va para preparar factura
            if (!isset($_REQUEST['insercion_fecha'])) header('Location: ?action=XeF6Z1ui1ErToXu9dj31');
            $almFactura->__SET('empleados_id', $_REQUEST['insercion_empleado_id']);
            $almFactura->__SET('clientes_id', $_REQUEST['insercion_cliente_id']);
            $almFactura->__SET('fecha', $_REQUEST['insercion_fecha']);
            if ($modelFactura->InsertarTemporal($almFactura)) {
                $idfactura = $modelFactura -> BuscarIdTemporal($almFactura);
                if(is_null($idfactura)){
                    //SI ES NULO NO HAGAS NADA
                    echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'INTENTE NUEVAMENTE, SI EL ERROR PERSISTE COMUNIQUE AL AREA ENCARGADA', function(){ window.location='?action=XeF6Z1ui1ErToXu9dj31'; });</script>";
                }else{
                    $_SESSION['factura']=$idfactura;
                    header('Location: ?action=qk8x15GZC5otLUnCFwPx');
                }
            }
            break;

        case 'qk8x15GZC5otLUnCFwPx'://preparar factura;
            include('Factura/preparar/index.php');
            break;

        case '78SqNdwrnRLDt0TMeA5E'://anexar productos a prefactura
            if (!isset($_REQUEST['insercion_factura_id'])) header('Location: ?action=qk8x15GZC5otLUnCFwPx');
            $almFactura->__SET('precio_venta_id', $_REQUEST['insercion_producto_id']);
            $almFactura->__SET('cantidad', $_REQUEST['insercion_cantidad']);
            $almFactura->__SET('id', $_REQUEST['insercion_factura_id']);
            if($modelFactura->InsertarDetalleFacturaTemporal($almFactura)){
                    echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'INFORMACIÓN ALMACENADA', function(){ window.location='?action=qk8x15GZC5otLUnCFwPx'; });</script>";
                }else{
                    echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'INFORMACIÓN NO ALMACENADA', function(){ window.location='?action=qk8x15GZC5otLUnCFwPx'; });</script>";
                }
            break;

        case 'msAONLRfp20m7x5Tx8JQ'://cobrar factura
            if (!isset($_REQUEST['cobrar_factura_id'])) header('Location: ?action=qk8x15GZC5otLUnCFwPx');
            if($modelFactura->ConfirmarFacturaTemporal($_REQUEST['cobrar_factura_id'],$_REQUEST['cobrar_total'])){
                unset($_SESSION['factura']);
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'VENTA REALIZADA', function(){ window.location='?action=XeF6Z1ui1ErToXu9dj31'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ CONFIRMAR LA VENTA. INTENTE NUEVAMENTE', function(){ window.location='?action=qk8x15GZC5otLUnCFwPx'; });</script>";
            }
            break;

        case '404':
           include 'views/404.php';
            break;
                
        default:
            header('Location: ?action=404');
    }
}else{
    header('Location: ?action=facturacion');
    exit;
}           
?>