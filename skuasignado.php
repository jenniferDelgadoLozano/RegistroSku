<!DOCTYPE html>
    <h4>Sku Asignados</h4>

<?php
include("../conexion/conexionbd.php");

$data = $conn->query("SELECT Sku FROM dbo.RegistroSku WHERE CAST (Fecha AS date) = CAST (GETDATE()AS date)")->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $valor) {
    echo $valor ['Sku'], "<br>";
}
?>
