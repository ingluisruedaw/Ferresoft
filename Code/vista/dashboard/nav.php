<div class="navbar-header">
    <a class="navbar-brand" href="index.php">Administracion</a>
</div>

<ul class="nav navbar-right navbar-top-links">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['username'];?> <b class="caret"></b>
        </a>
        
        <ul class="dropdown-menu dropdown-user">
            <li>
                <a href="" data-toggle="modal" data-target="#ModalActualizarClave" type="submit" ><i class="fa fa-user fa-fw"></i> Cambiar Clave</a>
            </li>
            
            <li class="divider"></li>
            <li>
                <a href="../../modelo/Login/logout.php"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
            </li>
        </ul>
    </li>
</ul>
<?php require('cambiar_clave.php');?>