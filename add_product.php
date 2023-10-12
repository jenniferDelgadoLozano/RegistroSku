<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin ¿Qué nivel de usuario tiene permiso para ver esta página?
  // page_require_level(2);
  $all_categories = find_all('categories');
  $all_ubicaciones = find_all('ubicaciones');
  $all_photo = find_all('media');
  $all_estado = find_all('estados');
?>
<?php

if(isset($_POST['add_product'])){
  $req_fields = array('product-codigo','product-factura','product-title','product-categorie','product-quantity','product-modelo','product-serie','product-ubicacion','product-estados' );
  validate_fields($req_fields);
  if(empty($errors)){
    $p_codigo  = remove_junk($db->escape($_POST['product-codigo']));
    $p_fac     = remove_junk($db->escape($_POST['product-factura']));
    $p_name    = remove_junk($db->escape($_POST['product-title']));
    $p_cat     = remove_junk($db->escape($_POST['product-categorie']));
    $p_qty     = remove_junk($db->escape($_POST['product-quantity']));
    $p_mod     = remove_junk($db->escape($_POST['product-modelo']));
    $p_ser     = remove_junk($db->escape($_POST['product-serie']));
    $p_ubi     = remove_junk($db->escape($_POST['product-ubicacion']));
    $p_estados = remove_junk($db->escape($_POST['product-estados']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
    $media_id = '0';
  } else {
    $media_id = remove_junk($db->escape($_POST['product-photo']));
  }

    $query  = "SELECT COUNT(*) AS Cuenta FROM products WHERE name = '$p_name'";
    $result = find_by_sql($query);
    $total= ($result[0]['Cuenta']);

    if($total > 0){
      $session->msg('d',"Producto existente, Consulte el ID ");
      redirect('add_product.php', false);
    }

    $var = "ENT";
    $date    = make_date();
    $query  = "INSERT INTO kardex (codigo,date,name,movimiento,entrada,salida,stock,estados) VALUES ('{$p_codigo}', '{$date}', '{$p_name}', '$var  $p_fac', '{$p_qty}', '-', '{$p_qty}','{$p_estados}')";

    if($db->query($query)){
      $session->msg('s',"Producto agregado exitosamente. ");      
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('product.php', false);
    }

    $query  = "INSERT INTO products (";
    $query .=" codigo,factura,name,quantity,categorie_id,modelo,serie,ubicacion_id,estados,media_id,date,entrada,movimiento,estado ";
    $query .=") VALUES (";
    $query .=" '{$p_codigo}', '{$p_fac}', '{$p_name}', '{$p_qty}', '{$p_cat}', '{$p_mod}', '{$p_ser}', '{$p_ubi}', '{$p_estados}', '{$media_id}', '{$date}', '{$p_qty}', '$var  $p_fac', 1 ";
    $query .=")";
    
    if($db->query($query)){
      $session->msg('s',"Producto agregado exitosamente. ");
      redirect('add_product.php', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('product.php', false);
    }
    
  } else{
    $session->msg("d", $errors);
    redirect('add_product.php',false);
  }
}

$producto = agregar();
?>
<!-- _________________________________________________________________________________________________________________________________________________________________ -->
<body>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <form method="POST" action="" autocomplete="off" id="sug-form">
      <div class="input-container">
        <input type="search" id="search" class="form-busqueda" placeholder=" Buscar id" />
      </div>
      <div class="errors-container" style="display: none;">
        <p></p>
      </div>
      <div class="resultado-container">
    </form>
  </div>
</div>
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar entrada</span>
          </strong>
        </div>
      </div>
    </div>
  </div>
</body>

<div class="col-md-1">
  <div class="panel-body" style="display: none;" id="resultadoContainer">
    <table class="table table-bordered table-striped" id="resultado">
      <thead>
        <tr>
          <th class="text-center"> Codigo </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($producto as $prodto):?>
        </div>
        <tr>
          <td class="text-center" name="product-codigo"><?php echo remove_junk($prodto['codigo']); ?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <div>
    <a href="actualizar.php" class="btn btn-success">Actualizar producto</a>
  </div>
  </div>
  <script src="script2.js" defer></script>
</div></br></br></br>

<!-- _________________________________________________________________________________________________________________________________________________________________ -->

<div class="panel-body">
  <div class="col-md-12">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
    <form id="formulario" action="add_product.php" method="POST" class="clearfix">
      <div class="col-sm-9">
          <div class="input-group">
    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-arrow-right"></i>
          </span>
          <?php $numero_aleatorio = rand(1,10000); ?>
          <input type="text" class="form-control" name="product-codigo[]" id="product-codigo" value="<?php echo $numero_aleatorio ?>">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div></br></br></br>
    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </span>
          <input type="text" class="form-control" name="product-factura[]" placeholder="Factura" size="100">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-th-large"></i>
          </span>
          <input type="text" class="form-control" name="product-title[]" placeholder="Producto">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div></br></br></br>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-categorie">
          <option value="">Selecciona una categoría</option>
          <?php  foreach ($all_categories as $cat): ?>
            <option value="<?php echo (int)$cat['id'] ?>">
            <?php echo $cat['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-photo">
          <option value="">Selecciona una imagen</option>
          <?php  foreach ($all_photo as $photo): ?>
            <option value="<?php echo (int)$photo['id'] ?>">
            <?php echo $photo['file_name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>
    
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </span>
        <input type="number" class="form-control" name="product-quantity[]" placeholder="Cantidad">
        <span class="input-group-addon">.</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-list-alt"></i>
        </span>
        <input type="text" class="form-control" name="product-modelo[]" placeholder="Modelo">
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-barcode"></i>
        </span>
        <input type="text" class="form-control" name="product-serie[]" placeholder="Serie">
        <span class="input-group-addon">.</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-ubicacion">
          <option value="">Ubicación</option>
          <?php  foreach ($all_ubicaciones as $ubi): ?>
            <option value="<?php echo (int)$ubi['id'] ?>">
            <?php echo $ubi['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-estados">
          <option value="">Estado</option>
          <?php  foreach ($all_estado as $estadodos): ?>
            <option value="<?php echo (int)$estadodos['id'] ?>">
            <?php echo $estadodos['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="input-group-btn">
        <td><button type="button" class="btn btn-danger">+</button></td>
      </div>
    </div></br></br></br>
    <div class="col-md-4">
      <div class="input-group">
        <button type="submit" name="add_product" class="btn btn-primary">Agregar entrada</button>
      </div>
    </div></br></br></br>

  </div>
</div>
<div>
</div>
</div>
</form>

<script>
$(document).ready(function(){
var addButton = $('.btn-danger'); //Add button selector
var wrapper = $('.col-sm-9'); //Input field wrapper
var fieldHTML = 
`<div style="margin-top:10px"class="input-group">

<div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-arrow-right"></i>
          </span>
          <?php $numero_aleatorio = rand(1,10000); ?>
          <input type="text" class="form-control" name="product-codigo" id="product-codigo" value="<?php echo $numero_aleatorio ?>">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div></br></br></br>
    <div class="col-sm-9">
        <div class="input-group">
    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </span>
          <input type="text" class="form-control" name="product-factura[]" placeholder="Factura" size="100">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-th-large"></i>
          </span>
          <input type="text" class="form-control" name="product-title[]" placeholder="Producto">
          <span class="input-group-addon">.</span>
        </div>
      </div>
    </div></br></br></br>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-categorie">
          <option value="">Selecciona una categoría</option>
          <?php  foreach ($all_categories as $cat): ?>
            <option value="<?php echo (int)$cat['id'] ?>">
            <?php echo $cat['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-photo">
          <option value="">Selecciona una imagen</option>
          <?php  foreach ($all_photo as $photo): ?>
            <option value="<?php echo (int)$photo['id'] ?>">
            <?php echo $photo['file_name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>
    
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </span>
        <input type="number" class="form-control" name="product-quantity[]" placeholder="Cantidad">
        <span class="input-group-addon">.</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-list-alt"></i>
        </span>
        <input type="text" class="form-control" name="product-modelo[]" placeholder="Modelo">
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-barcode"></i>
        </span>
        <input type="text" class="form-control" name="product-serie[]" placeholder="Serie">
        <span class="input-group-addon">.</span>
      </div>
    </div>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-ubicacion">
          <option value="">Ubicación</option>
          <?php  foreach ($all_ubicaciones as $ubi): ?>
            <option value="<?php echo (int)$ubi['id'] ?>">
            <?php echo $ubi['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div></br></br></br>

    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
        <select class="form-control" name="product-estados">
          <option value="">Estado</option>
          <?php  foreach ($all_estado as $estadodos): ?>
            <option value="<?php echo (int)$estadodos['id'] ?>">
            <?php echo $estadodos['name'] ?>
          </option>
          <?php endforeach; ?>
        </select>
        <span class="input-group-addon">.</span>
      </div>
    </div>
     
<button type="button" id="btn-erase" class="btn btn-danger">-</button></div></div>`;

$(addButton).click(function(){ //Once add button is clicked
  $(wrapper).append(fieldHTML);
});
$(wrapper).on('click', '#btn-erase', function(e){ //Once remove button is clicked
  e.preventDefault();
  $(this).parent().parent().remove(); //Remove field html
});

$("#formulario").submit(function (){ // CUANDO ENVIEN EL FORMULARIO
  var a = document.querySelectorAll("input[type='text']"); //BUSCAMOS TODOS LOS INPUTS
   for(var b in a){ //COMO RETORNA UN ARRAY ITERAMOS
     var c = a[b];
     if(typeof c == "object"){ // SOLO PUROS OBJECTS
      if(c.id != "product-codigo"){ // SOLO BUSCAMOS LOS PRODUCTOS Y CANTIDADES
        console.log(c.name,c.value); // NOMBRE DEL INPUT Y SU VALOR DE LA BUSQUEDA...
      } 
     }
   }
});
});
</script>

<?php include_once('layouts/footer.php'); ?>
