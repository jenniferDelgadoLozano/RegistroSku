<script type="text/javascript">
window.history.forward();
function sinVueltaAtras(){ window.history.forward(); }
</script>

<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">

<?php

include("../conexion/conexionbd.php");
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name('usuario'),'',0,'/');
header('Location: http://192.168.2.183/Body/inicio_de_sesion.php');
echo '<script>console.log("Ingreso");</script>';

?>
