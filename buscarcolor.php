<?php

include '../conexion/conexionbd.php';

if( isset($_POST["strCodColor"]) && isset($_POST["strCodColorFactory"]) && isset($_POST["strCodColorRoque"]) && isset($_POST["strNombre"]) && isset($_POST["intEstado"]) && isset($_POST["intUsuario"]) && isset($_POST["dtmGrabacion"]) ) {
  $strCodColor= $_POST['strCodColor'];
  $strCodColorFactory= $_POST['strCodColorFactory'];
  $strCodColorRoque= $_POST['strCodColorRoque'];
  $strNombre= $_POST['strNombre'];
  $intEstado= $_POST['intEstado'];
  $intUsuario= $_POST['intUsuario'];
  $dtmGrabacion= $_POST['dtmGrabacion'];

  $data = $conn->query("SELECT * FROM Colores WHERE strCodColor LIKE '%$strCodColor%' and strCodColorFactory LIKE '%$strCodColorFactory%' and strCodColorRoque LIKE '%$strCodColorRoque%'
    and strNombre LIKE '%$strNombre%' and intEstado LIKE '%$intEstado%' and intUsuario LIKE '%$intUsuario%' and dtmGrabacion LIKE '%$dtmGrabacion%'")->fetchAll(PDO::FETCH_ASSOC);

    print_r(json_encode($data));

}
