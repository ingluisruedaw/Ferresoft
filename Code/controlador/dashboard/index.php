<?php 
	if (!isset($_SESSION)) session_start();
    require_once '../../modelo/Estado/Entidad.php';
	require_once '../../modelo/Estado/Modelo.php';
	$almEstado = new Estado();
	$modelEstado = new Estado_Model();

	require_once '../../modelo/Categoria/Entidad.php';
	require_once '../../modelo/Categoria/Modelo.php';
	$almCategoria = new Categoria();
	$modelCategoria = new Categoria_Model();

	require_once '../../modelo/Rol/Entidad.php';
	require_once '../../modelo/Rol/Modelo.php';
	$almRoles = new Roles();
	$modelRoles = new Roles_Model();

	require_once '../../modelo/Usuario/Entidad.php';
	require_once '../../modelo/Usuario/Modelo.php';
	$almUsuario = new Usuario();
	$modelUsuario = new Usuario_Model();

	require_once '../../modelo/Iva/Entidad.php';
	require_once '../../modelo/Iva/Modelo.php';
	$almIva = new Iva();
	$modelIva = new Iva_Model();

	require_once '../../modelo/Embalaje/Entidad.php';
	require_once '../../modelo/Embalaje/Modelo.php';
	$almEmbalaje = new Embalaje();
	$modelEmbalaje = new Embalaje_Model();

	require_once '../../modelo/Producto/Entidad.php';
	require_once '../../modelo/Producto/Modelo.php';
	$almProductos = new Productos();
	$modelProductos = new Productos_Model();

	require_once '../../modelo/Precios/Entidad.php';
	require_once '../../modelo/Precios/Modelo.php';
	$almPrecio_venta = new Precio_venta();
	$modelPrecio_venta = new Precio_venta_Model();

	require_once '../../modelo/Proveedor/Entidad.php';
	require_once '../../modelo/Proveedor/Modelo.php';
	$almProveedor = new Proveedor();
	$modelProveedor = new Proveedor_Model();

    require_once '../../modelo/Cliente/Entidad.php';
    require_once '../../modelo/Cliente/Modelo.php';
    $almCliente = new Cliente();
    $modelCliente = new Cliente_Model();

    require_once '../../modelo/Empleado/Entidad.php';
    require_once '../../modelo/Empleado/Modelo.php';
    $almEmpleado = new Empleado();
    $modelEmpleado = new Empleado_Model();

    require_once '../../modelo/Compra/Entidad.php';
    require_once '../../modelo/Compra/Modelo.php';
    $almCompras = new Compras();
    $modelCompras = new Compras_Model();

    require_once '../../modelo/Factura/Entidad.php';
    require_once '../../modelo/Factura/Modelo.php';
    $almFactura = new Factura();
    $modelFactura = new Factura_Model();

if(isset($_REQUEST['action'])){
    switch($_REQUEST['action']){
        case 'dashboard'://home de la aplicacion
            include 'dashboard.php';
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
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=dashboard'; });</script>";
                
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=dashboard'; });</script>";
            }
            break;

        case 'actualizar_estados':
        	if (!isset($_REQUEST['modal_id'])) header('Location: ?action=listado_estados');
        	$almEstado->__SET('id',$_REQUEST['modal_id']);
            $almEstado->__SET('det',$_REQUEST['modal_det']);
            if ($modelEstado->Actualizar($almEstado)) {
            	//include('Estado/index.php');
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_estados'; });</script>";
            }else{
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_estados'; });</script>";
            }
        	break;

        case 'eliminar_estados':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_estados');
        	if ($modelEstado->Eliminar($_REQUEST['eliminar_id'])) {
            	//include('Estado/index.php');
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_estados'; });</script>";
            }else{
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_estados'; });</script>";
            }
        	break;

        case 'insertar_estados':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_estados');
        	if($modelEstado->Existe($_REQUEST['insercion_det'])){
        		$almEstado->__SET('det',$_REQUEST['insercion_det']);
	        	if ($modelEstado->Registrar($almEstado)) {
	            	//include('Estado/index.php');
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_estados'; });</script>";
	            }else{
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_estados'; });</script>";
	            }
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada. Registro Existente', function(){ window.location='?action=listado_estados'; });</script>";
	        }
        	break;

        case 'listado_roles_usuarios':
        	include('Rol/index.php');
        	break;

        case 'actualizar_roles_usuarios':
        	if (!isset($_REQUEST['modal_id'])) header('Location: ?action=listado_roles_usuarios');
        	if($modelRoles->Existe($_REQUEST['modal_det'])){
	        	$almRoles->__SET('id',$_REQUEST['modal_id']);
	            $almRoles->__SET('det',$_REQUEST['modal_det']);
	            if ($modelRoles->Actualizar($almRoles)) {
	            	//include('Estado/index.php');
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
	            }else{
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
	            }
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada. Registro Existente', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
        	}
        	break;

        case 'eliminar_roles_usuarios':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_roles_usuarios');
        	if ($modelRoles->Eliminar($_REQUEST['eliminar_id'])) {
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
            }else{
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
            }
        	break;

        case 'insertar_roles_usuarios':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_roles_usuarios');
        	if($modelRoles->Existe($_REQUEST['insercion_det'])){
        		$almRoles->__SET('det',$_REQUEST['insercion_det']);
	        	if ($modelRoles->Registrar($almRoles)) {
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
	            }else{
	            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
	            }
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada. Registro Existente', function(){ window.location='?action=listado_roles_usuarios'; });</script>";
	        }
        	break;

        case 'listado_usuarios':
        	include('Usuario/index.php');
        	break;

        case 'actualizar_usuarios':
        	if (!isset($_REQUEST['modal_empleado'])) header('Location: ?action=listado_usuarios');
        	if($modelUsuario->Existe_Empleado($_REQUEST['modal_empleado'])){
        		$almUsuario->__SET('usuario', $_REQUEST['ActualizarUsuarioU']);
	        	$almUsuario->__SET('roles_id', $_REQUEST['modal_rol']);
	        	$almUsuario->__SET('empleados_id', $_REQUEST['modal_empleado']);
	        	$modelUsuario->Actualizar_Otros($almUsuario);
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_usuarios'; });</script>";
        		}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Empleado Inexistente', function(){ window.location='?action=listado_usuarios'; });</script>";
        		}    
        	break;
        
        case 'actualizar_clave_usuario':
        	if (!isset($_REQUEST['modalActualizarClaveUc'])) header('Location: ?action=listado_usuarios');
        	$almUsuario->__SET('usuario', $_REQUEST['modal_usuario_n']);
	        $almUsuario->__SET('clave', $_REQUEST['modalActualizarClaveUc']);
        	if ($modelUsuario->Actualizar_Clave($almUsuario)) {
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_usuarios'; });</script>";
            }else{
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_usuarios'; });</script>";
            }
        	break;

        case 'eliminar_usuarios':
        	if (!isset($_REQUEST['eliminar_usuario'])) header('Location: ?action=listado_usuarios');
        	if ($modelUsuario->Eliminar($_REQUEST['eliminar_usuario'])) {
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_usuarios'; });</script>";
            }else{
            	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada', function(){ window.location='?action=listado_usuarios'; });</script>";
            }
        	break;

        case 'insertar_usuarios':
        	if (!isset($_REQUEST['insercion_usuario'])) header('Location: ?action=listado_usuarios');
        	$busqueda=$modelUsuario->Existe($_REQUEST['insercion_usuario']);
        	if (is_null($busqueda)) {//no existe
        		if($modelUsuario->Existe_Empleado($_REQUEST['insercion_empleado_id'])){
        			$almUsuario->__SET('usuario', $_REQUEST['insercion_usuario']);
	        		$almUsuario->__SET('clave', $_REQUEST['insercion_clave']);
	        		$almUsuario->__SET('roles_id', $_REQUEST['insercion_rol']);
	        		$almUsuario->__SET('empleados_id', $_REQUEST['insercion_empleado_id']);
	        		if($modelUsuario->Registrar($almUsuario)){
	        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_usuarios'; });</script>";
	        		}
        		}else{
        			echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Empleado Inexistente', function(){ window.location='?action=listado_usuarios'; });</script>";
        		}        		
        	}else{
        		if($busqueda==1){//activo
        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Errada. Registro Existente', function(){ window.location='?action=listado_usuarios'; });</script>";
        		}else{//eliminado  
        			if($modelUsuario->Existe_Empleado($_REQUEST['insercion_empleado_id'])){      			
	        			$almUsuario->__SET('usuario', $_REQUEST['insercion_usuario']);
	        			$almUsuario->__SET('clave', $_REQUEST['insercion_clave']);
	        			$almUsuario->__SET('roles_id', $_REQUEST['insercion_rol']);
	        			$almUsuario->__SET('empleados_id', $_REQUEST['insercion_empleado_id']);
	        			$almUsuario->__SET('estado_id', 1);
	        			$modelUsuario->Actualizar($almUsuario);
	        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_usuarios'; });</script>";
        			}else{
        			echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Empleado Inexistente', function(){ window.location='?action=listado_usuarios'; });</script>";
        			}    
        		}
        	}
        	break;

        case 'listado_impuesto_iva':
        	include('Iva/index.php');
        	break;

        case 'actualizar_impuesto_iva':
        	if (!isset($_REQUEST['modal_det'])) header('Location: ?action=listado_impuesto_iva');
        	if ($modelIva->Existe($_REQUEST['modal_det'])) {//no existe
        		$almIva->__SET('id',$_REQUEST['modal_id']);
        		$almIva->__SET('det',$_REQUEST['modal_det']);
	        	if($modelIva->Actualizar($almIva)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Porcentaje Existente', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
        	}
        	break;

        case 'eliminar_impuesto_iva':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_impuesto_iva');
	        if($modelIva->Eliminar($_REQUEST['eliminar_id'])){
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        }
        	break;

        case 'insertar_impuesto_iva':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_impuesto_iva');
        	if ($modelIva->Existe($_REQUEST['insercion_det'])) {//no existe
	        	if($modelIva->Registrar($_REQUEST['insercion_det'])){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL REGISTRO', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Porcentaje Existente', function(){ window.location='?action=listado_impuesto_iva'; });</script>";
        	}
        	break;

       	case 'listado_categorias':
        	include('Categoria/index.php');
        	break;

        case 'actualizar_categorias':
        	if (!isset($_REQUEST['modal_det'])) header('Location: ?action=listado_categorias');
        	if ($modelCategoria->Existe($_REQUEST['modal_det'])) {//no existe
	        	$almCategoria->__SET('id', $_REQUEST['modal_id']);
	        	$almCategoria->__SET('det', $_REQUEST['modal_det']);
	        	if($modelCategoria->Actualizar($almCategoria)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_categorias'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_categorias'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Categoria Existente', function(){ window.location='?action=listado_categorias'; });</script>";
        	}
        	break;

        case 'eliminar_categorias':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_categorias');
        	if($modelCategoria->Eliminar($_REQUEST['eliminar_id'])){
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_categorias'; });</script>";
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_categorias'; });</script>";
	        }
        	break;

        case 'insertar_categorias':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_categorias');
        	if ($modelCategoria->Existe($_REQUEST['insercion_det'])) {//no existe
	        	if($modelCategoria->Registrar($_REQUEST['insercion_det'])){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_categorias'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL REGISTRO', function(){ window.location='?action=listado_categorias'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Categoria Existente', function(){ window.location='?action=listado_categorias'; });</script>";
        	}
        	break;

        case 'listado_embalaje_de_productos':
        	include('Embalaje/index.php');
        	break;

        case 'actualizar_embalaje_de_productos':
        	if (!isset($_REQUEST['modal_det'])) header('Location: ?action=listado_embalaje_de_productos');
        	if ($modelEmbalaje->Existe($_REQUEST['modal_det'])) {//no existe
	        	$almEmbalaje->__SET('id', $_REQUEST['modal_id']);
	        	$almEmbalaje->__SET('det', $_REQUEST['modal_det']);
	        	if($modelEmbalaje->Actualizar($almEmbalaje)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Embalaje Existente', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
        	}
        	break;

        case 'eliminar_embalaje_de_productos':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_embalaje_de_productos');
        	if($modelEmbalaje->Eliminar($_REQUEST['eliminar_id'])){
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        }
        	break;

        case 'insertar_embalaje_de_productos':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_embalaje_de_productos');
        	if ($modelEmbalaje->Existe($_REQUEST['insercion_det'])) {//no existe
	        	if($modelEmbalaje->Registrar($_REQUEST['insercion_det'])){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL REGISTRO', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Embalaje Existente', function(){ window.location='?action=listado_embalaje_de_productos'; });</script>";
        	}
        	break;

        case 'listado_productos':
        	include('Producto/index.php');
        	break;

        case 'actualizar_productos':
        	if (!isset($_REQUEST['modal_nombre'])) header('Location: ?action=listado_productos');
        	$almProductos->__SET('nombre', $_REQUEST['modal_nombre']);
        	$almProductos->__SET('embalaje_id', $_REQUEST['modal_embalaje']);
        	if ($modelProductos->Existe($almProductos)) {//no existe
	        	$almProductos->__SET('id', $_REQUEST['modal_id']);
	        	$almProductos->__SET('categorias_id', $_REQUEST['modal_categoria']);
	        	if($modelProductos->Actualizar($almProductos)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_productos'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_productos'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Producto Existente', function(){ window.location='?action=listado_productos'; });</script>";
        	}
        	break;

        case 'actualizar_stock_productos':
        	if (!isset($_REQUEST['modal_stock'])) header('Location: ?action=listado_productos');
	        	$almProductos->__SET('id', $_REQUEST['modal_idn']);
	        	$almProductos->__SET('stockmin', $_REQUEST['modal_stock']);
	        	if($modelProductos->ActualizarStock($almProductos)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_productos'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_productos'; });</script>";
	        	}
        	break;

        case 'eliminar_productos':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_productos');
        	if($modelProductos->Eliminar($_REQUEST['eliminar_id'])){
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_productos'; });</script>";
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_productos'; });</script>";
	        }
        	break;

        case 'insertar_productos':
        	if (!isset($_REQUEST['insertar_nombre']) || !isset($_REQUEST['insertar_embalaje'])) header('Location: ?action=listado_productos');
        	$almProductos->__SET('nombre', $_REQUEST['insertar_nombre']);
        	$almProductos->__SET('embalaje_id', $_REQUEST['insertar_embalaje']);
        	if ($modelProductos->Existe($almProductos)) {//no existe
	        	$almProductos->__SET('stockmin', $_REQUEST['insertar_stock']);
	        	$almProductos->__SET('categorias_id', $_REQUEST['insertar_categoria']);
	        	if($modelProductos->Registrar($almProductos)){
	        		echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_productos'; });</script>";
	        	}else{
	        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_productos'; });</script>";
	        	}
        	}else{
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Producto Existente', function(){ window.location='?action=listado_productos'; });</script>";
        	}
        	break;

        case 'listado_precios_de_venta_de_productos':
        	include('Precios/index.php');
        	break;

        case 'desactivar_precios_de_venta_de_productos':
            if (!isset($_REQUEST['desactivar_id'])) header('Location: ?action=listado_precios_de_venta_de_productos');
            if($modelPrecio_venta->Desactivar($_REQUEST['desactivar_id'])){
                    echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_precios_de_venta_de_productos'; });</script>";
                }else{
                    echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ DESACTIVAR EL REGISTRO', function(){ window.location='?action=listado_precios_de_venta_de_productos'; });</script>";
                }
            break;

        case 'listado_proveedores':
        	include('Proveedor/index.php');
        	break;

        case 'actualizar_nombre_proveedores':
        	if (!isset($_REQUEST['modal_det'])) header('Location: ?action=listado_proveedores');
        	if ($modelProveedor->Existe($_REQUEST['modal_det'])) {//no existe
        		$almProveedor->__SET('id', $_REQUEST['modal_id']);
        		$almProveedor->__SET('det', $_REQUEST['modal_det']);
        		if($modelProveedor->Actualizar($almProveedor)){
        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}else{//error al actualizar
        			echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}
        	}else{//existe
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Proveedor Existente', function(){ window.location='?action=listado_proveedores'; });</script>";
        	}
        	break;

        case 'actualizar_proveedores':
        	if (!isset($_REQUEST['modal_idn'])) header('Location: ?action=listado_proveedores');
        		$almProveedor->__SET('id', $_REQUEST['modal_idn']);
        		$almProveedor->__SET('direccion', $_REQUEST['modal_direccion']);
        		$almProveedor->__SET('telefono', $_REQUEST['modal_telefono']);
        		$almProveedor->__SET('email', $_REQUEST['modal_correo']);
        		if($modelProveedor->ActualizarOtros($almProveedor)){
        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}else{//error al actualizar
        			echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}
        	break;

        case 'eliminar_proveedores':
        	if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_proveedores');
        	if($modelProveedor->Eliminar($_REQUEST['eliminar_id'])){
	        	echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_proveedores'; });</script>";
	        }else{
	        	echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_proveedores'; });</script>";
	        }
        	break;

        case 'insertar_proveedores':
        	if (!isset($_REQUEST['insercion_det'])) header('Location: ?action=listado_proveedores');
        	if ($modelProveedor->Existe($_REQUEST['insercion_det'])) {//no existe
        		$almProveedor->__SET('det', $_REQUEST['insercion_det']);
        		$almProveedor->__SET('direccion', $_REQUEST['insercion_direccion']);
        		$almProveedor->__SET('telefono', $_REQUEST['insercion_telefono']);
        		$almProveedor->__SET('email', $_REQUEST['insercion_email']);
        		if($modelProveedor->Registrar($almProveedor)){
        			echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}else{//error al actualizar
        			echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL REGISTRO', function(){ window.location='?action=listado_proveedores'; });</script>";
        		}
        	}else{//existe
        		echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Acción Errada. Proveedor Existente', function(){ window.location='?action=listado_proveedores'; });</script>";
        	}
        	break;

        case 'listado_clientes':
            include('Cliente/index.php');
            break;

        case 'actualizar_clientes':
            if (!isset($_REQUEST['modal_id'])) header('Location: ?action=listado_clientes');
            $almCliente->__SET('persona_id', $_REQUEST['modal_id']);
            $almCliente->__SET('persona_nombres', $_REQUEST['modal_nombres']);
            $almCliente->__SET('direccion', $_REQUEST['modal_direccion']);
            $almCliente->__SET('telefono', $_REQUEST['modal_telefono']);
            $almCliente->__SET('correo', $_REQUEST['modal_correo']);
            if($modelCliente->ActualizarPersona($almCliente)){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_clientes'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR EL REGISTRO', function(){ window.location='?action=listado_clientes'; });</script>";
            }
            break;

        case 'eliminar_clientes':
            if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_clientes');
            if($modelCliente->Eliminar($_REQUEST['eliminar_id'])){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_clientes'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_clientes'; });</script>";
            }
            break;

        case 'insertar_clientes':
            if (!isset($_REQUEST['insercion_documento'])) header('Location: ?action=listado_clientes');
            if($modelCliente->ExisteCliente($_REQUEST['insercion_documento'])){
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Cliente Existente', function(){ window.location='?action=listado_clientes'; });</script>";
            }else{//no existe cliente
                if($modelCliente->ExistePersona($_REQUEST['insercion_documento'])==false){//no existe persona
                    $almCliente->__SET('persona_id', $_REQUEST['insercion_documento']);
                    $almCliente->__SET('persona_nombres', $_REQUEST['insercion_nombres']);
                    $almCliente->__SET('direccion', $_REQUEST['insercion_direccion']);
                    $almCliente->__SET('telefono', $_REQUEST['insercion_telefono']);
                    $almCliente->__SET('correo', $_REQUEST['insercion_email']);
                    if($modelCliente->RegistrarPersona($almCliente)){//si registro a la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_clientes'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE INSERTARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=listado_clientes'; });</script>";
                        }
                    }else{
                        echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR LOS DATOS DE LA PERSONA Y EL CLIENTE', function(){ window.location='?action=listado_clientes'; });</script>";
                    }
                }else{//existe persona
                    $almCliente->__SET('persona_id', $_REQUEST['insercion_documento']);
                    $almCliente->__SET('persona_nombres', $_REQUEST['insercion_nombres']);
                    $almCliente->__SET('direccion', $_REQUEST['insercion_direccion']);
                    $almCliente->__SET('telefono', $_REQUEST['insercion_telefono']);
                    $almCliente->__SET('correo', $_REQUEST['insercion_email']);
                    if($modelCliente->ActualizarPersona($almCliente)){//si actualizo la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_clientes'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE ACTUALIZARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=listado_clientes'; });</script>";
                        }
                    }else{//si no actualizo la persona
                        if($modelCliente->RegistrarCliente($_REQUEST['insercion_documento'])){//si registro el cliente
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_clientes'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL CLIENTE', function(){ window.location='?action=listado_clientes'; });</script>";
                        }
                    }
                }
            }
            break;

        case 'listado_empleados':
            include('Empleado/index.php');
            break;

        case 'actualizar_empleados':
            if (!isset($_REQUEST['modal_codigo'])) header('Location: ?action=listado_empleados');
            $almEmpleado->__SET('persona_id', $_REQUEST['modal_documento']);
            $almEmpleado->__SET('persona_nombres', $_REQUEST['modal_nombres']);
            $almEmpleado->__SET('direccion', $_REQUEST['modal_direccion']);
            $almEmpleado->__SET('telefono', $_REQUEST['modal_telefono']);
            $almEmpleado->__SET('correo', $_REQUEST['modal_correo']);
            if($modelEmpleado->ActualizarPersona($almEmpleado)){//si actualizo la persona
                $almEmpleado->__SET('id', $_REQUEST['modal_codigo']);
                $almEmpleado->__SET('cargo', $_REQUEST['modal_cargo']);
                $almEmpleado->__SET('fingreso', $_REQUEST['modal_fingreso']);
                if($modelEmpleado->ActualizarEmpleado($almEmpleado)){//si actualizo al empleado
                    echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'SE ACTUALIZARON LOS DATOS DE LA PERSONA Y DEL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                }else{//SI NO SE ACTUALIZO EL EMPLEADO
                    echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'SE ACTUALIZARON LOS DATOS DE LA PERSONA PERO NO LOS DATOS DEL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                }
            }else{//si no actualizo la persona
                $almEmpleado->__SET('id', $_REQUEST['modal_codigo']);
                $almEmpleado->__SET('cargo', $_REQUEST['modal_cargo']);
                $almEmpleado->__SET('fingreso', $_REQUEST['modal_fingreso']);
                if($modelEmpleado->ActualizarEmpleado($almEmpleado)){//si actualizo al empleado
                    echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'NO SE ACTUALIZARON LOS DATOS DE LA PERSONA PERO SI LOS DEL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                }else{//SI NO SE ACTUALIZO EL EMPLEADO
                    echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ACTUALIZAR LOS DATOS DE LA PERSONA Y DEL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                }
            }
            break;

        case 'eliminar_empleados':
            if (!isset($_REQUEST['eliminar_id'])) header('Location: ?action=listado_empleados');
            if($modelEmpleado->Eliminar($_REQUEST['eliminar_id'])){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_empleados'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ELIMINAR EL REGISTRO', function(){ window.location='?action=listado_empleados'; });</script>";
            }
            break;

        case 'insertar_empleados':
            if (!isset($_REQUEST['insercion_documento'])) header('Location: ?action=listado_empleados');
            if($modelEmpleado->ExisteEmpleado($_REQUEST['insercion_documento'])){//existe el empleado
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'Cliente Existente', function(){ window.location='?action=listado_empleados'; });</script>";
            }else{//no existe Empleado
                if($modelEmpleado->ExistePersona($_REQUEST['insercion_documento'])){//existe persona
                    $almEmpleado->__SET('cargo', $_REQUEST['insercion_cargo']);
                    $almEmpleado->__SET('fingreso', $_REQUEST['insercion_fingreso']);
                    $almEmpleado->__SET('persona_id', $_REQUEST['insercion_documento']);
                    if($modelEmpleado->RegistrarEmpleado($almEmpleado)){//si registro el empleado
                        echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_empleados'; });</script>";
                    }else{
                        echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE INSERTARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                    }
                }else{//si no existe la persona
                    $almCliente->__SET('persona_id', $_REQUEST['insercion_documento']);
                    $almCliente->__SET('persona_nombres', $_REQUEST['insercion_nombres']);
                    $almCliente->__SET('direccion', $_REQUEST['insercion_direccion']);
                    $almCliente->__SET('telefono', $_REQUEST['insercion_telefono']);
                    $almCliente->__SET('correo', $_REQUEST['insercion_email']);
                    if($modelCliente->RegistrarPersona($almCliente)){//si registro a la persona
                        $almEmpleado->__SET('cargo', $_REQUEST['insercion_cargo']);
                        $almEmpleado->__SET('fingreso', $_REQUEST['insercion_fingreso']);
                        $almEmpleado->__SET('persona_id', $_REQUEST['insercion_documento']);
                        if($modelEmpleado->RegistrarEmpleado($almEmpleado)){//si registro el empleado
                            echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_empleados'; });</script>";
                        }else{
                            echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'SE INSERTARON LOS DATOS DE LA PERSONA\n PERO NO SE LOGRÓ INSERTAR EL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                        }
                    }else{//si no registro la persona
                        echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR LOS DATOS DE LA PERSONA Y EL EMPLEADO', function(){ window.location='?action=listado_empleados'; });</script>";
                    }
                }
            }
            break;

        case 'compras_listar':
            include('Compra/index.php');
            break;

        case 'compras_insertar':
            if (!isset($_REQUEST['insertar_fecha'])) header('Location: ?action=compras_listar');
            $almCompras->__SET('fecha', $_REQUEST['insertar_fecha']);
            $almCompras->__SET('productos_id', $_REQUEST['insertar_producto']);
            $almCompras->__SET('proveedores_id', $_REQUEST['insertar_proveedor']);
            $almCompras->__SET('precio', $_REQUEST['insertar_precio']);
            $almCompras->__SET('iva_id', $_REQUEST['insertar_iva']);
            $almCompras->__SET('cantidad', $_REQUEST['insertarcantidad']);
            if($modelCompras->Registrar($almCompras)){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=compras_listar'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ INSERTAR EL REGISTRO', function(){ window.location='?action=compras_listar'; });</script>";
            }
            break;

        case 'listado_fecturas_activas':
            include('Factura/index.php');
            break;

        case 'listado_fecturas_activas_por_fechas':
            include('Factura/filtrar/index.php');
            break;

        case 'anular_facturas_activas':
            if (!isset($_REQUEST['anular_factura_id'])) header('Location: ?action=listado_fecturas_activas');
            if($modelFactura->Anular($_REQUEST['anular_factura_id'])){
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'Acción Exitosa', function(){ window.location='?action=listado_fecturas_activas'; });</script>";
            }else{
                echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'NO SE LOGRÓ ANULAR EL REGISTRO', function(){ window.location='?action=listado_fecturas_activas'; });</script>";
            }
            break;

        case 'listado_detalle_facturas':
            include('Factura/detalle/index.php');
            break;

        case 'datos_basicos_preparar_factura'://se va para preparar factura
            if (!isset($_REQUEST['insercion_fecha'])) header('Location: ?action=listado_fecturas_activas');
            $almFactura->__SET('empleados_id', $_REQUEST['insercion_empleado_id']);
            $almFactura->__SET('clientes_id', $_REQUEST['insercion_cliente_id']);
            $almFactura->__SET('fecha', $_REQUEST['insercion_fecha']);
            if ($modelFactura->InsertarTemporal($almFactura)) {
                $idfactura = $modelFactura -> BuscarIdTemporal($almFactura);
                if(is_null($idfactura)){
                    /*SI ES NULO NO HAGAS NADA*/
                    echo"<script type=\"text/javascript\">alertify.alert('ERROR', 'INTENTE NUEVAMENTE, SI EL ERROR PERSISTE COMUNIQUE AL AREA ENCARGADA', function(){ window.location='?action=listado_fecturas_activas'; });</script>";
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
                echo"<script type=\"text/javascript\">alertify.alert('MENSAJE', 'VENTA REALIZADA', function(){ window.location='?action=listado_fecturas_activas'; });</script>";
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
    header('Location: ?action=dashboard');
    exit;
}           
?>