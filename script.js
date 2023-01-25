function cargar() {
  $(document).ready(function() {
   $.ajax({
     url:'sku.php',
     type: 'POST',
     success: function(respuesta) {
       document.getElementById("sku").value = respuesta;
     },
     error: function() {
       console.log("no fue posible guardar el Sku");
     }
   });
  });
}

// if(window.history.replaceState) {
//    console.log("probando")
//    window.history.replaceState(null, null, window.location.href)
// }
