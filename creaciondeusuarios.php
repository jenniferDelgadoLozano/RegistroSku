<script type="text/javascript">
window.history.forward();
function sinVueltaAtras(){ window.history.forward(); }
</script>

<?php
include("../conexion/conexionbd.php");

if( isset($_POST["usuario"]) && isset($_POST["contraseña"])  && isset($_POST["rol"]) ) {
  $usuario=$_POST["usuario"];
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
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="\css\autenticacion.css" type="text/css" MEDIA=screen>
</head>
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">

<?php
session_start();
?>

<form class="form-register" method="post" action="" name="signin-form" >
  <h4>Autenticación</h4>
  <div class="form-element"><label>Usuario:</label><input class="controls" type="text" name="usuario" pattern="[a-zA-Z0-9]+"autocomplete="off"/></div>
  <div class="form-element"><label>Contraseña:</label><input class="controls" type="password" name="contraseña" autocomplete="off" 	class="icono izquierda vpn_key"/></div>
  <form action="#"><select name="rol" id="rol"><option value="javascript">Administrador</option></select><br>
    <button type="submit" name="btningresar" value="login">Ingresar</button><br>
    <a href="\formularios\formulario.php" class="icono izquierda 	fa fa-backward"> Volver</a>
    <a href="\Body\cerrar_sesion.php" class="icono izquierda fa fa-sign-out"> Salir</a>
  </form>

<?php
if (!empty($_POST["btningresar"])) {
  if (empty($_POST["usuario"]) and empty($_POST["contraseña"]) and empty($_POST["rol"]) ) {
    echo '<div class="alert alert-danger">Los Campos Estan Vacios</div>';
  }else {

    $usuario=$_POST["usuario"];
    $contraseña=$_POST["contraseña"];
    $rol=$_POST["rol"];
    $result = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña = '$contraseña' and rol = 'administrador' ")->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      header("location:crear_usuario.php");
    }else {
      echo '<div> <p>Acceso Denegado <span class="glyphicon glyphicon-alert"></span></p></div>';
    }
  }
}
 ?>
