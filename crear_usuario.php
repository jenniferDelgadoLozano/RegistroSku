<script type="text/javascript">
window.history.forward();
function sinVueltaAtras(){ window.history.forward(); }
</script>

<?php
include '../conexion/conexionbd.php';
include '../Body/encabezado.php';
?>
<!-- //////////////////////////////////////Variables//////////////////////////////////////////////// -->
<?php
include '../conexion/conexionbd.php';

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
  <link rel="stylesheet" href="..\css\stylesesion.css" type="text/css" MEDIA=screen>
  <body>
  <form class="form-register" method="post" action="" name="signin-form" >
    <h4>Creación De Usuarios</h4>
    <br><br><br>
    <div class="form-element"><label>Primer Apellido:</label><input class="controls" type="text" name="primerapellido" autocomplete="off"/></div>
    <div class="form-element"><label>Segundo Apellido:</label><input class="controls" type="text" name="segundoapellido" autocomplete="off"/></div>
    <div class="form-element"><label>Primer Nombre:</label><input class="controls" type="text" name="primernombre" pattern="[a-zA-Z0-9]+" autocomplete="off"/></div>
    <div class="form-element"><label>Segundo Nombre:</label><input class="controls" type="text" name="segundonombre" pattern="[a-zA-Z0-9]+" autocomplete="off"/></div>
    <div class="form-element"><label>Cedula:</label><input class="controls" type="text" name="cedula" required autocomplete="off"/></div>
    <div class="form-element"><label>Correo:</label><input class="controls" type="text" name="correo" required autocomplete="off"/></div>
    <div class="form-element"><label>Contraseña:</label><input class="controls" type="password" name="contraseña" required autocomplete="off"/></div>
		<div class="form-element"><label>Rol:</label><select class="opcion" name="rol" id="rol">
				<option value="Administrador">Administrador</option>
				<option value="Colaborador">Colaborador</option>
			</select>
		</div>
    <br><button type="submit" name="registro" value="login">Registrar</button>
  </form>

  <?php
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
  exit();
?>
