<?php

$motor = "sqlsrv";
$servidor = "DESKTOP-2GN7EP5\PROYECTOS";
$basedatos = "BD";
$usuario = "sa";
$password = "JDL*22";

try {
  $conn = new PDO("$motor:Server=$servidor;Database=$basedatos", $usuario, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "";
}
catch(PDOException $e)
{
  $conn = "error";
  echo "La conexión ha fallado: " . $e->getMessage();
  echo "<script>
        console.log('". $e->getMessage()."');
        </script> ";
}
?>
