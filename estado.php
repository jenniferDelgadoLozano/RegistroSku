<?php
  $page_title = 'Lista de estados';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_estado = find_all('estados');
?>
<?php
 if(isset($_POST['add_ubi'])){
   $req_field = array('estado-name');
   validate_fields($req_field);
   $stdo_name = remove_junk($db->escape($_POST['estado-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO estados (name)";
      $sql .= " VALUES ('{$stdo_name}')";
      if($db->query($sql)){
        $session->msg("s", "Estado agregado exitosamente.");
        redirect('estado.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
        redirect('estado.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('estado.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Estado</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="estado.php">
            <div class="form-group">
                <input type="text" class="form-control" name="estado-name" placeholder="Estado" required>
            </div>
            <button type="submit" name="add_ubi" class="btn btn-primary">Agregar Estado</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Estados</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">Item</th>
                    <th>Estado</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_estado as $estadodos):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($estadodos['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_estado.php?id=<?php echo (int)$estadodos['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_estado.php?id=<?php echo (int)$estadodos['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
