
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
<!-- <body onload="nobackbutton();"></body> -->
<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
<?php
session_start();
?>
<body>
	<nav>
		<ul class="menu">
			<ul>
				<li><a href="inicio_de_sesion.php" class="icono izquierda fas fa-home" aria-hidden="true"> Inicio</a>
					<li><a href="formulario.php" 	class="icono izquierda fa fa-edit"> Asignar Sku</a></li>
					<li><a href="buscar.php" class="icono izquierda fas fa-search"> Consultar</a></li>
					<li><a href="creaciondeusuarios.php" class="icono izquierda fas fa-users-cog"> Usuarios</a></li><!-- creaciondeusuarios se editar solo por Administrador poner .php -->
					<li><a href="cerrar_sesion.php" class="icono izquierda fa fa-sign-out"> Cerrar Sesión</a></li>
				</nav>
			</body>
		</meta>
		</html>
<!-- //////////////////////////////////////Variables//////////////////////////////////////////////// -->

<?php
include 'conexionbd.php';

if( isset($_POST["referencia"]) && isset($_POST["marca"])  && isset($_POST["color"]) && isset($_POST["talla"]) && isset($_POST["sku"]) && isset($_POST["fecha"]) ) {
	$referencia = $_POST["referencia"];
	$marca= $_POST['marca'];
	$color= $_POST['color'];
	$talla= $_POST['talla'];
	$sku= $_POST['sku'];
  $fecha= $_POST['fecha'];
};
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styletable.css" type="text/css">
  <title>Busqueda de Sku</title>
</head>
<script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
<script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
<script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<body>
  <section class="form-tabla">
    <form method='POST'>
      <h4>Búsqueda de Sku</h4>
      <h4>Ingrese los siguientes datos:</h4><br><br>
      <?php
      include 'conexionbd.php';
			if( isset($_POST["referencia"]) && isset($_POST["marca"])  && isset($_POST["color"]) && isset($_POST["talla"]) && isset($_POST["sku"]) && isset($_POST["fecha"]) ) {
      $data = $conn->query("SELECT * FROM RegistroSku WHERE Referencia LIKE '%$referencia%' and Marca LIKE '%$marca%' and Color LIKE '%$color%' and Talla LIKE '%$talla%' and Sku LIKE '%$sku%' and Fecha LIKE '%$fecha%' ")->fetchAll(PDO::FETCH_ASSOC);
      };
			?>
      <input type="text" class="controlsi" valor="referencia" name="referencia" autocomplete="off" placeholder="Referencia">
      <input type="text" class="controlsi" valor="marca" name="marca" autocomplete="off" placeholder="Marca">
      <input type="text" class="controlsi" valor="color" name="color" autocomplete="off" placeholder="Color">
      <input type="text" class="controlsi" valor="talla" name="talla" autocomplete="off" placeholder="Talla">
      <input type="text" class="controlsi" valor="sku" name="sku" autocomplete="off" placeholder="Sku"><br>
      <input type="date" class="controlsdate" valor="fecha" name="fecha" autocomplete="off" placeholder="aaaa-mm-dd">
      <br><br>
      <button type="submit" value="Buscar" name="enviar" id="buscar" class="botons btn btn-success">Consultar</button>
      <div class="contenedor">
        <table border="1 px" id="tabla" table style="text-align:center">
          <thead>
            <th>Item</th>
            <th>seleccionar</th>
            <th>Referencia</th>
            <th>Marca</th>
            <th>Color</th>
            <th>Talla</th>
            <th>Sku</th>
            <th>Cantidad</th>
          </thead>
          <tbody>
            <?php
						if( isset($_POST["referencia"]))
            foreach ($data as $key => $valor)
            { ?>


              <?php
              for ($x = 0; $x <= $key; $x++) {
                // echo " $x <br>";
              }
              ?>

                <tr>
                  <td><input class="controlitem" name="item" id="item" value="<?php echo " $x "; ?>" ></td>
                  <td><input type="checkbox" name="seleccionar<?php echo $key?>" id="seleccionar<?php echo $key?>"></td>
                  <td><input name="referencia<?php echo $key?>" id="referencia<?php echo $key?>" value="<?php echo $valor['Referencia']?>" hidden> <?php echo $valor['Referencia']?></td>
                  <td><input name="marca<?php echo $key?>" id="marca<?php echo $key?>" value="<?php echo $valor['Marca']?>" hidden> <?php echo $valor['Marca']?></td>
                  <td><input name="color<?php echo $key?>" id="color<?php echo $key?>" value="<?php echo $valor['Color']?>" hidden> <?php echo $valor['Color']?></td>
                  <td> <input name="talla<?php echo $key?>" id="talla<?php echo $key?>" value="<?php echo $valor['Talla']?>" hidden> <?php echo $valor['Talla']?></td>
                  <td><input name="sku<?php echo $key?>" id="sku<?php echo $key?>" value="<?php echo $valor['Sku']?>" hidden> <?php echo $valor['Sku']?></td>
                  <td><input name="cantidad<?php echo $key?>" id="cantidad<?php echo $key?>" autocomplete="off" class="controls" name="cantidad"></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <br>
        <div>
          <a id="btnExportar" class="botons btn btn-success">
            <i class="fas fas-file-excel" type="submit" name="exportar"></i>Exportar Información
          </a>
        </div>
        <script>
        function checkbox() {
          $(document).ready(function(){
            $('input[type="checkbox"]').change(function(){
              if($(this).is(':checked')){
                $('input[type="checkbox"]').not(this).prop('checked', false);
              }
            })
          })
        }
        const btnExportar = document.getElementById("btnExportar")

        btnExportar.addEventListener("click", function() {
          var filas = -1
          $("#tabla tr").each(function () {
            filas++;
          })

          data = []
          a = 0
          for (var i = 0; i < filas; i++) {
            if (document.getElementById("seleccionar"+i).checked) {

							for (var b = 0; b < $("#cantidad"+i).val(); b++) {
								data[a] = new Array ($("#referencia"+i).val(), $("#marca"+i).val(), $("#color"+i).val(), $("#talla"+i).val(), $("#sku"+i).val())
								a++
							}
            }
          }
          console.log("data");
          $.ajax({
            type: 'POST',
            url:'tabla.php',
            data:{"data" : data},
            success: function(respuesta) {
              response = JSON.parse(respuesta)

              var $a = $("<a>");
              $a.attr("href",response["file"]);
              $("body").append($a);
              $a.attr("download","Codigos_Seleccionados.xlsx");
              $a[0].click();
              $a.remove();
            },
            error: function() {
              console.log("no fue exportar la información");
            }
          });
        })
      </script>
    </body>
  </section>
  </html>
