<?php

$conn = new PDO('sqlsrv:Server=DESKTOP-2GN7EP5\PROYECTOS;Database=BD', 'sa', 'JDL*22');

$resultado = $conn->query("SELECT * FROM RegistroSku WHERE Asignar = 0")->fetchAll(PDO::FETCH_ASSOC);

print_r ($resultado[0]['Sku']);

 ?>
