var table;

$(document).ready(function(){
   table = $('#tabla').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "aLengthMenu": [2,100]
  });
});

// _____________________________________________________________________________
function cargar() {
  $(document).ready(function() {
    $.ajax({
      url:'..\Body\sku.php',
      type: 'POST',
      success: function(respuesta) {
        document.getElementById("sku").value = respuesta;
      },
      error: function() {
        console.log("No fue posible guardar el Sku");
      }
    });
  });
};
// _____________________________________________________________________________
function btnBuscar() {
  const data = {
    strCodColor: $("#strCodColor").val(),
    strCodColorFactory: $("#strCodColorFactory").val(),
    strCodColorRoque: $("#strCodColorRoque").val(),
    strNombre: $("#strNombre").val(),
    intEstado: $("#intEstado").val(),
    intUsuario: $("#intUsuario").val(),
    dtmGrabacion: $("#dtmGrabacion").val()
  }

  $.ajax({
    url:'../Body/buscarcolor.php',
    type: 'POST',
    data: data,
    success: function(respuesta) {
      let data1 = JSON.parse(respuesta);
      $.each( data1, function( key, value ) {
        $("#tbody_modal").append(`<tr id="filas">
          <td>`+value.strCodColor+`</td>
          <td>`+value.strCodColorFactory+`</td>
          <td>`+value.strCodColorRoque+`</td>
          <td>`+value.strNombre+`</td>
          <td>`+value.intEstado+`</td>
          <td>`+value.intUsuario+`</td>
          <td>`+value.dtmGrabacion+`</td>
          <td><a id="añadir" onclick="añadir('`+value.strCodColor+`', '`+value.strCodColorFactory+`', '`+value.strCodColorRoque+`', '`+value.strNombre+`', '`+value.intEstado+`', '`+value.intUsuario+`', '`+value.dtmGrabacion+`',)"><i class="fa fa-paste"></i></a></td>
          </tr>`);
        });

        $('#tabla2').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          },
          "aLengthMenu": [5,100]
        });
      },
      error: function() {
        console.log("No fue posible consultar el Color");
      }
    });
  }
// _____________________________________________________________________________
function añadir(strCodColor, strCodColorFactory, strCodColorRoque, strNombre, intEstado, intUsuario, dtmGrabacion) {
  alert("Seleccionaste el color:"+strNombre);

document.getElementById("strCodColorform").value = strCodColor;
document.getElementById("strCodColorFactoryform").value = strCodColorFactory;
document.getElementById("strCodColorRoqueform").value = strCodColorRoque;
document.getElementById("strNombreform").value = strNombre;
document.getElementById("intEstadoform").value = intEstado;
document.getElementById("intUsuarioform").value = intUsuario;
document.getElementById("dtmGrabacionform").value = dtmGrabacion;
}
// _____________________________________________________________________________
if(window.history.replaceState) {
  console.log("¡Ya Ingreso!")
  window.history.replaceState(null, null, window.location.href)
}
// ______________________________________________________________________________Buscar
  var data = [];
  function checkear(id){

    for (var b = 0; b < $("#cantidad"+id).val(); b++) {
    if(document.getElementById('seleccionar' + id).checked){
      var arr = {
        indice : id,
        marca: document.getElementById("marca"+id).value,
        referencia: document.getElementById("referencia"+id).value,
        descripcion: document.getElementById("descripcion"+id).value,
        talla: document.getElementById("talla"+id).value,
        sku: document.getElementById("sku"+id).value,
        strCodColor: document.getElementById("strCodColor"+id).value,
        strCodColorFactory: document.getElementById("strCodColorFactory"+id).value,
        strCodColorRoque: document.getElementById("strCodColorRoque"+id).value,
        strNombre: document.getElementById("strNombre"+id).value,
        intEstado: document.getElementById("intEstado"+id).value,
        intUsuario: document.getElementById("intUsuario"+id).value,
        fecha: document.getElementById("fecha"+id).value
      }
      data.push(arr);
    }else{
      var indice = data.findIndex(function(objeto) {
          return objeto.indice == id;
        });

      if (indice !== -1) {
        data.splice(indice, 1);
      }
    }
  }
    console.log(data)
  }

function btnExportar() {

  $.ajax({
    type: 'POST',
    url:'../Body/tabla.php',
    data:{"data" : data},
    success: function(respuesta) {
			console.log(data);
      response = JSON.parse(respuesta)
      var $a = $("<a>");
      $a.attr("href",response["file"]);
      $("body").append($a);
      $a.attr("download","Codigos_Seleccionados.xlsx");
      $a[0].click();
      $a.remove();
    },
    error: function() {
      console.log("no fue posible exportar la información");
    }
  });
}
