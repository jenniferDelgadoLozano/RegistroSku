<script type="text/javascript">
window.history.forward();
function sinVueltaAtras(){ window.history.forward(); }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="..\Libreria\maxcdn.bootstrapcdn.com_bootstrap_3.3.7_css_bootstrap.min.css">
  <link rel="stylesheet" href="..\Libreria\cdnjs.cloudflare.com_ajax_libs_font-awesome_4.7.0_css_font-awesome.min.css"> -->
  <link rel="stylesheet" href="\css\inicio_de_sesion.css" type="text/css" MEDIA=screen>
</head>
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">

<?php
session_start();
?>

<form class="form-register" method="post" action="" name="signin-form" >
  <h4>Bienvenido</h4><h2>Iniciar Sesión</h2><br>
  <div class="form-element"><label>Usuario:</label><input class="controls" type="text" name="usuario" pattern="[a-zA-Z0-9]+" autocomplete="off"/></div>
  <div class="form-element"><label>Contraseña:</label><input class="controls" type="password" name="contraseña" autocomplete="off" 	class="icono izquierda vpn_key"/></div>
  <button type="submit" name="btningresar" value="login">Ingresar</button>
</form>

<?php

include '../conexion/conexionbd.php';
if (!empty($_POST["btningresar"])) {
  if (empty($_POST["usuario"]) and empty($_POST["contraseña"]) ) {
    echo '<div class="alert alert-danger">Los Campos Estan Vacios</div>';
  }else {
    $usuario=$_POST["usuario"];
    $contraseña=$_POST["contraseña"];
    $result = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña = '$contraseña'")->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
      header('Location: http://192.168.2.183/Formularios/formulario.php');
    }else {
      echo '<div> <p> <i class="fa fa-warning" style="font-size:24px"></i> ACCESO DENEGADO <span</br></br>verifique el usuario y la contraseña</span></p></div>';
    }
  }
}
 ?>
