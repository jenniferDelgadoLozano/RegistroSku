<?php
include '../conexion/conexionbd.php';
include '../Body/encabezado.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Asignacion de Sku</title>
  <link rel="stylesheet" href="\css\style.css" type="text/css" MEDIA=screen>
  <link rel="stylesheet" href="\css\modal.css" type="text/css" MEDIA=screen>
  <link rel="stylesheet" href="..\Libreria\jquery.dataTables.min.css">
  <script src="..\Libreria\jquery-3.6.1.min.js"></script>
  <script src="..\Libreria\jquery.dataTables.min.js"></script>
  <script src="..\script\script.js"></script>
  <script>
  window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
        event.preventDefault();
    }
}, false);
</script>
</head>
<body>
  <form method="POST" id="formula">
    <div class="tb">
      <section class="form-register">
        <h4>ASIGNACIÓN DE SKU</h4></br>
        <div class="boton-modal"><label for="btn-modal">Consultar Color</label></div>
        <label>Codigo Color:</label><input class="controlsi" type="text" name="strCodColorform" id="strCodColorform" autocomplete="off"><br>
        <label>Codigo Color Factory:</label><input class="controlsi" type="text" name="strCodColorFactoryform" id="strCodColorFactoryform" autocomplete="off"><br>
        <label>Codigo Color Roque:</label><input class="controlsi" type="text" name="strCodColorRoqueform" id="strCodColorRoqueform" autocomplete="off"><br>
        <label>Nombre:</label><input class="controlsi" type="text" name="strNombreform" id="strNombreform" autocomplete="off"><br>
        <label>Estado:</label><input class="controlsi" type="text" name="intEstadoform" id="intEstadoform" autocomplete="off"><br>
        <label>Usuario:</label><input class="controlsi" type="text" name="intUsuarioform" id="intUsuarioform" autocomplete="off"><br>
        <label>Fecha De Grabación:</label><input class="controlsi" type="text" name="dtmGrabacionform" id="dtmGrabacionform" autocomplete="off"><br>
        <label>Marca:</label><input class="controlsi" type="text" name="marca" autocomplete="off"></br>
        <label>Referencia:</label><input class="controlsi" type="text" name="referencia" autocomplete="off"></br>
        <label>Descripción:</label><input class="controlsi" type="text" name="descripcion" autocomplete="off"></br>
        <label>Talla:</label><input class="controlsi" type="text" name="talla" autocomplete="off"></br>
        <button type="submit" name="sku" id="cargar" class="botons btn btn-success">Asignar Sku</button>
      </section>
    </div>
    <input type="checkbox" id="btn-modal">
    <div class="container-modal">
      <div class="scroll-div">
        <div class="scroll-bg">
          <div class="scroll-object">
            <div class="modal-dialog">
              <div class="content-modal">
                <div class="btn-cerrar"><label for="btn-modal">Cerrar</label></div><br>
                <h2>Busqueda de Color</h2><br><br>
                <input type="text" class="controls" id="strCodColor" name="strCodColor" autocomplete="off" placeholder="Codigo Color">
                <input type="text" class="controls" id="strCodColorFactory" name="strCodColorFactory" autocomplete="off" placeholder="Codigo Color Factory">
                <input type="text" class="controls" id="strCodColorRoque" name="strCodColorRoque" autocomplete="off" placeholder="Codigo Color Roque">
                <input type="text" class="controls" id="strNombre" name="strNombre" autocomplete="off" placeholder="Nombre">
                <input type="text" class="controls" id="intEstado" name="intEstado" autocomplete="off" placeholder="Estado">
                <input type="text" class="controls" id="intUsuario" name="intUsuario" autocomplete="off" placeholder="Usuario">
                <input type="text" class="controls" id="dtmGrabacion" name="dtmGrabacion" autocomplete="off" placeholder="Fecha de Grabación"></br></br>
                <input type="button"  onclick="btnBuscar(); return false;" value="Consultar"></br></br>
                <section class="form-tabla">
                  <div class="contenedor">
                    <table border="1 px" id="tabla2" table style="text-align:center" data-source="data-source">
                      <thead>
                        <th>Selección</th>
            						<th>Codigo Color</th>
            						<th>Codigo Color Factory</th>
            						<th>Codigo Color Roque</th>
            						<th>Nombre</th>
            						<th>Estado</th>
            						<th>Usuario</th>
                        <th>Fecha de Grabación</th>
                      </thead>
                      <tbody id="tbody_modal">
                      </tbody>
                    </table>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>
<!-- ///////////////////////////////Asignación de Sku/////////////////////////////////////////// -->
<?php
$fecha=date("Y-m-d");
$resultado = $conn->query("SELECT * FROM RegistroSku WHERE Asignar = 0")->fetchAll(PDO::FETCH_ASSOC);
$sku= ($resultado[0]['Sku']);
//////////////////////////////////////Concatenar/////////////////////////////////////// -->
if( isset($_POST["strCodColor"]) && isset($_POST["strCodColorFactory"]) && isset($_POST["strCodColorRoque"]) && isset($_POST["strNombre"]) && isset($_POST["intEstado"]) && isset($_POST["intUsuario"])
&& isset($_POST["marca"]) && isset($_POST["referencia"]) && isset($_POST["descripcion"]) && isset($_POST["talla"])) {
  $strCodColor= $_POST['strCodColorform'];
  $strCodColorFactory= $_POST['strCodColorFactoryform'];
  $strCodColorRoque= $_POST['strCodColorRoqueform'];
  $strNombre= $_POST['strNombreform'];
  $intEstado= $_POST['intEstadoform'];
  $intUsuario= $_POST['intUsuarioform'];
  $dtmGrabacion= $_POST['dtmGrabacionform'];
  $marca= $_POST['marca'];
  $referencia= $_POST['referencia'];
  $descripcion= $_POST['descripcion'];
  $talla= $_POST['talla'];

  $queryEns = "SELECT COUNT (*) AS Cuenta FROM dbo.RegistroSku WHERE Concatenar = '".$strCodColor.$strCodColorFactory.$strCodColorRoque.$strNombre.$intEstado.$intUsuario.$marca.$referencia.$descripcion.$talla."' ";
  $consulta = $conn->query($queryEns)->fetchAll(PDO::FETCH_ASSOC);

  echo '<script>
        console.log("'.$queryEns.'");
        </script>';

  echo '<script>
        console.log("'.$consulta[0]['Cuenta'].'");
        </script>';

        if ($consulta[0]['Cuenta'] > 0) {
          echo '<script> alert("Datos existentes")</script>';
          echo "<script>location.href=''</script>";
          exit;
        }
      }
//////////////////////////////////////Update/////////////////////////////////////// -->
if( isset($_POST["strCodColor"]) && isset($_POST["strCodColorFactory"]) && isset($_POST["strCodColorRoque"]) && isset($_POST["strNombre"]) && isset($_POST["intEstado"]) && isset($_POST["intUsuario"]) && isset($_POST["dtmGrabacion"])
&& isset($_POST["marca"]) && isset($_POST["referencia"]) && isset($_POST["descripcion"]) && isset($_POST["talla"])) {

$queryEnsUpd = "UPDATE RegistroSku SET
strCodColor = '".$strCodColor."',
strCodColorFactory = '".$strCodColorFactory."',
strCodColorRoque = '".$strCodColorRoque."',
strNombre = '".$strNombre."',
intEstado = '".$intEstado."',
intUsuario = '".$intUsuario."',
dtmGrabacion = '".$dtmGrabacion."',
marca = '".$marca."',
referencia = '".$referencia."',
descripcion = '".$descripcion."',
talla = '".$talla."',
asignar = 1,
Concatenar = '".$strCodColor.$strCodColorFactory.$strCodColorRoque.$strNombre.$intEstado.$intUsuario.$marca.$referencia.$descripcion.$talla."',
fecha = '".$fecha."'
WHERE sku = '".$sku."'";

echo '<script>
      console.log("'.$queryEnsUpd.'");
      </script>';

$conn->query ($queryEnsUpd);
  echo '<script>
  alert("¡Sku asignado con éxito!");
  </script>';
}
?>
