<?php
session_start();
require_once ('../../modelo/conexion.php');
$conexion = new conexion();
$username = $_POST['username'];
$password = $_POST['password']; 
$result = $conexion->prepare("SELECT usuario, clave, roles_id, estado_id FROM usuario WHERE usuario = ? ");
$result->execute(array($username));
$r = $result->fetch(PDO::FETCH_OBJ);

if (empty($r)) {
    die ("<script type=\"text/javascript\">alert('USUARIO O CLAVE ERRADOS'); window.location='../../inventario';</script>");
}elseif($r->estado_id==1){
	if ($r->roles_id==3) {
		if (password_verify($password, $r->clave)) { 
	        $_SESSION['loggedin'] = true;
	        $_SESSION['username'] = $r->usuario;
	        $_SESSION['rol']=$r->roles_id;
	        require('../../modelo/Login/redirigir.php');        
	    } else { 
	        die ("<script type=\"text/javascript\">alert('USUARIO O CLAVE ERRADOS'); window.location='../../inventario';</script>");
	    }
	}else{
		die ("<script type=\"text/javascript\">alert('ERROR. ESTA AUTENTICACIÓN SOLO PUEDE SER USADA POR USUARIOS DONDE SU ROL SEA INVENTARIO.');  window.location='../../inventario';</script>");
	}
}else{
    die ("<script type=\"text/javascript\">alert('ERROR. EXISTE PROBLEMAS CON SU USUARIO, CONTACTE AL WEBMASTER.');  window.location='../../inventario';</script>");
}
 ?>