<?php 
if (!isset($_SESSION)) session_start();
if ($_SESSION['rol'] == 1) {//SUPERUSUARIO
        header('Location: ../../vista/dashboard/index.php');
    }elseif ($_SESSION['rol'] == 2) {//FACTURACION
        header('Location: ../../vista/facturacion/index.php');
    }elseif ($_SESSION['rol'] == 3) {//INVENTARIO
        header('Location: ../../vista/inventario/index.php');
    }else{
        session_unset();
		session_destroy();
		header('Location: ../../vista/home');
    }
?>