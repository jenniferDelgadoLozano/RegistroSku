
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<form id="formulario" action="registrar.php" method="post">
         <!-- <div class="form-group">
       <label for="idusuario">Ingresar cliente:</label>
       <input type="text" REQUIRED class="form-control" id="idusuario" placeholder="Ingresar Nombre">
     </div> -->


     <!-- <div class="form-group">
      <label class="col-sm-3 control-label">Ingrese el producto:</label> -->
      <div class="col-sm-9">
        <div class="input-group">
          <input type="text" name="product-codigo[]" class="form-control"  placeholder="Ingrese el codigo">
          <input type="text" name="product-factura[]" class="form-control" placeholder="Ingrese la factura">
          <input type="text" name="product-title[]" class="form-control" placeholder="Ingrese el nombre">
          <input type="text" name="product-categorie[]" class="form-control" placeholder="Ingrese la categorie">
          <input type="text" name="product-photo[]" class="form-control" placeholder="Ingrese la photo">
          <input type="text" name="product-quantity[]" class="form-control" placeholder="Ingrese la catidad">
          <input type="text" name="product-modelo[]" class="form-control" placeholder="Ingrese el modelo">
          <input type="text" name="product-serie[]" class="form-control" placeholder="Ingrese la serie">
          <input type="text" name="product-ubicacion[]" class="form-control" placeholder="Ingrese la ubicacion">  
          <input type="text" name="product-estados[]" class="form-control" placeholder="Ingrese el estados">
          <button type="button" class="btn btn-danger">+</button>
          </div>
        </div>
      <!-- </div> -->

 <button type="submit" class="btn btn-primary">Registrar</button>
 <button type="button" class="btn btn-default">Cancelar</button>
</form>

<script>
$(document).ready(function(){
var addButton = $('.btn-danger'); //Add button selector
var wrapper = $('.col-sm-9'); //Input field wrapper

var fieldHTML = '<div style="margin-top:10px"class="input-group"> <input type="text" name="product-codigo[]" class="form-control"  placeholder="Ingrese el codigo">    <input type="text" name="product-factura[]" class="form-control" placeholder="Ingrese la factura">   <input type="text" name="product-title[]" class="form-control" placeholder="Ingrese el nombre"><input type="text" name="product-categorie[]" class="form-control" placeholder="Ingrese la categorie"><input type="text" name="product-photo[]" class="form-control" placeholder="Ingrese la photo"><input type="text" name="product-quantity[]" class="form-control" placeholder="Ingrese la catidad"><input type="text" name="product-modelo[]" class="form-control" placeholder="Ingrese el modelo"><input type="text" name="product-serie[]" class="form-control" placeholder="Ingrese la serie"><input type="text" name="product-ubicacion[]" class="form-control" placeholder="Ingrese la ubicacion">  <input type="text" name="product-estados[]" class="form-control" placeholder="Ingrese el estados"> <button type="button" id="btn-erase" class="btn btn-danger">-</button></div></div>'; //New input field html


$(addButton).click(function(){ //Once add button is clicked
  $(wrapper).append(fieldHTML);
});
$(wrapper).on('click', '#btn-erase', function(e){ //Once remove button is clicked
  console.log(wrapper);
  e.preventDefault();
  $(this).parent().parent().remove(); //Remove field html
});

$("#formulario").submit(function (){ // CUANDO ENVIEN EL FORMULARIO
  var a = document.querySelectorAll("input[type='text']"); //BUSCAMOS TODOS LOS INPUTS
   for(var b in a){ //COMO RETORNA UN ARRAY ITERAMOS
    var c = a[b];
     if(typeof c == "object"){ // SOLO PUROS OBJECTS
      // if(c.id != "idusuario"){ // SOLO BUSCAMOS LOS PRODUCTOS Y CANTIDADES
        console.log(c.name,c.value); // NOMBRE DEL INPUT Y SU VALOR DE LA BUSQUEDA...
      // } 
    }
  }
});
});
</script>
<!-- _________________________________________________________________________________________________________________________________________________________________ -->
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
    <div class="col-sm-9">
        <div class="input-group">
    <div class="col-md-4">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-list-alt"></i>
          </span>
          <input type="text" class="form-control" name="product-factura[]" placeholder="Factura">
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
