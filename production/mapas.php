<?php
if(isset($_POST['fecha_inicio'])){
  echo $_POST['fecha_inicio'];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MAPA</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- PNotify -->
  <link href="../vendors/PNotify/dist/PNotifyBrightTheme.css" rel="stylesheet" type="text/css" />
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.css" rel="stylesheet">
  
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
    PNotify.info({
                title: 'Información',
                text: '1- Mueva Marcador\n2- Precione Botón Obtener Coordenadas.',
                styling: 'bootstrap3',
                icons: 'bootstrap3',
                hide: false,
                modules: {
                  Confirm: {
                    confirm: true,
                    buttons: [{
                      text: 'Aceptar',
                      primary: true,
                      click: function(notice) {
                        notice.close();
                      }
                    }]
                  },
                  Buttons: {
                    closer: false,
                    sticker: false
                  },
                  History: {
                    history: false
                  }
                }
              });
  }
};


</script>
</head>

<body>
    <div id="map"></div>

    
    
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
        center:new google.maps.LatLng(13.841345738343025,-88.8472831020996),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización

      <?php 
				include ("../build/conexion.php");
				if(isset($_POST['genero'])){
          $genero=$_POST['genero'];
        
              $stmt= $pdo->prepare("SELECT * FROM emprendedor WHERE sexo=:genero");
              $stmt->bindParam(":genero",$genero,PDO::PARAM_INT);
              $stmt->execute();
              $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result as $lista_emprendedor){     
  
			?>	
      marker = new google.maps.Marker({
        map: map,
        title: '<?php echo 'Emprendedor/a: '.$lista_emprendedor['nombre'].' '.$lista_emprendedor['apellido'].' \n Sexo: '.$lista_emprendedor['sexo']; ?> ',
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(<?php echo $lista_emprendedor['latitud']; ?>,<?php echo $lista_emprendedor['longitud']; ?>),

      });
      <?php
        }
      }
      ?>
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQMZPKy11FSacYTvGO8ZCD9DAKk8bquK0&callback=initMap"></script>
    
    
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- PNotify -->
    <script src="../vendors/PNotify/dist/iife/PNotify.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyButtons.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyConfirm.js"></script>
    <script src="../vendors/PNotify/dist/iife/PNotifyMobile.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
  </body>
</html>