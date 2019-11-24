<?php 
  if (!isset($_SESSION)) session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SESSION['rol']==3) {
    }else{
      require('../../modelo/Login/redirigir.php');
    }
  }else {
    header('Location: ../../vista/home/index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<?php require('head.php');?>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php require('nav.php');?>
    <?php require('aside.php');?>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper" style="font-family: 'Roboto', 'Helvetica', sans-serif;
  background: url('../../images/administracion/index.jpg') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;background-size: cover;">
    </div>
    <?php require('footer.php');?>

</div>

<?php require('scripts.php');?>

</body>
</html>
