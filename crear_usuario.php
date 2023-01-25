
<script type="text/javascript">
    window.history.forward();
    function sinVueltaAtras(){ window.history.forward(); }
</script>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Menu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="estilos.css"/>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
<body>
	<nav>
		<ul class="menu">
			<ul>
				<li><a href="inicio_de_sesion.php" class="icono izquierda fas fa-home" aria-hidden="true"> Inicio</a>
					<li><a href="formulario.php" 	class="icono izquierda fa fa-edit"> Asignar Sku</a></li>
					<li><a href="buscar.php" class="icono izquierda fas fa-search"> Consultar</a></li>
					<li><a href="creaciondeusuarios.php" class="icono izquierda fas fa-users-cog"> Usuarios</a></li><!-- contraseña para administrador -->
					<li><a href="cerrar_sesion.php" class="icono izquierda fa fa-sign-out"> Cerrar Sesión</a></li>
				</nav>
			</body>
		</meta>
		</html>
<!-- //////////////////////////////////////Variables//////////////////////////////////////////////// -->

<?php
include 'conexionbd.php';

if( isset($_POST["primernombre"]) && isset($_POST["segundonombre"])  && isset($_POST["primerapellido"]) && isset($_POST["segundoapellido"]) && isset($_POST["cedula"]) && isset($_POST["correo"]) && isset($_POST["contraseña"]) && isset($_POST["rol"]) ) {
  $primerapellido=$_POST["primerapellido"];
  $segundoapellido=$_POST["segundoapellido"];
  $primernombre=$_POST["primernombre"];
  $segundonombre=$_POST["segundonombre"];
  $cedula=$_POST["cedula"];
  $correo=$_POST["correo"];
  $contraseña=$_POST["contraseña"];
  $rol=$_POST["rol"];
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="stylesesion.css" type="text/css" MEDIA=screen>
  <body>
  <form class="form-register" method="post" action="" name="signin-form" >
    <h4>Creación De Usuarios</h4>
    <br>
    <div class="form-element"><label>Primer Apellido:</label><input class="controls" type="text" name="primerapellido" autocomplete="off"/></div>
    <div class="form-element"><label>Segundo Apellido:</label><input class="controls" type="text" name="segundoapellido" autocomplete="off"/></div>
    <div class="form-element"><label>Primer Nombre:</label><input class="controls" type="text" name="primernombre" pattern="[a-zA-Z0-9]+" autocomplete="off"/></div>
    <div class="form-element"><label>Segundo Nombre:</label><input class="controls" type="text" name="segundonombre" pattern="[a-zA-Z0-9]+" autocomplete="off"/></div>
    <div class="form-element"><label>Cedula:</label><input class="controls" type="text" name="cedula" required autocomplete="off"/></div>
    <div class="form-element"><label>Correo:</label><input class="controls" type="text" name="correo" required autocomplete="off"/></div>
    <div class="form-element"><label>Contraseña:</label><input class="controls" type="password" name="contraseña" required autocomplete="off"/></div>
		<div class="form-element"><label>Rol:</label><input class="controls" type="text" name="rol" required autocomplete="off"/></div>
    <br><button type="submit" name="registro" value="login">Registrar</button>
  </form>

  <?php
  include 'conexionbd.php';

  if( isset($_POST["primernombre"])
  && isset($_POST["primerapellido"]) )
  {
    $result = "SELECT COUNT (*) AS conca FROM dbo.usuarios WHERE usuario = '".$primernombre.$primerapellido."' ";
    $consulta = $conn->query($result)->fetchAll(PDO::FETCH_ASSOC);
    echo '<script>
    console.log("'.$result.'");
    </script>';

    echo '<script>
    console.log("'.$consulta[0]['conca'].'");
    </script>';

    if ($consulta[0]['conca'] > 0) {
      echo '<script> alert("Datos existentes")</script>';
      echo "<script>location.href=''</script>";
      exit;
    }
  };
  ?>

  <?php
  include 'conexionbd.php';

  if (!empty($_POST["registro"])) {
    if (empty($_POST["primernombre"]) or empty($_POST["primerapellido"]) or empty($_POST["cedula"]) or empty($_POST["correo"]) or empty($_POST["contraseña"])) {
      // echo 'uno de los campos esta vacio'; //no hay necesidad porque es obligatorio
    } else {
      $primerapellido=$_POST["primerapellido"];
      $segundoapellido=$_POST["segundoapellido"];
      $primernombre=$_POST["primernombre"];
      $segundonombre=$_POST["segundonombre"];
      $cedula=$_POST["cedula"];
      $correo=$_POST["correo"];
      $contraseña=$_POST["contraseña"];
			$rol=$_POST["rol"];
      $result = $conn->query(" INSERT INTO usuarios(primerapellido,segundoapellido,primernombre,segundonombre,cedula,correo,contraseña,rol,usuario)VALUES('$primerapellido','$segundoapellido','$primernombre','$segundonombre','$cedula','$correo','$contraseña','$rol','".$primernombre.$primerapellido."')");
      if ($result) {
        echo '<script> alert("¡Usuario Registrado Correctamente!"); </script>';
      }
      else {
        echo '<div class="alerta">Error Usuario No Registrado</div>';
      }
    }
  }
?>
