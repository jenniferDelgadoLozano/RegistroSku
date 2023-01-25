
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
	<script src="script.js"></script>
</head>
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
<body>
	<nav>
		<ul class="menu">
			<ul>
				<li><a href="inicio_de_sesion.php" class="icono izquierda fas fa-home" aria-hidden="true"> Inicio</a>
					<li><a href="formulario.php" 	class="icono izquierda fa fa-edit"> Asignar Sku</a></li>
					<li><a href="buscar.php" class="icono izquierda fas fa-search"> Consultar</a></li>
					<li><a href="creaciondeusuarios.php" class="icono izquierda fas fa-users-cog"> Usuarios</a></li><!-- creaciondeusuarios se editar solo por Administrador poner .php -->
					<li><a href="cerrar_sesion.php" class="icono izquierda fa fa-sign-out" name="cerrar"> Cerrar Sesión</a></li>
				</nav>
			</body>
		</meta>
		</html>
<!-- //////////////////////////////////////Variables//////////////////////////////////////////////// -->

<?php

include 'conexionbd.php';

if( isset($_POST["referencia"]) && isset($_POST["marca"])  && isset($_POST["color"]) && isset($_POST["talla"]) ) {
$referencia = $_POST["referencia"];
$marca= $_POST['marca'];
$color= $_POST['color'];
$talla= $_POST['talla'];
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css" type="text/css" MEDIA=screen>
  <title>Asignacion de Sku</title>
</head>
<body>
  <section class="form-register">
    <h4>ASIGNACIÓN DE SKU</h4>
    </br>
    <form action="formulario.php" method="POST">
      <label>Referencia:</label>
      <input class="controls" type="text" name="referencia" autocomplete="off" required value="">
      </br></br>
      <label>Marca:</label>
      <input class="controls" type="text" name="marca" autocomplete="off" required value="">
      </br></br>
      <label>Color:</label>
      <input class="controls" type="number" name="color" autocomplete="off" required value="">
      </br></br>
      <label>Talla:</label>
      <input class="controls" type="number" name="talla" autocomplete="off" required value="">
      </br></br></br>
      <!-- <a type="submit" class="botons btn btn-success" onclick="cargar(this)" id="cargar">Generar Sku</a> -->
      <button type="submit" name="sku" id="cargar" class="botons btn btn-success">Asignar Sku</button>
    </br>
    </br>
      <div id=""></div>
      <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
      <script src="script.js"></script>
          <table border="0.5px" style="border-collapse:collapse" align="center";>
            <tr>
              <td>
                <div id="imagen"></div>
                <td align="right" bgcolor="#66CCFF" nowrap="nowrap"><b></b></td>
                <?php
                include 'conexionbd.php';
                $data = $conn->query("SELECT Sku FROM dbo.RegistroSku WHERE CAST (Fecha AS date) = CAST (GETDATE()AS date)")->fetchAll(PDO::FETCH_ASSOC);

                foreach ($data as $valor) {
                    // echo $valor ['Sku'], "<br>";
                }
                ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <script>
                $("#barcode").click(function() {
                  var data = $("#ean").val();
                  $("#imagen").html('<img src="barcode\\barcode.php?filepath:"C:\codigosGenerados"&text='+data+'&size=20&codetype=Code39&print=true"/>');
                });
              </script>
            </td>
          </tr></table>
        </form>
      </section>
      </body>
      </html>
    </form>
  </section>
</body>
</html>

<!-- ///////////////////////////////Asignación de Sku/////////////////////////////////////////// -->

<?php
include 'conexionbd.php';
$fecha=date("Y-m-d");
$resultado = $conn->query("SELECT * FROM RegistroSku WHERE Asignar = 0")->fetchAll(PDO::FETCH_ASSOC);
$sku= ($resultado[0]['Sku']);
?>

<!-- ////////////////////////////////////////Concatenar/////////////////////////////////////// -->
<?php

if( isset($_POST["referencia"])
&& isset($_POST["marca"])
&& isset($_POST["color"])
&& isset($_POST["talla"]) )
{
$queryEns = "SELECT COUNT (*) AS Cuenta FROM dbo.RegistroSku WHERE Concatenar = '".$referencia.$marca.$color.$talla."' ";
$consulta = $conn->query($queryEns)->fetchAll(PDO::FETCH_ASSOC);
echo '<script>
      console.log("'.$queryEns.'");
      </script>';

echo '<script>
      console.log("'.$consulta[0]['Cuenta'].'");
      </script>';
//
if ($consulta[0]['Cuenta'] > 0) {
  echo '<script> alert("Datos existentes")</script>';
  echo "<script>location.href=''</script>";
        exit;
}

};
////////////////////////////////////////Update///////////////////////////////////////////////
if( isset($_POST["referencia"])
&& isset($_POST["marca"])
&& isset($_POST["color"])
&& isset($_POST["talla"]) )
{

$queryEnsUpd = "UPDATE RegistroSku SET referencia = '".$referencia."', marca = '".$marca."', color = '".$color."', talla = '".$talla."', asignar = 1, fecha = '".$fecha."', Concatenar = '".$referencia.$marca.$color.$talla."' WHERE sku = '".$sku."' ";

echo '<script>
      console.log("'.$queryEnsUpd.'");
      </script>';

$conn->query ($queryEnsUpd);
  echo '<script>
  alert("¡Sku asignado con éxito!");
  </script>';
};
?>
