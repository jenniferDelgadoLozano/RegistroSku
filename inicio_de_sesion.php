
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
  <link rel="stylesheet" href="inicio_de_sesion.css" type="text/css" MEDIA=screen>
  <script src="script.js"></script>
</head>
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
<?php
session_start();
?>
  <form class="form-register" method="post" action="" name="signin-form" >
    <h4>Bienvenido</h4><h2>Iniciar Sesión</h2><br>
    <div class="form-element"><label>Usuario:</label><input class="controls" type="text" name="usuario" pattern="[a-zA-Z0-9]+"autocomplete="off"/></div>
    <div class="form-element"><label>Contraseña:</label><input class="controls" type="password" name="contraseña" autocomplete="off" 	class="icono izquierda vpn_key"/></div>
    <button type="submit" name="btningresar" value="login">Ingresar</button>
  </form>

<?php
include 'conexionbd.php';
if (!empty($_POST["btningresar"])) {
  if (empty($_POST["usuario"]) and empty($_POST["contraseña"]) ) {
    echo '<div class="alert alert-danger">Los Campos Estan Vacios</div>';
  } else {
  $usuario=$_POST["usuario"];
  $contraseña=$_POST["contraseña"];
  $result = $conn->query("SELECT * FROM usuarios WHERE usuario = '$usuario' and contraseña = '$contraseña'")->fetchAll(PDO::FETCH_ASSOC);
  if ($result) {
    header("location:formulario.php");
  } else {
    echo '<div> <p>Acceso Denegado <span class="glyphicon glyphicon-alert"> </br> verifique el usuario y la contraseña </span></p></div>';
  }
}
}
 ?>
