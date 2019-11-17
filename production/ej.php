<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MAPA</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  
<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 80%;
      }
      #coords{width: 500px;}
    </style>
    
<script type="text/javascript">
  function selecciona() {
    if(document.getElementById("coordsLa").value!="" && document.getElementById("coordsLo").value!=""){
    window.top.latitud.value = document.getElementById("coordsLa").value;
    window.top.longitud.value = document.getElementById("coordsLo").value;
  //window.opener.document.getElementById('lat').value = document.getElementById("coordsLa").value;
  //window.opener.document.getElementById('lon').value = document.getElementById("coordsLo").value;
  //window.close();
  }else{
    swal("Advertencia", "1- Mueva Marcador\n2- Precione Botón Obtener Coordenadas", "warning");
  }
};


</script>
</head>

<body>

<body >
    <div id="map"></div>

    <input type="hidden" id="coordsLa" />
    <input type="hidden" id="coordsLo" />
    <div class="col-md-6" align="center">
      <br/>
      <button type="button" class="btn btn-round  btn-danger" onClick="selecciona()" value="Obtener Coordenadas">
        <span class="fa fa-map-marker">&nbsp;&nbsp;&nbsp;</span>Obtener Coordenadas
      </button>
    </div>
    <script>


var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización

//Funcion principal
initMap = function () 
{

    //usamos la API para geolocalizar el usuario
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
           
          },function(error){console.log(error);});
    
}



function setMapa (coords)
{   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 17,
        center:new google.maps.LatLng(13.645775455067747,-88.78482488598326),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        title: "Marcador",
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(13.645775455067747,-88.78482488598326),

      });
      //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
      //cuando el usuario a soltado el marcador
      marker.addListener('click', toggleBounce);//para que el marcador salte
      //marker.addListener('click',hola);
      marker.addListener( 'dragend', function (event)
      {
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coordsLa").value = this.getPosition().lat();
		    document.getElementById("coordsLo").value=this.getPosition().lng();
      });
}
//function hola(){
 // alert("HOla");
//}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Carga de la libreria de google maps 

    </script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQMZPKy11FSacYTvGO8ZCD9DAKk8bquK0&callback=initMap"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>