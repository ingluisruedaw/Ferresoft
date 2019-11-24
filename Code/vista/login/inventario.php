<!DOCTYPE html>
<html>
<head>
	<title>PROYECTO PIA</title>
	<link rel="stylesheet" href="../../estilos/login/login.css">
	<link rel="stylesheet" href="../../estilos/login/inventario.css">
<link rel="stylesheet" href="../../estilos/login/login.js">
</head>
<body>
	<div class="login-page"><!--class="login-page"-->
	  <div class="form" style="background-color: rgba(255, 255, 255, 0.3);">
	    <h3 >AUTENTICACIÓN INVENTARIO</h3>
	  	<img src="../../images/login/login.png">  
	    <p><b>DEBES DIGITAR TU USUARIO Y CONTRASEÑA PARA AUTENTICARTE EN EL SISTEMA CON TU ROL</b></p>
	    <form class="login-form" action="../../controlador/login/inventario.php" method="post">
	      <input type="text" style="border: 3px solid #555;" name="username" placeholder="Usuario" required/>
	      <input type="password" style="border: 3px solid #555;" name="password" placeholder="Contraseña" required/>
	      <button type="submit" style="background-color: #04662c;">Ingresar</button>
	      <p class="message">No Quieres Ingresar? <a href="../home/index.php" style="color: red;"><b>Regresar</b></a></p>
	    </form>
	  </div>
	</div>
</body>
</html>