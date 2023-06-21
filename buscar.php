<?php
include '../conexion/conexionbd.php';
include '../Body/encabezado.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="\css\styletable.css" type="text/css">
  <link rel="stylesheet" href="..\Libreria\jquery.dataTables.min.css">
  <script src="..\Libreria\jquery-3.6.1.min.js"></script>
  <script src="..\Libreria\jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="..\script\script.js"></script>
  <title>Busqueda de Sku</title>
</head>
<body>
  <section class="form-tabla">
    <form method='POST'>
      <h4>Búsqueda de Sku</h4>
      <h4>Ingrese los siguientes datos:</h4><br><br>
      <?php
      if( isset($_POST["marca"]) && isset($_POST["referencia"]) && isset($_POST["descripcion"]) && isset($_POST["talla"]) && isset($_POST["sku"]) && isset($_POST["strCodColor"]) && isset($_POST["strCodColorFactory"])
			&& isset($_POST["strCodColorRoque"]) && isset($_POST["strNombre"]) && isset($_POST["intEstado"]) && isset($_POST["intUsuario"]) && isset($_POST["fecha"]) ) {
        $marca= $_POST['marca'];
				$referencia = $_POST['referencia'];
				$descripcion= $_POST['descripcion'];
				$talla= $_POST['talla'];
				$sku= $_POST['sku'];
				$strCodColor= $_POST['strCodColor'];
				$strCodColorFactory= $_POST['strCodColorFactory'];
				$strCodColorRoque= $_POST['strCodColorRoque'];
				$strNombre= $_POST['strNombre'];
				$intEstado= $_POST['intEstado'];
				$intUsuario= $_POST['intUsuario'];
				$fecha= $_POST['fecha'];

				$data = $conn->query("SELECT * FROM RegistroSku WHERE Marca LIKE '%$marca%' and Referencia LIKE '%$referencia%' and Descripcion LIKE '%$descripcion%' and Talla LIKE '%$talla%' and Sku LIKE '%$sku%' and
				strCodColor LIKE '%$strCodColor%' and strCodColorFactory LIKE '%$strCodColorFactory%' and strCodColorRoque LIKE '%$strCodColorRoque%' and strNombre LIKE '%$strNombre%' AND intEstado LIKE '%$intEstado%'
				and intUsuario LIKE '%$intUsuario%' and Fecha LIKE '%$fecha%'")->fetchAll(PDO::FETCH_ASSOC);

        $total =  count($data);
      };
      ?>
      <input type="text" class="controlsi" name="marca" autocomplete="off" placeholder="Marca">
      <input type="text" class="controlsi" name="referencia" autocomplete="off" placeholder="Referencia">
			<input type="text" class="controlsi" name="descripcion" autocomplete="off" placeholder="Descripción">
			<input type="text" class="controlsi" name="talla" autocomplete="off" placeholder="Talla">
			<input type="text" class="controlsi" name="sku" autocomplete="off" placeholder="Sku">
			<input type="text" class="controlsi" name="strCodColor" autocomplete="off" placeholder="Cod Color">
			<input type="text" class="controlsi" name="strCodColorFactory" autocomplete="off" placeholder="Cod Color Factory">
			<input type="text" class="controlsi" name="strCodColorRoque" autocomplete="off" placeholder="Cod Color Roque">
			<input type="text" class="controlsi" name="strNombre" autocomplete="off" placeholder="Nombre">
			<input type="text" class="controlsi" name="intEstado" autocomplete="off" placeholder="Estado">
			<input type="text" class="controlsi" name="intUsuario" autocomplete="off" placeholder="Usuario"><br>
			<input type="date" class="controlsdate" valor="fecha" name="fecha" autocomplete="off"><br><br>
      <button type="submit" value="Buscar" name="enviar" id="buscar" class="botons btn btn-success">Consultar</button>
      <div class="contenedor">
        <?php
          if( isset($_POST["referencia"])) {
        ?>
            <input type="text" id="totales" value="<?php echo $total?>" hidden>
        <?php
          }
        ?>
        <table border="1 px" class="display" id="tabla" table style="text-align:center" data-source="data-source">
          <thead>
            <th>Item</th>
            <th>Cantidad</th>
						<th>Marca</th>
            <th>Referencia</th>
						<th>Descripción</th>
            <th>Talla</th>
            <th>Sku</th>
						<th>Codigo Color</th>
						<th>Codigo Color Factory</th>
						<th>Codigo Color Roque</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Usuario</th>
						<th>Fecha</th>
            <th>Selección</th>
					</thead>
          <tbody>
            <?php
            if( isset($_POST["referencia"]))
            foreach ($data as $key => $valor)
            { ?>
              <tr>
                <td><input class="controlitem" name="item<?php echo $key?>" id="item<?php echo $key?>" value="<?php echo $key?>" ></td>
                <td><input name="cantidad<?php echo $key?>" id="cantidad<?php echo $key?>" autocomplete="off" class="controls" name="cantidad"></td>
								<td><input name="marca<?php echo $key?>" id="marca<?php echo $key?>" value="<?php echo $valor['Marca']?>" hidden> <?php echo $valor['Marca']?></td>
                <td><input name="referencia<?php echo $key?>" id="referencia<?php echo $key?>" value="<?php echo $valor['Referencia']?>" hidden> <?php echo $valor['Referencia']?></td>
								<td><input name="descripcion<?php echo $key?>" id="descripcion<?php echo $key?>" value="<?php echo $valor['Descripcion']?>" hidden> <?php echo $valor['Descripcion']?></td>
								<td><input name="talla<?php echo $key?>" id="talla<?php echo $key?>" value="<?php echo $valor['Talla']?>" hidden> <?php echo $valor['Talla']?></td>
                <td><input name="sku<?php echo $key?>" id="sku<?php echo $key?>" value="<?php echo $valor['Sku']?>" hidden> <?php echo $valor['Sku']?></td>
								<td><input name="strCodColor<?php echo  $key?>" id="strCodColor<?php echo $key?>" value="<?php echo $valor['strCodColor']?>" hidden> <?php echo $valor['strCodColor']?></td>
								<td><input name="strCodColorFactory<?php echo  $key?>" id="strCodColorFactory<?php echo $key?>" value="<?php echo $valor['strCodColorFactory']?>" hidden> <?php echo $valor['strCodColorFactory']?></td>
								<td><input name="strCodColorRoque<?php echo  $key?>" id="strCodColorRoque<?php echo $key?>" value="<?php echo $valor['strCodColorRoque']?>" hidden> <?php echo $valor['strCodColorRoque']?></td>
								<td><input name="strNombre<?php echo  $key?>" id="strNombre<?php echo $key?>" value="<?php echo $valor['strNombre']?>" hidden> <?php echo $valor['strNombre']?></td>
								<td><input name="intEstado<?php echo  $key?>" id="intEstado<?php echo $key?>" value="<?php echo $valor['intEstado']?>" hidden> <?php echo $valor['intEstado']?></td>
								<td><input name="intUsuario<?php echo  $key?>" id="intUsuario<?php echo $key?>" value="<?php echo $valor['intUsuario']?>" hidden> <?php echo $valor['intUsuario']?></td>
								<td><input name="fecha<?php echo  $key?>" id="fecha<?php echo $key?>" value="<?php echo $valor['Fecha']?>" hidden> <?php echo $valor['Fecha']?></td>
                <td><input type="checkbox" onclick="checkear('<?php echo $key?>');" name="seleccionar<?php echo $key?>" id="seleccionar<?php echo $key?>" value="0" ></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
        </div><br>
      <div><a id="btnExportar" class="botons btn btn-success" onclick="btnExportar()"><i class="fas fas-file-excel" type="submit" name="exportar"></i>Exportar Información</a></div>
    </form>
  </section>
</body>
</html>
