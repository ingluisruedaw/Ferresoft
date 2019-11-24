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
    die ("<script type=\"text/javascript\">alert('Usuario O Clave Errados'); window.location='../../administracion';</script>");
}elseif($r->estado_id==1){
    if (password_verify($password, $r->clave)) { 
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $r->usuario;
        $_SESSION['rol']=$r->roles_id;
        require('../../modelo/Login/redirigir.php');        
    } else { 
        die ("<script type=\"text/javascript\">alert('Usuario O Clave Errados'); window.location='../../administracion';</script>");
    }
}else{
    die ("<script type=\"text/javascript\">alert('Error. Existe Problemas con su usuario,contacte al webmaster.');  window.location='../../administracion';</script>");
}
 ?>