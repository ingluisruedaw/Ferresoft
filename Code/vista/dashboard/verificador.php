<?php 
  if (!isset($_SESSION)) session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SESSION['rol']==1) {
    }else{
      header('Location: ?action=redirigir');
    }
  }else {
    header('Location: ?action=logout');
    exit;
  }
?>